<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Search extends Component
{
    
    public $search = '';

    protected $queryString = [
        'search' => ['except' => ''],
    ];
    public $names=[];
    public function mount(){
        $params=[
            'select' => 'name',
        ];
        $response=Http::withToken(env('API_AUTH_TOKEN'))
        ->get(env('API_BASE_URL').'/products', $params);
        $data=$response->json()['content'];
        $this->names=array_column($data, 'name');
    }
    public function render()
    {
        return view('livewire.search');
    }
   

    public function search()
    {
        $this->emit('search', $this->search);
    }
}
