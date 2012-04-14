<!DOCTYPE html>
<html>

<head>

<title>Hipst-a-graph</title>

<!-- styles -->
{{Asset::styles()}}
@section('styles')
@yield_section

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- scripts -->
{{Asset::container('header')->scripts()}}

</head>

<body class="wrapper">


<div class="grids header">

    <div class="grid-8">
        <h1>Hipst-a-graph</h1>
    </div>

    <div class="grid-4 text-right">
    @if (Auth::check())
        <p>Logged in as {{ HTML::link('user/profile', Auth::user()->username) }}, {{ HTML::link('login/leave', 'logout') }}?</p>
    @else
        <p>{{ HTML::link('login', 'Login') }}</p>
    @endif
    </div>

</div>

<!-- content -->
<div class="content grids">

@yield('content')

</div>


<!-- footer -->
<div class="footer">

</div>

</div><!-- end wrapper -->

<!-- scripts -->
{{Asset::container('footer')->scripts()}}

</body>

</html>