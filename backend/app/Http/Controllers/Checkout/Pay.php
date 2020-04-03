<?php

namespace App\Http\Controllers\Checkout;

use App\Domains\Admin\User;
use App\Domains\Admin\User\UserRepository;
use App\Domains\Gateway\Shop;
use App\Domains\Gateway\Transaction;
use App\Domains\Gateway\Transaction\TransactionRepository;
use App\Exceptions\ErrorInvalidIntegration;
use App\Exceptions\ErrorValidation;
use App\Http\Controllers\Controller;
use Exception;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Ramsey\Uuid\Uuid;
use Throwable;

use function App\Helper\encodeUuid;
use function Php\prop;

/**
 * Class Pay
 *
 * @package App\Http\Controllers\Checkout
 */
class Pay extends Controller
{
    /**
     * @traits
     */
    use Integrator;
    use Answer;

    /**
     * The __invoke method is called when a script tries to call an object as a function.
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @param TransactionRepository $transactionRepository
     *
     * @return mixed
     * @throws ErrorValidation
     * @throws Exception
     * @link https://php.net/manual/en/language.oop5.magic.php#language.oop5.magic.invoke
     */
    public function __invoke(
        Request $request,
        UserRepository $userRepository,
        TransactionRepository $transactionRepository
    ) {
        // validate the header
        $merchant = $request->header('Authorization');
        if (!$merchant) {
            return response(['status' => 'fail', 'data' => ['apiKey' => 'The merchant API Key is required.']], 401);
        }
        // try recover the user
        try {
            $users = $userRepository->filter(['integration' => encodeUuid($merchant)]);
        } catch (Throwable $error) {
            return response(['status' => 'fail', 'data' => ['merchant' => 'The merchant API Key is invalid.']], 403);
        }
        // check user was found
        if (!$users->count()) {
            return response(['status' => 'fail', 'data' => ['merchant' => 'The merchant API Key is invalid.']], 403);
        }

        // get the user
        $user = $users->first();

        // extract the values from request
        $origin = $request->post('origin');
        $customer = $request->post('email');
        $amount = $request->post('amount');
        $name = $request->post('name');
        $lastName = $request->post('lastName');
        $callback = $request->post('returnURL');
        $country = $request->post('country');
        $state = $request->post('state');
        $address = $request->post('address');
        $city = $request->post('city');
        $birthDate = $request->post('birthDate');
        $zipCode = $request->post('zipCode');
        $phone = $request->post('phone');

        // configure the payload
        $data = [
            'id' => Uuid::uuid4()->toString(),
            'user' => $user,
            'merchantName' => $user->getValue('name'),
            'origin' => $origin,
            'customer' => $customer,
            'amount' => $amount,
            'name' => $name,
            'lastName' => $lastName,
            'callback' => $callback,
            'country' => $country,
            'state' => $state,
            'address' => $address,
            'city' => $city,
            'birthDate' => $birthDate,
            'zipCode' => $zipCode,
            'phone' => $phone,
        ];

        // get the kind
        $kind = $user->shop->kind;

        // if kind is WORDPRESS
        if ($kind === Shop::KIND_WORDPRESS) {
            return $this->payWithWordpress($transactionRepository, $data);
        }

        // if kind is EPG
        if ($kind === Shop::KIND_EASY_PAYMENT_GATEWAY) {
            try {
                return $this->payWithEasyPaymentGateway($transactionRepository, $user, $data);
            } catch (Throwable $error) {
                return $this->error($error, $data);
            }
        }

        // if kind is DECTA
        if ($kind === Shop::KIND_DECTA) {
            try {
                return $this->payWithDecta($transactionRepository, $user, $data);
            } catch (Throwable $error) {
                return $this->error($error, $data);
            }
        }

        // invalid kind
        return $this->fail(['shop' => 'The merchant does not have a valid shop.']);
    }

    /**
     * @param TransactionRepository $transactionRepository
     * @param array $data
     *
     * @return RedirectResponse
     * @throws ErrorValidation
     * @throws Exception
     */
    public function payWithWordpress(TransactionRepository $transactionRepository, array $data): RedirectResponse
    {
        $customer = prop($data, 'customer');
        $amount = prop($data, 'amount');
        if (!$customer || !$amount) {
            throw new ErrorValidation(['email' => 'required', 'amount' => 'required']);
        }

        $created = $transactionRepository->create($data);
        /** @var Transaction $transaction */
        $transaction = $transactionRepository->read($created);
        return redirect()->to($transaction->getValue('url'));
    }

    /**
     * @param TransactionRepository $transactionRepository
     * @param User $user
     * @param array $data
     *
     * @return Response
     * @throws Exception
     */
    public function payWithEasyPaymentGateway(
        TransactionRepository $transactionRepository,
        User $user,
        array $data
    ): Response {
        // the fields to send to CRYPTOS to handle EPG
        $fields = Transaction::FIELDS_EPG;


        return $this->pay($transactionRepository, $user, $data, $fields);
    }

    /**
     * @param TransactionRepository $transactionRepository
     * @param User $user
     * @param array $data
     *
     * @return Response
     * @throws Exception
     */
    public function payWithDecta(TransactionRepository $transactionRepository, User $user, array $data): Response
    {
        // the fields to send to CRYPTOS to handle DECTA
        $fields = Transaction::FIELDS_DECTA;

        return $this->pay($transactionRepository, $user, $data, $fields);
    }

    /**
     * @param TransactionRepository $transactionRepository
     * @param User $user
     * @param array $data
     * @param array $fields
     *
     * @return Response
     */
    private function pay(
        TransactionRepository $transactionRepository,
        User $user,
        array $data,
        array $fields
    ): Response {
        $create = static function ($data) use ($transactionRepository) {
            return $transactionRepository->create($data);
        };
        try {
            $answer = $this->createIntegration($user, $data, $fields, $create);
            return $this->success($answer);
        } // Guzzle error
        catch (ClientException $error) {
            // status error is not 2xx
            $response = $error->getResponse();
            // but there is a valid response
            if ($response) {
                // extract JSON from response
                /** @noinspection JsonEncodingApiUsageInspection */
                return $this->fail(json_decode((string)$response->getBody()->getContents(), true), true);
            }
        } // validation error
        catch (ErrorInvalidIntegration $error) {
            return $this->fail($error->getDetails());
        } catch (Throwable $error) {
            // unknown error
        }
        return $this->error($error, $data);
    }
}