<?php

namespace App\Http\Livewire\Carts;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Cloudinary\Cloudinary;

class CartView extends Component
{

    public $products = [];
    public $total = 0;
    public $cant=0;
    protected $listeners = [
        'updatedCart' => 'updatedCart',
        'confirmShopping' => 'confirmShopping',
    ];
    
    public function mount()
    {
        
    }
    public function render()
    {
        return view('livewire.carts.cart-view');
    }

    public function updatedCart($products=[])
    {
        $this->products = $products?:[];
        $products=json_decode(json_encode($products))?:[];
        $this->cant=count((array)$products);
        $this->total=0;
        foreach ($products as $product) {
            $this->total+=$product->stock->price*$product->cant;
        }
        $this->total=formatNumber($this->total);
    }
    public function confirmShopping($products, $imageData)
    {
        $cloudinary = new Cloudinary();

        //Save $imageData in cloudinary
        $image = $cloudinary->uploadApi()->upload($imageData, [
            "folder" => "images",
            "public_id" => "image_".time(),
            "overwrite" => true,
            "resource_type" => "image"
        ]);
      
        //get $image url from Cloudinary upload response

        
        $urlPath=$image['secure_url'];

        //Save data to database
        
        $name=auth()->user()->name;
        $phone=auth()->user()->phone;
        $title='Preorden de '.$name.'. '.$phone.PHP_EOL;
        $phone='+1'.preg_replace('/[^0-9]/', '', $phone);
        $footer="Contactar a: https://wa.me/{$phone}?text= ";
        $productos="";
        $products=json_decode(json_encode($products))?:[];
        foreach ($products as $product) {
            $productos.=$product->code.' '.$product->name.' x '.$product->cant.' '.$product->stock->unit->symbol .PHP_EOL;
        }
        $message=$title.$productos.$footer;
        //send http post with body $message and header with token
        Http::withToken(env('API_AUTH_TOKEN'))
            ->post(env('API_BASE_URL').'/shoppings/order', [
                'phone' => '8298041907',
                'message' => $message,
                'mediaUrl' => $urlPath,
            ]);
       $this->emit('alert',  'Su orden ha sido enviada.');
    }
}
