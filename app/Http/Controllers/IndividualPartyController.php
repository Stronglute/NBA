<?php

namespace App\Http\Controllers;

use App\Models\IndividualPartyModel;
use Yajra\DataTables\Facades\DataTables;

class IndividualPartyController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($name)
    {
        $iparty = IndividualPartyModel::where('PartyName', "=", $name)->get();
        return DataTables::of($iparty)
            ->addColumn('action', function ($row) {

                $btn = '<button  onclick="edit(' . $row->id . ')" class="edit btn btn-primary btn-sm">Edit</a>';
                return $btn;

            })

            ->rawColumns(['action'])
            ->make(true);
    }

}
