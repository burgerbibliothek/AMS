<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="generator" content="ARK Management System">
    <link rel="icon" href="https://ark.diani.xyz/favicon.svg" />
    <title>@yield('title')</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        * {
            margin: 0;
        }

        body {
            line-height: 1.5;
            -webkit-font-smoothing: antialiased;
            margin: 1em;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue",sans-serif;
        }

        p,
        h1 {
            font-size: 1em;
            overflow-wrap: break-word;
        }
        
        h1{
            font-size: 1.25em;
            font-weight: 600;
        }
        

        ul {
            list-style: none;
            padding: 0;
        }

        li::before{
            content: '🔑 '
        }
    </style>
</head>
<body>
    <main>
        @yield('content')
    </main>
</body>
</html>