<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class YourEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $toAddress;
    public $subject;
    public $htmlCode;

    public function __construct($toAddress, $subject, $htmlCode)
    {
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->htmlCode = $htmlCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->toAddress)
            ->subject($this->subject)
            ->html($this->htmlCode); // Use the `html` method to send raw HTML content
    }
}
