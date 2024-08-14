@extends('layouts.error')

@section('code', '429')
@section('message', __('Too Many Requests'))
@section('description', __('คุณส่งคำขอมากเกินไปในระยะเวลาที่กำหนด'))
