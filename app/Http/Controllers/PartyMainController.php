<?php

namespace App\Http\Controllers;

use App\Models\ClientMainModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PartyMainController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $parties = ClientMainModel::all();
        return DataTables::of($parties)
            ->addColumn('contractimage', function ($row) {
                if (empty($row->Contract)) {
                    return '';
                }
                $url = asset("storage/app/image-docs/$row->Contract");
                $img = '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" >';
                return $img;
            })
            ->addColumn('action', function ($row) {

                $btn = '<button  onclick="edit(' . $row->id . ')" class="edit btn btn-primary btn-sm col-sm-3">Edit</a>';

                $btn = $btn . '<button  onclick="remove(' . $row->id . ')" class="edit btn btn-danger btn-sm col-sm-4">Delete</button>';

                $btn = $btn . '<a href="/ipshowpage/' . $row->Name . '" class="edit btn btn-secondary btn-sm col-sm-3">View</a>';

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

                $data = ClientMainModel::find($request->id);
                $path = asset("storage/app/image-docs/$data->Contract");
                if (file_exists($path)) {
                    return unlink($path);
                }
            }

            $imageName = time() . '.' . $request['contract']->getClientOriginalExtension();
            $request['contract']->move('storage\app\image-docs', $imageName);
        }
        ClientMainModel::updateOrCreate(['id' => $request->id],

            ['PartyName' => $request->name, 'Address' => $request->address, 'Contact' => $request->contact, 'CNIC' => $request->cnic, 'Email' => $request->email, 'NTN' => $request->ntn, 'Contract' => $imageName]);

        return response()->json(['success' => 'Product saved successfully.']);

    }

    public function edit($id)
    {
        $product = ClientMainModel::find($id);

        return response()->json($product);

    }

    public function destroy($id)
    {
        $data = ClientMainModel::find($id);
        $data->delete();
        return response()->json(['success' => 'Product deleted successfully.']);

    }
}
