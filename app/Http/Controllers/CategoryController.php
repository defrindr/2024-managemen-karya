<?php

namespace App\Http\Controllers;

use App\Helpers\RequestHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kategori Karya';
        $items = Category::orderBy('id', 'desc')->paginate();

        return view('pages.admin.category.index', compact('title', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Tambah Kategori Karya';

        return view('pages.admin.category.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        try {
            $payload = $request->validated();

            $response = RequestHelper::uploadImage($request->file('icon'), 'categories');
            if (!$response['success']) {
                session()->flash('error', 'Ikon gagal diunggah');

                return Redirect::route('admin.master.category.create')->withInput();
            }
            $payload['icon'] = $response['fileName'];

            Category::create($payload);
            session()->flash('success', 'Berhasil menambahkan kategori karya!');

            return Redirect::route('admin.master.category.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menambahkan data!');

            return Redirect::route('admin.master.category.create')->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = 'Ubah Kategori Karya';

        return view('pages.admin.category.edit', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $payload = $request->validated();

            if ($request->has('icon')) {
                $response = RequestHelper::uploadImage($request->file('icon'), 'categories');
                if (!$response['success']) {
                    session()->flash('error', 'Ikon gagal diunggah');

                    return Redirect::route('admin.master.category.create')->withInput();
                }
                $payload['icon'] = $response['fileName'];
            } else {
                $payload['icon'] = $category->icon;
            }

            $category->update($payload);
            session()->flash('success', 'Berhasil mengubah kategori karya!');

            return Redirect::route('admin.master.category.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menambahkan data!');

            return Redirect::route('admin.master.category.create')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            session()->flash('success', 'Kategori berhasil dihapus!');

            return Redirect::route('admin.master.category.index');
        } catch (\Throwable $th) {
            session()->flash('error', 'Gagal menghapus data!');

            return Redirect::route('admin.master.category.index');
        }
    }
}
