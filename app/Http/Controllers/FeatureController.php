<?php

namespace App\Http\Controllers;

use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeatureController extends Controller
{
    public function index()
    {
        return view('admin.features.index');
    }

    public function getData(Request $request)
    {
        $copy = Feature::query()
            ->select([
                'id',
                'name',
                'description',
                'created_at as created',
            ])
            ->orderByDesc('id');
        return DataTables::eloquent($copy)->make(true);
    }

    public function store(FeatureRequest $request)
    {
        $data = $request->validated();
        Feature::query()->create($data);

        return redirect()->back()->with('success', 'Feature created successfully');

    }

    public function update($id,Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'description' => ['string']
        ]);
        Feature::query()->find($id)->update($data);

        return redirect()->back()->with('success', 'Feature updated successfully');


    }

    public function delete($id,Request $request){
        Feature::query()->find($id)->delete();
        return response()->json([]);
    }
}
