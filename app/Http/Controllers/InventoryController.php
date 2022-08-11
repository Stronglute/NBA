<?php

namespace App\Http\Controllers;

use App\Models\InventoryModel;
use App\Models\ItemsModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InventoryController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Item = ItemsModel::distinct()->get('Unit');
        $data = ItemsModel::get('ItemName');
        return view('Inventory', compact('Item', 'data'));
    }

    public function getinfo($name)
    {
        $item = ItemsModel::where('ItemName', '=', $name)->first();
        return $item;
    }

    public function show()
    {
        $inventory = InventoryModel::all();
        return DataTables::of($inventory)
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
        InventoryModel::updateOrCreate(['id' => $request->id],

            ['Item' => $request->name, 'Unit' => $request->unit, 'Amount' => $request->amount, 'Date' => $request->date]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = InventoryModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = InventoryModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
