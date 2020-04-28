<?php

namespace App\Units\Mail;

use App\Domains\Util\Instance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Mail;
use DeviTools\Persistence\AbstractModel;

/**
 * Class Sender
 * @package App\Units\Mail
 */
class Sender extends Mailable
{
    /**
     * @trait
     */
    use Instance;
    use Queueable;
    use SerializesModels;

    /**
     * @var AbstractModel
     */
    public $data;

    /**
     * @var string
     */
    protected $template;

    /**
     * @var array
     */
    private $payload;

    /**
     *
     * Create a new message instance.
     *
     * @param string $template
     * @param array $payload
     */
    public function __construct(string $template, array $payload)
    {
        $locale = Lang::getLocale();
        $this->template = "mail.{$locale}.{$template}";
        $this->payload = $payload;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->view($this->template, $this->payload);
    }

    /**
     * @param string|array $users
     */
    public function dispatch($users): void
    {
        Mail::to($users)->queue($this->onQueue('email'));
    }
}
