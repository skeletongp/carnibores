<?php

namespace App\Http\Livewire\Products;

use App\Http\Livewire\InterfaceComponent;
use App\Http\Livewire\Traits\GeneralTrait;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ProductView extends Component implements InterfaceComponent
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
    public $page = 1;
    public $lastPage = 1;
    
  

    public function mount()
    {
        $this->getData();
    }

    public function render()
    {
        return view('livewire.products.product-view');
    }
    public function getData()
    {

        $params = array_merge([
            'load' => 'category|image|stock.unit',
            'paginate' => 'true',
            'perpage' => '12',
            'page' => $this->page,
            'asc' => 'true',
            'search' => $this->search,
        ], $this->filters);
        try {
            $response = Http::withToken(env('API_AUTH_TOKEN'))
                ->get(env('API_BASE_URL') . '/products', $params);
            if ($response->successful()) {
                $data = $response->json()['content'];
                $this->products = array_merge($this->products, $data['data']);
                $this->lastPage = $data['meta']['last_page'];
                $this->emit('productsLoaded');
            } else {
                dd($response->json());
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
    public function loadMore()
    {
        if ($this->page < $this->lastPage) {
            $this->page++;
            $this->getData();
        }
    }
   
}
