@layout('layouts.default')

@section('content')

<div class="grid-12">

    <h2>Profile</h2>

    <pre>{{ print_r(Auth::user()) }}</pre>

</div>

@endsection