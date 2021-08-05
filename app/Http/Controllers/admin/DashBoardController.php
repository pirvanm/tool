<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Survey;
use Illuminate\Support\Carbon;


class DashBoardController extends Controller
{
    public function index()
    {
        $colors = ['#c22e3c', '#5f1994', '#6699cc', '#f03b0b', '#4b0bf1', '#494e7d', '#11e6a9', '#aca92d', '#f44970', '#1bc142'];
        $colorsNum;

        foreach ($colors as $color) {
            $colorsNum[$color] = Survey::where('color1', $color)->orWhere('color2', $color)->orWhere('color2', $color)->count();
        }

        $query = Survey::select('country AS 0', \DB::raw('count(country) AS entries'))->groupBy('country')->get()->toArray();

        $data = [];

        foreach ($query as $q) {
            $data[] = [$q[0], $q['entries']];
        }


        return view('dashboard.homepage', ['colorsNum' => $colorsNum, 'data' => $data]);
    }

    public function getCharJsData()
    {
        return (response()->json(Survey::get()->groupBy(function($date) {
            return intval(Carbon::parse($date->created_at)->format('h'));
        })->map->count()));
        
    }

    
}
