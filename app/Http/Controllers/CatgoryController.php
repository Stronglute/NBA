<?php

namespace App\Http\Controllers;

use App\Models\CatgoryModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CatgoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $item = CatgoryModel::all();
        return DataTables::of($item)
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
        CatgoryModel::updateOrCreate(['id' => $request->id],

            ['Name' => $request->name]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = CatgoryModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = CatgoryModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
