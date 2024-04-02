<select wire:model="selectedArea" name="area" class="area" autocomplete="address-level1">
        <option value="">All area</option>
        @foreach ($areas as $area)
            <option value="{{ $area }}">{{ $area }}</option>
        @endforeach
    </select>
    <select wire:model="selectedGenre" name="genre" class="genre" autocomplete="off">
        <option value="">All genre</option>
        @foreach ($genres as $genre)
            <option value="{{ $genre }}">{{ $genre }}</option>
        @endforeach
    </select>
    <input type="text" wire:model.debounce.300ms="searchTerm" name="name" class="name" placeholder="Search..." autocomplete="off">

    