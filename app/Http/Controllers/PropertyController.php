<?php

namespace App\Http\Controllers;

use App\DTO\PropertyDTO;
use App\DTO\PropertyValue;
use App\Http\Requests\PropertyRequest;
use App\Models\Feature;
use App\Models\Property;
use App\Models\PropertyValues;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PropertyController extends Controller
{
    public function index()
    {
        return view('admin.properties.index');
    }

    public function getData(Request $request)
    {
        $copy = Property::query()
            ->select([
                'id',
                'name',
                'description',
                'created_at as created',
            ])
            ->orderByDesc('id');
        return DataTables::eloquent($copy)->make(true);
    }

    public function store(PropertyRequest $request)
    {
        $data = $request->validated();
        $createProperty = PropertyDTO::fromArray($data);
        $property = Property::query()->create(get_object_vars($createProperty));
        $values = [];
        foreach ($data['properties'] as $item) {
            $values[] = get_object_vars(PropertyValue::fromArray(array_merge($item, ['property_id' => $property->id, 'created_at' => now(), 'updated_at' => now()])));
        }
        PropertyValues::query()->insert($values);
        return redirect()->back()->with('success', 'Property created successfully');

    }

    public function update($id, Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'max:255'],
            'properties' => ['array', 'required'],
        ]);
        $property =PropertyValue::fromArray($data);
        Property::query()->find($id)->update(get_object_vars($property));
        foreach ($data['properties'] as $item) {
            if (isset($item['id'])) {
                PropertyValues::query()->find($item['id'])->update($item);
            } else {
                PropertyValues::query()->create(array_merge($item, ['property_id' => $id]));
            }
        }
        return redirect()->back()->with('success', 'Property updated successfully');


    }

    public function delete($id, Request $request)
    {
        Property::query()->find($id)->delete();
        return response()->json([]);
    }


    public function getPropertyValues($id)
    {
        $values = PropertyValues::query()->where('property_id', $id)->get();
        return response()->json([
            'success' => true,
            'content' => view('admin.properties.ajax.values', compact('values'))->render()
        ]);

    }
}
