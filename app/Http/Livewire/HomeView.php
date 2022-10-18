<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class HomeView extends Component implements InterfaceComponent
{
    use GeneralTrait;

    protected $listeners = [
        'search' => 'search',
        'filter' => 'filter',
    ];
    protected $queryString = [
        'search' => ['except' => ''],
        'filters' => ['except' => []],
    ];

    public $products = [];

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.home-view');
    }

    public function getData()
    {
        try {
            $params = array_merge([
                'load' => 'category|image|stock.unit',
                'limit' => 4,
                'random' => 1,
                'search' => $this->search,
                'fromPrice'=>32,
                'hasCategory' => 1,
            ], $this->filters);
            $response = Http::withToken(env('API_AUTH_TOKEN'))
                ->get(env('API_BASE_URL') . '/products', $params);
            $data = $response->json();
            $this->products = $data['content'];
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
