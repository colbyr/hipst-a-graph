@layout('layouts.default')

@section('content')

<div class="grid-4">

    <div class="score">
        <h1 class="no-buffer text-left">{{ $user->score }} HP*</h1>
        <p class="note no-buffer">* HP = <i>hipster points</i></p>
    </div>

</div>

<div class="grid-8">

    <div class="profile media section">

        <div class="img">
            {{ HTML::image($user->avatar_url, '', array('no-buffer')) }}
        </div>

        <div class="body">

            <h1 class="no-buffer">{{ $user->name() }}.</h1>

            <p class="no-buffer">[{{ HTML::link($user->profile_link(), 'view etsy profile', array('target'=>'_blank')) }}]</p>

        </div>

    </div>

</div>



<div class="grid-8">

    <div class="achievements section">

        <h2>Achievement Stream</h2>

        <ul class="list-none">

        @forelse($user->achievements as $achievement)
            <li class="media">

                <div class="img">
                    {{ HTML::image('img/achievement-small.png') }}
                </div>

                <div class="body">
                    <h3 class="orange no-buffer">{{ $achievement->name }}</h3>
                    <p  class="no-buffer">{{ $achievement->description }}</p>
                </div>
            </li>
        @empty
            <li>No achievements... Hipster fail :(</li>
        @endforelse

        </ul>

    </div>

</div>

<div class="grid-4">

    <div class="favorites section">

        <h3>Favorites</h3>

        <ul class="list-none">

        @foreach($favorites as $fav)

            <li class="media">

                <a class="favorite" title="View on Etsy" href="{{ $fav->Listing->url }}" target="_blank">

                    <div class="img">
                        {{ HTML::image($fav->Listing->MainImage->url_75x75) }}
                    </div>

                    <div class="body">
                        {{ Str::limit($fav->Listing->title, 50) }}
                    </div>

                </a>

            </li>

        @endforeach

        </ul>

    </div>

</div>

@endsection