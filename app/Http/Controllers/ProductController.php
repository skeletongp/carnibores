<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{
    public function index()
    {
        return view('pages.products.index');
    }
    public function show($product_id)
    {
        $params = [
            'load' => 'category|image|stock.unit',
        ];
        $response = Http::withToken(env('API_AUTH_TOKEN'))->get(env('API_BASE_URL') . '/products/' . $product_id, $params);
        $product = json_decode(json_encode($response->json()['content']));

        $relateds = [];
        if ($product->category) {
            $params2 = [
                'load' => 'category|image|stock.unit',
                'order' => 'name',
                'asc' => 'true',
                'limit' => '8',
                'category' => $product->category->id,
            ];
            $response2 = Http::withToken(env('API_AUTH_TOKEN'))->get(env('API_BASE_URL') . '/products', $params2);
            $relateds = $response2->json()['content'];
        }
        return view('pages.products.show', compact('product', 'relateds'));
    }
}
