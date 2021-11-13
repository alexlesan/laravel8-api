<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(25);

        return $this->handleResponse(ProductResource::collection($products), "Product list");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->safe()->all());
        return $this->handleResponse(new ProductResource($product), "New product was created", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        if (is_null($product)) {
            return $this->handleError("Product was not found", []);
        }
        return $this->handleResponse(new ProductResource($product), "Product details");
    }


    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->safe()->all());
        return $this->handleResponse(new ProductResource($product), "Product updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return $this->handleResponse(new ProductResource($product), "Product was deleted.");
    }


    /**
     * Search for a product
     */
    public function search($title)
    {
        $products = Product::where('product_name', 'like', '%' . $title . '%')->get();
        return $this->handleResponse(ProductResource::collection($products), "Search product result.");
    }
}
