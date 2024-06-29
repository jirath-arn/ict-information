@extends('layouts.error')

@section('code', '401')
@section('message', __('Unauthorized'))
@section('description', __('It lacks valid authentication credentials for the requested resource.'))
