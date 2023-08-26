<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManufactureRequest;
use App\Models\Manufacture;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ManufactureController extends Controller
{
    public function index()
    {
        return view('admin.manufacture.index');
    }

    public function getData(Request $request)
    {
        $copy = Manufacture::query()
            ->select([
                'id',
                'name',
                'description',
                'created_at as created',
            ])
            ->orderByDesc('id');
        return DataTables::eloquent($copy)->make(true);
    }
    public function store(ManufactureRequest $request)
    {
        $data = $request->validated();
        Manufacture::query()->create($data);

        return redirect()->back()->with('success', 'Copy created successfully');

    }
    public function update($id,Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string']
        ]);
         Manufacture::query()->find($id)->update($data);

        return redirect()->back()->with('success', 'Manufacture updated successfully');


    }

    public function delete($id,Request $request){
        Manufacture::query()->find($id)->delete();
        return response()->json([]);
    }
}
