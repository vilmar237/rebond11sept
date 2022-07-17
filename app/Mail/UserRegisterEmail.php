<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    private $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($view, $subject, $data = [])
    {
        $this->data = $data;
        $this->view = $view;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view =  (view()->exists('mail.'.$this->view)) ? 'mail.'.$this->view : 'mail.admin.test';

        return $this->subject($this->subject)->markdown($view)->with($this->data);
    }
}
