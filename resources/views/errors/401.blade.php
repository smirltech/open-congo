@extends('errors.minimal')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __('Unauthorized'))
@section('url', __('Please contact the system administrator.'))