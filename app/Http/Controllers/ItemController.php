<?php

namespace App\Http\Controllers;

use App\Models\CatgoryModel;
use App\Models\ItemsModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ItemController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $catgory = CatgoryModel::all();
        return view('Item', ['catgory' => $catgory]);
    }

    public function show()
    {
        $item = ItemsModel::all();
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
        ItemsModel::updateOrCreate(['id' => $request->id],

            ['ItemName' => $request->name, 'Unit' => $request->unit, 'Description' => $request->description, 'Catgory' => $request->catgory]);

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
