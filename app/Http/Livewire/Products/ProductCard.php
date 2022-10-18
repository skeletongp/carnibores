<?php

namespace App\Http\Livewire\Products;

use Livewire\Component;

class ProductCard extends Component
{
    public $product;
    public float $cant = 1;
    public function render()
    {
        $prod=json_decode(json_encode($this->product));
        


        return view('livewire.products.product-card', compact('prod'));
    }

    //Function addCant if cant is less than 999
    public function addCant()
    {
        if ($this->cant < 999) {
            $this->cant++;
        }
    }

    //Function subCant if cant is greater than 1
    public function subCant()
    {
        if ($this->cant > 1) {
            $this->cant--;
            
        }
    }

    //On updated cant if is less than 1 set 1 and if is greater than 999 set 999
    public function updatedCant()
    {
        if ($this->cant < 1) {
            $this->cant = 1;
        } elseif ($this->cant > 999) {
            $this->cant = 999;
        }
    }

    //Function addProductToCart
    public function addProductToCart()
    {
        $product=$this->product;
        $cant=$this->cant;
        $product['cant']=$cant;
        $this->reset('cant');
        
        $this->emit('addProductToCart', $product);

    }
}
