@extends('layouts.error')

@section('code', '503')
@section('message', __('Service Unavailable'))
@section('description', __('The server is not ready to handle the request.'))
