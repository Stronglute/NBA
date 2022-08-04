<?php

namespace App\Http\Controllers;

use App\Models\ItemsModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    //
    public function show()
    {
        $vendor = ItemsModel::all();
        return DataTables::of($vendor)
            ->addColumn('action', function ($row) {

                $btn = '<button  onclick="edit(' . $row->id . ')" class="edit btn btn-primary btn-sm">Edit</a>';

                $btn = $btn . '<button  onclick="remove(' . $row->id . ')" class="edit btn btn-danger btn-sm">Delete</button>';
                return $btn;

            })

            ->rawColumns(['action'])
            ->make(true);
    }

    public function store(Request $request)
    {
        ItemsModel::updateOrCreate(['id' => $request->id],

            ['ItemName' => $request->name]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = ItemsModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = ItemsModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
