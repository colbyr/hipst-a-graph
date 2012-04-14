<h1>Register</h1>

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

<p>Have an account? {{ HTML::link('login', 'Login') }}</p>