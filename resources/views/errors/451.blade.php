@extends('errors::base')

@section('title', __('errors.title451'))
@section('code', '451')
@section('message', __($exception->getMessage() ?: 'http-status-messages.451' ))
