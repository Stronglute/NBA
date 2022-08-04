<?php

namespace App\Http\Controllers;

use App\Models\CapProductionModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CapProductionController extends Controller
{
    //
    public function show()
    {
        $capproduction = CapProductionModel::all();
        return DataTables::of($capproduction)
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
        CapProductionModel::updateOrCreate(['id' => $request->id],

            ['Date' => $request->date, 'Description' => $request->description, 'Length' => $request->length, 'Color' => $request->color, 'Cap' => $request->cap, 'Production' => $request->production]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = CapProductionModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = CapProductionModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
