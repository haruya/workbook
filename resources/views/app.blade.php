<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>workbook</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	.required {
		color: red;
		font-size: 90%;
	}
	.catEria {
		text-align: right;
		margin: -22px 10px 10px 0;
	}
	.catTag {
		color: #ffffff;
		background: green;
		padding: 1px 5px;
		border-radius: 2px;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
	}
	</style>
	<link type="text/css" rel="stylesheet" href="{{ asset('/syntaxhighlighter/styles/shCore.css') }}" />
	<link type="text/css" rel="stylesheet" href="{{ asset('/syntaxhighlighter/styles/shThemeDefault.css') }}" />
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shCore.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushBash.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushCpp.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushCSharp.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushCss.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushDelphi.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushDiff.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushGroovy.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushJava.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushJScript.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushPhp.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushPlain.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushPython.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushRuby.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushScala.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushSql.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushVb.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/syntaxhighlighter/scripts/shBrushXml.js') }}"></script>
	<script type="text/javascript">
		SyntaxHighlighter.config.clipboardSwf = "{{ asset('/syntaxhighlighter/scripts/clipboard.swf') }}";
		SyntaxHighlighter.all();
	</script>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{url('/')}}">workbook</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<!-- <li><a href="{{ url('/auth/register') }}">Register</a></li> -->
					@else
						@if (Auth::user()->role_id == 2)
							<li><a href="{{ url('/users') }}">ユーザー情報</a></li>
						@endif
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('/js/myScript.js') }}"></script>
</body>
</html>
