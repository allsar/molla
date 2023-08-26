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
            ->select(['id', 'name', 'description', 'created_at', 'updated_at'])
            ->where($request->filled('parent_id'),function ($q) use($request){
                $q->where('parent_id', '=', $request->get('parent_id'));
            }, function ($q) {
                $q->whereNull('parent_id');
            })
            ->orderByDesc('id');
        return DataTables::eloquent($copy)->make(true);
    }

    public function store(CopyRequest $request)
    {
        $data = $request->validated();
        if (!empty($data['method']) && $data['method'] == 1) {
            $data['parent_id'] = $data['parent_id'] == 0 ? null : $data['parent_id'];
            CopyModel::query()->create($data);
        }
        elseif (!empty($data['method']) && $data['method'] == 2){
            CopyModel::query()->find($data['id'])->update([
                'name' => $data['name'],
                'description' => $data['description']
            ]);
        }
        return redirect()->route('copy.index', ['parent_id' => $data['parent_id'] ?? 0]);

    }
}
