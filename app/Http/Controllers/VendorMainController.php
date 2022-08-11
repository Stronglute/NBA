<?php

namespace App\Http\Controllers;

use App\Models\VendorMainModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VendorMainController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $vendor = VendorMainModel::all();
        return DataTables::of($vendor)

            ->addColumn('contractimage', function ($row) {
                if (empty($row->Contract)) {
                    return '';
                }
                $url = asset("storage/app/image-docs/$row->Contract");
                $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" >';
                return $img;
            })
            ->addColumn('action', function ($row) {

                $btn = '<button  onclick="edit(' . $row->id . ')" class="edit btn btn-primary btn-sm">Edit</button>';

                $btn = $btn . '<button  onclick="remove(' . $row->id . ')" class="edit btn btn-danger btn-sm">Delete</button>';

                $btn = $btn . '<a href="/ipshowpage/' . $row->Name . '" class="edit btn btn-secondary btn-sm">View</a>';

                return $btn;

            })
            ->rawColumns(['contractimage', 'action'])
            ->make(true);

    }

    public function store(Request $request)
    {
        $imageName = $request->contract;
        if ($request->contract != null) {
            if ($request->id != null) {

                $data = VendorMainModel::find($request->id);
                $path = asset("storage/app/image-docs/$data->Contract");
                if (file_exists($path)) {
                    return unlink($path);
                }
            }

            $imageName = time() . '.' . $request['contract']->getClientOriginalExtension();
            $request['contract']->move('storage\app\image-docs', $imageName);
        }
        VendorMainModel::updateOrCreate(['id' => $request->id],

            ['VendorName' => $request->name, 'Address' => $request->address, 'Contact' => $request->contact, 'CNIC' => $request->cnic, 'Email' => $request->email, 'NTN' => $request->ntn, 'Contract' => $imageName]);

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
