<?php

namespace App\Http\Livewire\Carts;

use Livewire\Component;

class CartPreview extends Component
{
    public $products = [];
    public $cant=0;
    public $total=0;
    protected $listeners = [
        'updatedCart' => 'updatedCart',
    ];
    public function render()
    {
        return view('livewire.carts.cart-preview');
    }

    public function updatedCart($products)
    {
        $this->products = $products?:[];
        $products=json_decode(json_encode($products))?:[];
        $this->cant=count((array)$products);
        $this->total=0;
        foreach ($products as $product) {
            $this->total+=$product->stock->price*$product->cant;
        }
       
    }
}
