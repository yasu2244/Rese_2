<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;
use App\Models\Review;
use Illuminate\Support\Facades\DB;

class Search extends Component
{
    public $selectedArea;
    public $selectedGenre;
    public $searchTerm;

    public function render()
    {
        // データベースからエリアの値を取得
        $areas = Restaurant::distinct()->pluck('region');

        // データベースからジャンルの値を取得
        $genres = Restaurant::distinct()->pluck('genre');

        // 飲食店のデータを取得
        $restaurants = Restaurant::query();

        if ($this->selectedArea) {
            $restaurants->where('region', $this->selectedArea);
        }

        if ($this->selectedGenre) {
            $restaurants->where('genre', $this->selectedGenre);
        }

        if ($this->searchTerm) {
            $restaurants->where('name', 'like', '%'.$this->searchTerm.'%');
        }

        $restaurants = $restaurants->get();

        // 飲食店ごとの平均評価のデータを取得
        $averageRatings = Review::select('restaurant_id', DB::raw('AVG(rating) as average_rating'))
            ->groupBy('restaurant_id')
            ->get();

           

        return view('livewire.search', [
            'restaurants' => $restaurants,
            'averageRatings' => $averageRatings,
            'areas' => $areas,
            'genres' => $genres,
        ]);
    }
}
