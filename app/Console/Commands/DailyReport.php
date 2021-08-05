<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Survey;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;


class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a daily email to 10 admins with report.';

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
        $users = User::where('menuroles', 'admin')->take(10)->get();
        $entriesNum = Survey::count();
        $entriesNumLastDay = Survey::where('created_at', '>=', Carbon::now()->subDay())->get()->count();
        $entriesNumLastHour = Survey::where('created_at', '>=',Carbon::now()->subHour())->get()->count();
        $mostCommonIp = Survey::select('ip', \DB::raw('COUNT(ip) as count'))
        ->groupBy('ip')
        ->orderBy('count', 'desc')
        ->take(10)->get();

        
        $mostCommonUserAgent = Survey::select('useragent', \DB::raw('COUNT(useragent) as count'))
        ->groupBy('useragent')
        ->orderBy('count', 'desc')
        ->take(10)->get();

        foreach ($users as $user) {
            Mail::send('mail.report', compact('entriesNum', 'entriesNumLastDay', 'entriesNumLastHour', 'mostCommonIp', 'mostCommonUserAgent'), function($message) use ($user) {
                $message->to($user->email)
                ->subject('Daily Report');
              });
        }

        return 0;
    }
}
