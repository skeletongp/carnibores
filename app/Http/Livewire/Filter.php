<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Filter extends Component
{
    public $categories = [];
    public $selectedCategories = [];
    public $filters = [];
    public $fromPrice=0; 
    public $toPrice=500;
    public function mount()
    {
        $this->getCategories();
    }


    public function render()
    {
        return view('livewire.filter');
    }

    public function getCategories()
    {
        $params = [
            'select' => 'name,id',
        ];
        $response = Http::withToken(env('API_AUTH_TOKEN'))
            ->get(env('API_BASE_URL') . '/categories', $params);
        $data = $response->json()['content'];
        foreach ($data as $key => $value) {
            $this->categories[$value['id']] = $value['name'];
        }
    }

    public function filterCat($value)
    {
        if (in_array($value, $this->selectedCategories)) {
            $this->selectedCategories = array_diff($this->selectedCategories, [$value]);
        } else {
            array_push($this->selectedCategories, $value);
        }
            $value = implode(',', $this->selectedCategories);
            $this->filters["category"] = $value;
            if($value == ''){
                unset($this->filters["category"]);
            }
        $this->emit('filter', $this->filters);
    }
    
    public function filter(){
        $this->filters["fromPrice"] =$this->fromPrice;
        $this->filters["toPrice"] =$this->toPrice;
        $this->emit('filter', $this->filters);
    }

   
}
