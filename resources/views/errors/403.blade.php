@extends('errors::minimal', ['color' => '#fea918', 'text'=>__('Forbidden')])

@section('title', __('403:Forbidden'))
@section('code', 'YOUR SESSION HAS EXPIRED')
@section('message', 'Click to Sign In')
