<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        Validator::make($data,[
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($data)) {
            return redirect()->route('home');
        }
    }
}
