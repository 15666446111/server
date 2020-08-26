<!DOCTYPE HTML>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>

	    <meta http-equiv=Content-Type content=text/html; charset=utf-8 />

	    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	    
	    <title>页面找不到啦</title>
    
    </head>

    <body style="width: 100%; padding: 0; margin: 0">
		<img src="{{ asset('images/404.jpg') }}?t={{ time() }}" style="width: 100%; max-width: 100%" />
    </body>
</html>