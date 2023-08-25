<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index()
    {

        return view('admin.categories.index');
    }

    public function getData(Request $request)
    {
        $categories = Category::query()
            ->select(['id', 'name', 'description', 'created_at', 'updated_at'])
            ->when($request->filled('parent_id') && $request->get('parent_id') !=0, function ($q) use ($request) {
                $q->where('parent_id', '=', $request->get('parent_id'));
            }, function ($q) {
                $q->whereNull('parent_id');
            })
            ->orderByDesc('id');
        return DataTables::eloquent($categories)->make(true);

    }

    public function store(CreateCategoryRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['method']) && $data['method'] == 1) {
            $data['parent_id'] = $data['parent_id'] == 0 ? null : $data['parent_id'];
            Category::query()->create($data);
        }
        elseif (!empty($data['method']) && $data['method'] == 2){
            Category::query()->find($data['id'])->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }

        return redirect()->route('categories.index', ['parent_id' => $data['parent_id'] ?? 0]);

    }

    public function getUpdate($id)
    {
        $model = Category::query()->find($id);
        if (!$model) {
            return response()->json(['success' => false, 'message' => 'yogakan']);
        }
        return response()->json(['success' => true, 'content' => view('admin.categories.form', compact(['model']))->render(), 'message' => 'borakan']);
    }

    public function delete($id)
    {
        $categories = Category::query()->findOrFail($id)->delete();
        return redirect()->route('categories.index');

    }

    public function edit($id)
    {
        $categories = Category::query()->find($id);
        return view('admin.categories.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $data = Category::query()->find($id);
        $data->update($request->all());
        return redirect()->route('categories.index');
    }
}
