@layout('layouts.default')

@section('content')

    <div class="grid-8">

	    <h1 class="blue">The King of the Hipsters:</h1>

        <ol class="top list-none">
        @forelse($top_users as $user)
            <li class="media">

                <div class="media">

                <div class="img media">

                    <div class="img">
                        {{ HTML::image($user->avatar_url, $user->name()) }}
                    </div>

                    <div class="body">
                        <h2 class="buffer-bottom">{{ HTML::link('/user/profile/' . $user->id, $user->name()) }}</h2>
                        <p class="no-buffer">[{{ HTML::link($user->profile_link(), 'view etsy profile', array('target'=>'_blank')) }}]</p>
                    </div>

                </div>

                <div class="body">
                    <h3 class="score no-buffer">{{ $user->score }} HP</h3>
                </div>

                </div>

            </li>
        @empty
            <li>No hipsters here.. :(</li>
        @endforelse
        </ol>

    </div>

    <div class="grid-4">
        <h2 class="buffer-top">About Hipst-a-board</h2>
    </div>

@endsection