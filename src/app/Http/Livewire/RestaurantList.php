<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;

class RestaurantList extends Component
{
    public $restaurants;

    public function mount()
    {
        $this->loadData();
    }

    public function loadData()
    {
        $this->restaurants = Restaurant::all();
    }

    public function render()
    {
        return view('livewire.restaurant-list');
    }
}
