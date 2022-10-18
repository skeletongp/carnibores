<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Filter extends Component
{
    public $categories = [];
    public $selectedCategories = [];
    public $filters = [];
    public $fromPrice = 0;
    public $toPrice = 500;
    public $order = 'order,id';
    public $direction= 'asc';

   

    public function mount()
    {
        $this->filters['sort']=[
            'order' => 'id',
            'direction' => $this->direction,
        ];
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
        if ($value == '') {
            unset($this->filters["category"]);
        }
        $this->emit('filter', $this->filters);
    }
    public function updatedDirection(){
        $this->filter();
    }
    public function filter()
    {
        $this->filters["fromPrice"] = $this->fromPrice;
        $this->filters["toPrice"] = $this->toPrice;

        $orders = explode(',', $this->order);
        if (count($orders) == 2) {
            $this->filters['sort']=[
                $orders[0],
            ];
            $this->filters[$this->filters['sort'][0]] = $orders[1].','.$this->direction;
        }
        $this->emit('filter', $this->filters);
    }
}
