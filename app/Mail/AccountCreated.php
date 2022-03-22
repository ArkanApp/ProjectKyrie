<?php
/**
 * Project Kyrie - An Arkan App service oriented to the health area.
 * Created by:
 *  > Mauricio Cruz Portilla <mauricio.portilla@hotmail.com>
 * 
 * This project was created in the hope that it will be useful for any
 * professionist from this area.
 * 
 * July 21st, 2020
 */

namespace App\Mail;

use App\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountCreated extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Account created
     *
     * @var Account
     */
    private $account;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Account $account) {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->from(config("mail.from.address"))
                    ->subject("¡Bienvenido a Project Kyrie!")
                    ->view("mails.account_created")
                    ->with("account", $this->account);
    }
}
