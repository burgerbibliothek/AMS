@extends('errors::base')

@section('title', __('errors.title400'))
@section('code', '400')
@section('message', __($exception->getMessage() ?: 'Bad Request'))
