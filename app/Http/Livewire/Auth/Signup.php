<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class Signup extends Component
{
    protected $listeners = ['signup'];
    public function render()
    {
        return view('livewire.auth.signup');
    }

    public function signup($data)
    {
        $validation=Validator::make($data,[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|unique:users',
        ]);

        if ($validation->fails()) {
            return $this->emit('alert', implode(PHP_EOL,$validation->errors()->all()), 'error', 5000);
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
        ]);
        Auth::login($user);
        return redirect()->route('home');
    }
}
