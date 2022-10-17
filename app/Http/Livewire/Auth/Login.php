<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class Login extends Component
{

    protected $listeners = [
        'login' => 'login',
    ];
    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login($data)
    {
       
        dd($data);
    }
}
