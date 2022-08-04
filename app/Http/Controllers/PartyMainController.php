<?php

namespace App\Http\Controllers;

use App\Models\ClientMainModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PartyMainController extends Controller
{
    //
    public function show()
    {
        $parties = ClientMainModel::all();
        return DataTables::of($parties)
            ->addColumn('action', function ($row) {

                $btn = '<button  onclick="edit(' . $row->id . ')" class="edit btn btn-primary btn-sm">Edit</a>';

                $btn = $btn . '<button  onclick="remove(' . $row->id . ')" class="edit btn btn-danger btn-sm">Delete</button>';

                $btn = $btn . '<a href="/ipshowpage/' . $row->Name . '" class="edit btn btn-secondary btn-sm">View</a>';

                return $btn;

            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        ClientMainModel::updateOrCreate(['id' => $request->id],

            ['PartyName' => $request->name, 'Balance' => $request->balance]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = ClientMainModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = ClientMainModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
