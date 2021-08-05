<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Survey;
use App\Models\EntrySetting;
use Illuminate\Support\Carbon;
use Stevebauman\Location\Facades\Location;

class SurveysController extends Controller
{
    public function index()
    {
        return view('home');
    }

    private function sendReport($numReports)
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
            \Mail::send('mail.report', compact('entriesNum', 'entriesNumLastDay', 'entriesNumLastHour', 'mostCommonIp', 'mostCommonUserAgent', 'numReports'), function($message) use ($user) {
                $message->to($user->email)
                ->subject('Daily Report');
              });
        }
    }

    public function store(Request $request)
    {
        $entrySetting = EntrySetting::first();
        $surveysNum = Survey::count();

        if ($entrySetting->entries_limit == $surveysNum) {
            return back()->with('message', 'Thank you for your application but we are sorry, the survey has reached his end.');
        }

        $request->validate([
            'name' => 'required|unique:surveys',
            'email' => 'required|unique:surveys',
            'captcha' => ''
        ]);

        $colors = ['#c22e3c', '#5f1994', '#6699cc', '#f03b0b', '#4b0bf1', '#494e7d', '#11e6a9', '#aca92d', '#f44970', '#1bc142'];


        // in case user removes the color forms and try to send the data this way.
        if (!$request->has('color1') && !$request->has('color2') && !$request->has('color3')) {
            return back();
        }
        
        if ($request->color1 != "#000000" && !in_array($request->color1, $colors)) {
            dd(1);
            return back();
        }

        if ($request->color2 != "#000000" && !in_array($request->color2, $colors)) {
            dd(2);
            return back();
        }

        if ($request->color3 != "#000000" && !in_array($request->color3, $colors)) {
            dd(3);
            return back();
        }

        

        $data = Location::get();

        $survey = new Survey();
        $survey->name = $request->name;
        $survey->email = $request->email;
        $survey->color1 = $request->color1;
        $survey->color2 = $request->color2;
        $survey->color3 = $request->color3;
        $survey->useragent = $request->server('HTTP_USER_AGENT');
        $survey->ip = $data->ip;
        $survey->country = $data->countryName;

        $survey->save();

        $timeToReport = $surveysNum / $entrySetting->entries_report_num;


        if ($timeToReport > $entrySetting->entries_reports_sent) {
            EntrySetting::first()->update(['entries_reports_sent' => $entrySetting->entries_reports_sent + 1]);
            $this->sendReport($timeToReport);

        }

        return back()->with('message', 'The survey has been submitted, thank you!');
    }
}
