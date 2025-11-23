<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TechStack;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TechStackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search ?? null;
        $sort = $request->sort ?? 10;

        $techstack = TechStack::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        })
            ->orderBy('id', 'DESC')
            ->paginate($sort)
            ->appends(request()->query());

        return view('admin.techstack.index', compact('techstack'));
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "icon_class" => "required|string|max:255",
            "category" => "nullable|string|max:255"
        ], [
            'required' => ':attribute wajib diisi.',
        ]);

        $validation->setAttributeNames([
            'name' => 'Nama',
            'icon_class' => 'Icon',
            'category' => 'Kategori'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'errors' => $validation->errors()]);
        }

        TechStack::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon_class' => $request->icon_class,
            'category' => $request->category
        ]);

        return response()->json(['status' => true, 'message' => 'Berhasil menyimpan data.']);
    }

    public function show($id)
    {
        $data = TechStack::find($id);

        if (!$data) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);

        return response()->json(['status' => true, 'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "icon_class" => "required|string|max:255",
            "category" => "nullable|string|max:255"
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => false, 'errors' => $validation->errors()]);
        }

        $data = TechStack::find($id);
        if (!$data) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);

        $data->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'icon_class' => $request->icon_class,
            'category' => $request->category
        ]);

        return response()->json(['status' => true, 'message' => 'Berhasil memperbarui data.']);
    }

    public function destroy($id)
    {
        $data = TechStack::find($id);
        if (!$data) return response()->json(['status' => false, 'message' => 'Data tidak ditemukan']);

        $data->delete();
        return response()->json(['status' => true, 'message' => 'Berhasil menghapus data.']);
    }
}
