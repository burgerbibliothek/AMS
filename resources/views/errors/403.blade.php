@extends('errors::base')

@section('title', __('errors.title403'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
