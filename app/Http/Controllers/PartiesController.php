<?php

namespace App\Http\Controllers;

use App\Models\PartiesModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PartiesController extends Controller
{
    //
    public function index()
    {
        $parties = PartiesModel::all();
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
        PartiesModel::updateOrCreate(['id' => $request->id],

            ['Name' => $request->name, 'Balance' => $request->balance, 'Billed' => $request->billed, 'Chq' => $request->chq, 'Received' => $request->received, 'Total' => $request->total,
                'NetTotal' => $request->net_total]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = PartiesModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = PartiesModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
