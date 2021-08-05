<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Survey;
use Yajra\DataTables\Facades\DataTables;

class EntriesController extends Controller
{
    public function index()
    {
        return view('entries.index');
    }

    public function datatable()
    {
        $data =  Survey::orderBy('created_at', 'desc')->get();

        return Datatables::of($data)
         ->addColumn('action', function ($data) {
             $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm">Edit</button>';
             $button .= '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-danger btn-sm">Delete</button>';
             return $button;
         })
         ->addColumn('color_1', function ($data) {
            $color = '<span style="display: block; width: 30px; height: 30px; border-radius: .3rem; background-color: '. $data->color1 .';"></span>';
            return $color;
        })
        ->addColumn('color_2', function ($data) {
            $color = '<span style="display: block; width: 30px; height: 30px; border-radius: .3rem; background-color: '. $data->color2 .';"></span>';
            return $color;
        })
        ->addColumn('color_3', function ($data) {
            $color = '<span style="display: block; width: 30px; height: 30px; border-radius: .3rem; background-color: '. $data->color3 .';"></span>';
            return $color;
        })
        
         ->rawColumns(['action', 'color_1', 'color_2', 'color_3'])
         ->make(true);
    }
}
