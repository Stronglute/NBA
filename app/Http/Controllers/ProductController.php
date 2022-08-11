<?php

namespace App\Http\Controllers;

use App\Models\CatgoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $catgory = CatgoryModel::all();
        return view('Product', ['catgory' => $catgory]);
    }

    public function show()
    {
        $product = ProductModel::all();
        return DataTables::of($product)
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
        ProductModel::updateOrCreate(['id' => $request->id],

            ['Name' => $request->name, 'Unit' => $request->unit, 'Description' => $request->description, 'Catgory' => $request->catgory]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = ProductModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = ProductModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
