<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailSoonToExpire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:soonToExpire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Email To Users soon to Expire';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentDay = Carbon::now();
        $usersToExpire = User::select('users.name', 'users.email', 'user_courses.expiration_date', 'courses.title')->join('user_courses', 'user_courses.user_id', '=', 'users.id')->join('courses', 'user_courses.course_id', '=', 'courses.id')->whereRaw('DATEDIFF(user_courses.expiration_date, ?) = ?')->setBindings([$currentDay, 0])->get();

        foreach ($usersToExpire as $user) {
            $emailUser = $user->email;
            Mail::send('emails.mailExpired', ['userName' => $user->name, 'courseName' => $user->title], function ($message) use ($emailUser) {
                $message->to($emailUser);
                $message->subject('Tu periódo de suscripcion ha caducado');
            });
        }
    }
}
