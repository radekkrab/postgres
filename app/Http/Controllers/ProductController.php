<?php

namespace App\Http\Controllers;

use App\Jobs\SendNewProductMailJob;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|min:10',
            'article' => 'required|alpha_num:ascii|unique:products',
            'status' => [],
            'colorSize' => [],
        ]);

        $validated["data"] = $validated["colorSize"];

        unset($validated["colorSize"]);

        Product::create($validated);

        dispatch(new SendNewProductMailJob(['article' => $validated["article"], 'name' => $validated["name"], 'status' => $validated["status"]]));

        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Product $product, Request $request)
    {
        $validated = $request->validate([
            'id' => [],
            'name' => 'required|min:10',
            'article' => 'required|alpha_num:ascii',
            'status' => [],
            'colorSize' => [],
        ]);

        $validated["data"] = $validated["colorSize"];

        unset($validated["colorSize"]);

        $product->update($validated);

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return back();
    }
}
