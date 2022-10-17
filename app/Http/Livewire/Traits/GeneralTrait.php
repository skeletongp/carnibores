<?php
namespace App\Http\Livewire\Traits;

trait GeneralTrait{
    public $search = '';
    public $filters = [];

    
  
    public function search($search)
    {
        $this->search = $search;
        $this->page = 1;
        $this->products = [];
        $this->getData();
    }
    public function filter($filter)
    {
        $this->page = 1;
        $this->products = [];
        $this->filters = $filter;
        $this->getData();
    }
}