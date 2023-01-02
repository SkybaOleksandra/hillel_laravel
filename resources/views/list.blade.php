<div class="container" class="mt-10">
    <ul class="list-group">
        @foreach($links as $link)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{ $link['link'] }}">{{ $link['name'] }}</a>
            </li>
        @endforeach
    </ul>
</div>
