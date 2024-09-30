<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            font-family: monospace;
        }

        p,
        h1 {
            overflow-wrap: break-word;
        }

        ul {
            padding-inline-start: 1em;
        }
    </style>
</head>
<body>
    <h1>{{ __('search.title', ['uri' => $uri]) }}</h1>
    <ul>
        @foreach ($results as $ark)
        <li><a href="/ark:{{ $ark }}/?info" title="{{ __('search.linkTitle', ['ark' => $ark]) }}">{{ $ark }}</a></p>
            @endforeach
    </ul>
</body>
</html>