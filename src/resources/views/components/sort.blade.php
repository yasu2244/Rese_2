<form id="sortForm" action="{{ url('/') }}" method="GET">
    <select name="order" id="order" onchange="document.getElementById('sortForm').submit();">
        <option value="random" {{ request('order') == 'random' ? 'selected' : '' }}>ランダム順</option>
        <option value="high_rating" {{ request('order') == 'high_rating' ? 'selected' : '' }}>評価が高い順</option>
        <option value="low_rating" {{ request('order') == 'low_rating' ? 'selected' : '' }}>評価が低い順</option>
    </select>
</form>

<script src="{{ asset('js/sort.js') }}"></script>
