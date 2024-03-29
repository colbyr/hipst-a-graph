<!DOCTYPE html>
<html>

<head>

<title>Hipst-a-board</title>

<meta charset=UTF-8>
<meta name=viewport content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

<!-- styles -->
{{Asset::styles()}}
@section('styles')
@yield_section

<!-- icons -->
<link rel="shortcut icon" href="{{ URL::to_asset('img/logo-xsmall.png') }}"/>
<link rel="apple-touch-icon-precomposed" href="{{ URL::to_asset('img/logo-large.png') }}"/>

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- scripts -->
{{Asset::container('header')->scripts()}}

</head>

<body>


<div class="header">

    <div class="header-inner">
    {{ HTML::image('img/logo-xsmall-w.png') }}
    <h1 class="title no-buffer">{{ HTML::link('/', 'Hipst-a-board') }}</h1>

    @if (Auth::check())
        <p>Logged in as {{ HTML::link('user/profile', Auth::user()->name()) }} --- {{ HTML::link('login/leave', 'logout') }}</p>
    @else
        <p>{{ HTML::link('login', 'Login') }}</p>
    @endif
    </div>

</div>

<div class="wrapper">

<!-- errors -->
<div class="messages grids">

  @if(isset($message))
  <div class="grid-12">
    <p class="msg msg-{{ $message['type'] }}">
      <strong class="dark">{{ Str::title($message['type']) }}:</strong>
      {{ $message['text'] }}
    </p>
  </div>
  @endif

</div>

<!-- content -->
<div class="content grids">

@yield('content')

</div>


<!-- footer -->
<div class="footer"></div>

</div><!-- end wrapper -->

<!-- scripts -->
{{Asset::container('footer')->scripts()}}

<!-- fonts -->
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Averia+Serif+Libre::latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>

</body>

</html>