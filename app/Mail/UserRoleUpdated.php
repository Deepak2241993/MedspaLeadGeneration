<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRoleUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $fullPhoneNumber
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Forever Medspa - Details Updated')
                    ->view('emails.user-role-updated')
                    ->with([
                        'name' => $this->user->name,
                        'email' => $this->user->email,
                        'fullPhoneNumber' => $this->user->phone,
                    ]);
    }
}
