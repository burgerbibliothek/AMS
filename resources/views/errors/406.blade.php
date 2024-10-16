@extends('errors::base')

@section('title', __('errors.title406'))
@section('code', '406')
@section('message', __($exception->getMessage() ?: 'Not Acceptable'))
