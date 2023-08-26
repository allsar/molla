<?php

namespace App\Http\Controllers;

use App\Http\Requests\CopyRequest;
use App\Models\CopyModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CopyController extends Controller
{
    public function index()
    {
        return view('admin.copy.index');
    }

    public function getData(Request $request)
    {
        $copy = CopyModel::query()
            ->select([
                'id',
                'name',
                'description',
                'created_at as created',
                'updated_at'
            ])
            ->orderByDesc('id');
        return DataTables::eloquent($copy)->make(true);
    }

    public function store(CopyRequest $request)
    {
        $data = $request->validated();
        CopyModel::query()->create($data);

        return redirect()->back()->with('success', 'Copy created successfully');

    }

    public function update($id,Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string']
        ]);
        CopyModel::query()->find($id)->update($data);

        return redirect()->back()->with('success', 'Copy updated successfully');


    }
}
