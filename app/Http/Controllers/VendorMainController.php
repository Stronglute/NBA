<?php

namespace App\Http\Controllers;

use App\Models\VendorMainModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorMainController extends Controller
{
    //
    public function show()
    {
        $vendor = VendorMainModel::all();
        return DataTables::of($vendor)
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
        VendorMainModel::updateOrCreate(['id' => $request->id],

            ['VendorName' => $request->name, 'Balance' => $request->balance]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = VendorMainModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = VendorMainModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
