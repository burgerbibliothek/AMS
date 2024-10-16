@extends('base')

@section('content')
    @parent
    <h1>{{__('errors.error')}} @yield('code')</h1>
    <p>@yield('message')</p>
@endsection
