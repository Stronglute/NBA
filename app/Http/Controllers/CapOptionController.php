<?php

namespace App\Http\Controllers;

use App\Models\CapOptionModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CapOptionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function row($description)
    {
        return CapOptionModel::where('Description', "=", $description)->first();
    }

    public function show()
    {
        $capopt = CapOptionModel::all();
        return DataTables::of($capopt)
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
        CapOptionModel::updateOrCreate(['id' => $request->id],

            ['Description' => $request->description, 'Length' => $request->length, 'Color' => $request->color, 'Cap' => $request->cap]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = CapOptionModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = CapOptionModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
