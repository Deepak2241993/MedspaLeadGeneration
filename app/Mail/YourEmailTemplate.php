<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class YourEmailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $toAddress;
    public $subject;
    public $selectedTemplate;
    public $htmlCode;

    public function __construct($toAddress, $subject, $selectedTemplate, $htmlCode)
    {
        $this->toAddress = $toAddress;
        $this->subject = $subject;
        $this->selectedTemplate = $selectedTemplate;
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
        ->view('admin.emails.your_template') // Update with your actual email template
        ->with([
            'selectedTemplate' => $this->selectedTemplate,
            'htmlCode' => $this->htmlCode,
        ]);
    }
}
