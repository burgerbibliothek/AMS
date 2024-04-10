@extends('errors::minimal')

@section('title', __(''))
@section('code', '406')
@section('message', __($exception->getMessage() ?: 'Not Acceptable'))
