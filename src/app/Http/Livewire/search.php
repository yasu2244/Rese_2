<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Restaurant;

class Search extends Component
{
    public $selectedArea;
    public $selectedGenre;
    public $searchTerm;
    public $restaurants;
    public $areas;
    public $genres;

    public function mount()
    {
        $this->areas = Restaurant::select('region')->distinct()->pluck('region');
        $this->genres = Restaurant::select('genre')->distinct()->pluck('genre');
        $this->loadData();
    }

    public function loadData()
    {
        $this->restaurants = Restaurant::query()->get();
    }

    public function updated($field)
    {
        $fieldsToUpdate = ['selectedArea', 'selectedGenre', 'searchTerm'];

        if (in_array($field, $fieldsToUpdate)) {
            $this->restaurants = $this->getFilteredRestaurants();
        }
    }

    private function getFilteredRestaurants()
    {
        $query = Restaurant::query();

        if ($this->selectedArea) {
            $query->where('region', $this->selectedArea);
        }

        if ($this->selectedGenre) {
            $query->where('genre', $this->selectedGenre);
        }

        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%');
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.search')
        ->with('areas', $this->areas)
        ->with('genres', $this->genres);
    }
}

