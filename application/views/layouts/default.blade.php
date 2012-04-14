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


<div class="grid-12 header">

    <h1>Hipst-a-graph</h1>

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