@layout('layouts.default')

@section('content')

<div class="grid-12">
    
    <h2>Authorization</h2>

    <p>To use Hipst-a-graph you need to authorize your Etsy account</p>
    {{ HTML::link('oauth/auth', 'Authorize') }}

</div>

@endsection