@extends('errors::base')

@section('title', __('errors.title410'))
@section('code', '410')
@section('message', __($exception->getMessage() ?: 'Gone'))
