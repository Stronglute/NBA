<?php

namespace App\Http\Controllers;

use App\Models\SlugModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class Slugcontroller extends Controller
{
    //
    public function show()
    {
        $slugs = SlugModel::all();
        return DataTables::of($slugs)
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
        SlugModel::updateOrCreate(['id' => $request->id],

            ['Name' => $request->name, 'Balance' => $request->balance, 'Billed' => $request->billed, 'Chq' => $request->chq, 'Received' => $request->received, 'Total' => $request->total,
                'NetTotal' => $request->net_total]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = SlugModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = SlugModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
