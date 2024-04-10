@extends('errors::minimal')

@section('title', __(''))
@section('code', '400')
@section('message', __($exception->getMessage() ?: 'Bad Request'))
