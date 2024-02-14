<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\sendmails;
use Illuminate\Support\Facades\Mail;


class sendmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mails;
    protected $password;
    protected $rolename;
    /**
     * Create a new job instance.
     */
    public function __construct($mails,$password,$rolename)
    {
        //
        $this->mails = $mails;
        $this->password = $password;
        $this->rolename = $rolename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $email = new sendmails($this->mails, $this->password,$this->rolename);
        Mail::to($this->mails)->send($email);

    }
}
