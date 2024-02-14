<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\cronejob;

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send a mail to Admin how many register user are avaliable ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //

        // $total_users = User::all()->whereRaw('Date(created_at) = CURDATE()');
        $total_users = User::whereDay('created_at',now()->day)->get();

        Mail::to('vinit.m@vivanshinfotech.com')->send( new cronejob($total_users));

    }
}
