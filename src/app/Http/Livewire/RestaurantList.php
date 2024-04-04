<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Review;

class RestaurantList extends Component
{
    public $restaurants;

    public function mount()
    {
        $this->restaurants = Restaurant::all();
        $this->loadData();
    }

    public function loadData()
    {
        $this->restaurants = Restaurant::all();

        $averageRatings = Review::selectRaw('restaurant_id, AVG(rating) as average_rating')
                            ->groupBy('restaurant_id')
                            ->pluck('average_rating', 'restaurant_id');

        // 各レストランの平均評価を設定
        foreach ($this->restaurants as $restaurant) {
            $averageRating = $averageRatings->get($restaurant->id);
            $restaurant->average_rating = $averageRating !== null ? round($averageRating, 2) : 'NoRating';
        }
    }

    public function render()
    {
        return view('livewire.restaurant-list');
    }
}
