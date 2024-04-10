<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <style>
            body {
                box-sizing: border-box;
                margin: 0;
                padding: 1em;
                font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: center;
                background-image: linear-gradient(to top, #d5d4d0 0%, #d5d4d0 1%, #eeeeec 31%, #efeeec 75%, #e9e9e7 100%);
                text-shadow: 0px 0px 3px rgba(0,0,0,0.2);
            }

            h1{
                font-size: 4em;
                text-transform: uppercase;
                transform: translate3d(0,-.5em,0);
            }
            
        </style>
    </head>
    <body class="antialiased">
        <h1>@yield('code'): @yield('message')</h1>            
    </body>
</html>
