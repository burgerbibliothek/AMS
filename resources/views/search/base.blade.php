@extends('base')

@section('title', __('search.titleURI', ['uri' => $uri]))
@section('content')
<h1>{{ __('search.titleURI', ['uri' => $uri]) }}</h1>
@if (count($results) > 0)
<ul>
    @foreach ($results as $ark)
    <li><a href="/ark:{{ $ark }}/?info" title="{{ __('search.linkTitleURI', ['ark' => $ark]) }}">{{ $ark }}</a></p>
     @endforeach
</ul>
@else
<p>{{ __('search.searchresultURI') }}</p>
@endif
@endsection
