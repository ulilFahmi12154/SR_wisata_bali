@props([
    'name'     => '',
    'location' => '',
    'price'    => '',
    'rating'   => '',
    'rank'     => null,
    'tag'      => null,
    'image'    => null,
    'href'     => '#',
])

<article class="dest-mini-card">
    @if($image)
    <div class="dest-mini-media">
        <img src="{{ $image }}" alt="{{ $name }}">
        @if($rank)
            <span class="dest-mini-rank">Rank #{{ $rank }}</span>
        @endif
    </div>
    @endif

    <div class="dest-mini-content">
        <div class="dest-mini-head">
            <h4>{{ $name }}</h4>
            @if($tag)
                <span class="dest-mini-tag">{{ $tag }}</span>
            @endif
        </div>

        <p class="dest-mini-location">{{ $location }}</p>

        <div class="dest-mini-meta">
            <div>
                <span>Price</span>
                <strong>{{ $price }}</strong>
            </div>
            <div>
                <span>Rating</span>
                <strong>{{ $rating }}</strong>
            </div>
        </div>

        <a class="dest-mini-action" href="{{ $href }}">Explore Destination</a>
    </div>
</article>