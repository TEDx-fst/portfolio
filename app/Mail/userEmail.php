<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class userEmail extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($User) {
        $this->User = $User;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        $EmailArray = ['user' => $this->User['email'], 'password' => $this->User['password']];
        return $this->from('tedxfstteam@tedxfst.com')
                        ->markdown('email.newuser')
                        ->with($EmailArray);
    }

}
