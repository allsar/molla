<?php

namespace App\Http\Controllers;

use App\DTO\FeatureDTO;
use App\DTO\FeatureValueDTO;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use App\Models\FeatureValue;
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
        $createFeature = FeatureDTO::fromArray($data);
        $feature = Feature::query()->create(get_object_vars($createFeature));
        $values = [];
        foreach ($data['features'] as $item) {
            $values[] = get_object_vars(FeatureValueDTO::fromArray(array_merge($item, ['feature_id' => $feature->id, 'created_at' => now(), 'updated_at' => now()])));
        }
        FeatureValue::query()->insert($values);
        return redirect()->back()->with('success', 'Feature created successfully');

    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'features' => ['array', 'required'],
        ]);
        $feature = FeatureDTO::fromArray($data);
        Feature::query()->find($id)->update(get_object_vars($feature));
        foreach ($data['features'] as $item) {
            if (isset($item['id'])) {
                FeatureValue::query()->find($item['id'])->update($item);
            } else {
                FeatureValue::query()->create(array_merge($item, ['feature_id' => $id]));
            }
        }
        return redirect()->back()->with('success', 'Feature updated successfully');


    }

    public function delete($id, Request $request)
    {
        Feature::query()->find($id)->delete();
        return response()->json([]);
    }


    public function getFeauteValues($id)
    {
        $values = FeatureValue::query()->where('feature_id', $id)->get();
        return response()->json([
            'success' => true,
            'content' => view('admin.features.ajax.values', compact('values'))->render()
        ]);

    }
}
