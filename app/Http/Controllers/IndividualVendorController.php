<?php

namespace App\Http\Controllers;

use App\Models\IndividualVendor;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class IndividualVendorController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $vendor = IndividualVendor::all();
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
        IndividualVendor::updateOrCreate(['id' => $request->id],

            ['Date' => $request->name, 'Description' => $request->balance, 'Weight' => $request->chq, 'Rate' => $request->received, 'Payment' => $request->total,
                'Paid' => $request->net_total, 'Balance' => $request->billed, 'PartyName' => $request->billed]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = IndividualVendor::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = IndividualVendor::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
