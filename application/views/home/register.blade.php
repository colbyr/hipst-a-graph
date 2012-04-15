@layout('layouts.default')

@section('content')

<div class="grid-12">

    <h1>Register</h1>

    @if (isset($error))
    <p class="error">{{ $error }}</p>
    @endif

    {{ Form::open() }}

    {{ Form::label('username', 'Choose a username...') }}
    {{ Form::text('username') }}

    {{ Form::label('password', '...and a password') }}
    {{ Form::password('password') }}

    {{ Form::submit('Login') }}

    {{ Form::close() }}

    <p>Have an account? {{ HTML::link('login', 'Login') }}</p>

</div>

@endsection