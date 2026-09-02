@extends('errors::base')

@section('title', __('errors.title410'))
@section('code', '410')
@section('message')
{!! __('errors.message410' ?: 'Gone') !!}
@endsection
