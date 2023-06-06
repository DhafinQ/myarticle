<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('category_menu');
        return view('master.category');
    }

    public function listCategory()
    {
        $categories = Category::all();
        return response()->json([
        'massage' => 'List Article',
        'data' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('category_create');
        $request->validate([
            'category' => 'required|unique:categories,name',
        ]);

        $data = ['name' => $request->category];

        Category::create($data);

        return response()->json([
            'message' => 'Category Added!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('category_read');
        $category = Category::findOrFail($id);
        return response()->json([
            'message' => 'detail dokumen!',
            'data' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('category_update');
        $request->validate([
            'category' => 'required|unique:categories,name,' . $id
        ]);

        $data = ['name' => $request->category];

        $category = Category::findOrFail($id);

        $update = $category->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'Category Updated!',
            'data' => $update
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deletes(Request $request)
    {
        $this->authorize('category_delete');
        for($i=0;$i<count($request->id);$i++){
            $category = Category::findOrFail($request->id[$i]);
            $category->delete();
        }

        return response()->json([
            'message' => 'Category Deleted!'
        ]);
    }
}
