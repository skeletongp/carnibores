<?php
namespace App\Http\Livewire;

interface InterfaceComponent
{
    public function search($search);
    public function filter($filter);
    public function getData();

}