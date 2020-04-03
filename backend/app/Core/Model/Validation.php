<?php

namespace App\Core\Model;

use App\Exceptions\ErrorValidation;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Facades\Validator;

use function App\Helper\decodeUuid;
use function App\Helper\error;

/**
 * Trait Validation
 *
 * @package App\Core\Model
 */
trait Validation
{
    /**
     * @var array
     */
    protected $uniques = [];

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @return bool
     * @throws ErrorValidation
     */
    public function validate(): bool
    {
        $validator = Validator::make($this->getAttributes(), $this->getRules());
        if ($validator->fails()) {
            $this->addValidationErrors($validator);
            throw new ErrorValidation($this->getErrors());
        }
        return true;
    }

    /**
     * @return array
     */
    final protected function getRules(): array
    {
        return array_merge_recursive($this->rules, array_reduce($this->uniques, function ($accumulate, $unique) {
            $accumulate[$unique] = "unique:{$this->table},{$unique}";
            if ($id = $this->getValue($this->primaryKey)) {
                $id = decodeUuid($id);
                $accumulate[$unique] = "unique:{$this->table},{$unique},{$id}";
            }
            return $accumulate;
        }, []));
    }

    /**
     * @param ValidatorContract $validator
     *
     * @return void
     */
    final protected function addValidationErrors(ValidatorContract $validator): void
    {
        $invalid = $validator->invalid();
        foreach ($validator->failed() as $property => $errors) {
            $value = $invalid[$property] ?? null;
            $this->registerValidationErrors($errors, $property, $value);
        }
    }

    /**
     * @param array $errors
     * @param string $property
     * @param mixed $value
     *
     * @return void
     */
    private function registerValidationErrors(array $errors, string $property, $value): void
    {
        $manyToOne = $this->manyToOne();
        foreach ($manyToOne as $alias => $column) {
            if ($column !== $property) {
                continue;
            }
            /** @var string $alias */
            $property = $alias;
            break;
        }
        foreach ($errors as $error => $parameters) {
            $message = strtolower($error);
            $this->addError($property, $message, $value, $parameters);
        }
    }

    /**
     * @param string $property
     * @param string $message
     * @param mixed $value
     * @param array $parameters
     * @param mixed $code
     *
     * @return $this
     */
    final protected function addError(string $property, string $message, $value, $parameters = [], $code = null)
    {
        $this->errors[] = error($property, $message, $value, $parameters, $code);
        return $this;
    }

    /**
     * @return array
     */
    final public function getErrors(): array
    {
        return $this->errors;
    }
}