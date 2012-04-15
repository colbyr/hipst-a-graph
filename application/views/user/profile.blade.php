@layout('layouts.default')

@section('content')

<div class="grid-12">

    <div class="profile media">

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

    <div class="achievements">

        <h2>Achievement Stream</h2>

    </div>

</div>

<div class="grid-4">

    <div class="favorites">

        <h3>Favorites</h3>

    </div>

</div>

@endsection