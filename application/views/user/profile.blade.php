@layout('layouts.default')

@section('content')

<div class="grid-12">

    <div class="profile media section">

        <div class="img">
            {{ HTML::image($user->avatar_url, '', array('no-buffer')) }}
        </div>

        <div class="body">

            <h1 class="no-buffer">{{ $user->first_name }} {{ Str::limit($user->last_name, 1, '') }}.</h1>

            <p class="no-buffer">[{{ HTML::link($user->profile_link(), 'view on etsy', array('target'=>'_blank')) }}]

        </div>

    </div>

</div>

<div class="grid-8">

    <div class="achievements section">

        <h2>Achievement Stream</h2>

    </div>

</div>

<div class="grid-4">

    <div class="favorites section">

        <h3>Favorites</h3>

        <ul class="list-none">

        @foreach($favorites as $fav)

            <li class="media">

            <a href="{{ $fav->Listing->url }}" target="_blank">

                <div class="img">
                    {{ HTML::image($fav->Listing->MainImage->url_75x75) }}
                </div>

                <div class="body">
                    {{ $fav->Listing->title }}
                </div>

            </a>

            </li>

        @endforeach

        </ul>

    </div>

</div>

@endsection