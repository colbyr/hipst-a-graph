@layout('layouts.default')

@section('content')

<div class="grid-12">

    <h2>Login</h2>

    @if (isset($error))
    <p class="error">{{ $error }}</p>
    @endif

    {{ Form::open() }}

    {{ Form::label('username', 'Username') }}
    {{ Form::text('username') }}

    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}

    {{ Form::submit('Login') }}

    {{ Form::close() }}

    <p>Don't have an account? {{ HTML::link('login/new', 'Register') }}</p>

</div>

@endsection