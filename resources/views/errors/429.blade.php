@extends('layouts.error')

@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description', __('You have sent too many requests in a given amount of time.'))
