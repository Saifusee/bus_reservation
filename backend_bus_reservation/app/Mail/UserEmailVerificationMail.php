<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserEmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_id;
    public $user_name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id_recieve, $username_recieve)
    {
        $this->user_id = $id_recieve;
        $this->user_name = $username_recieve;    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $string1 = 'THIS IS MY OWN PERSONAL SITE AND ITS A RANDOM STRING';
        $string2 = 'THIS IS AGAIN A RANDOM STRING BUT FOR EMAIL VERIFICATION PURPOSE';
        $id = $this->user_id; //User id we recieve
        $name = $this->user_name; //User name we recieve
        $decode_string = $string1.$id.$string2.$id.$name.$string1.$name.$string2;  //Creating a random string.
        $token = base64_encode($decode_string);  //Generating token with the string we created.

        //Saving token in user database
        $user = User::find($id);
        $user['remember_token'] = $token;
        $user->save();

        //Creating a link to provide in Email
        $link = env('FRONTEND_DOMAIN_URL').'/'.'verify-email/'.$token.'/verify'.'/'.$id;

        return $this->from('khaninc.9829@gmail.com', env('SITE_HEADING'))
                    ->subject('User E-mail Address Verification')
                    ->markdown('emails.userEmailVerification')
                    ->with([
                        'link' => $link,
                        'id' => $id,
                        'site_heading' => env('SITE_HEADING'),
                        'username' => $name,
                    ]);
    }
}
