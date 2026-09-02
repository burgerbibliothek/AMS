@extends('errors::base')

@section('title', __('errors.title400'))
@section('code', '400')
@section('message')
@if($exception->getMessage())
    {{ $exception->getMessage() }}
@else
    {!! __('errors.message400') !!}
@endif
@endsection
