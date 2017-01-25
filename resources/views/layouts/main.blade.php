<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>{{ isset($title) ? $title . ' - ' . config('app.name') : config('app.name') }}</title>
		<link rel="stylesheet" href="{{ url('/css/app.css') }}">
		<link rel="stylesheet" href="{{ url('/css/font-awesome.css') }}">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	</head>
	<body>
		@yield('header')
		@yield('content')
		@yield('footer')
    	<script src="{{ url('/js/app.js') }}"></script>
		<script type="text/javascript">
			window.appBaseUrl = '{{ url('/') }}';
		</script>
		@yield('scripts')
	</body>
</html>
