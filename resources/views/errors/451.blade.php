@extends('errors::minimal')

@section('title', __(''))
@section('code', '451')
@section('message', __($exception->getMessage() ?: 'http-status-messages.451' ))
