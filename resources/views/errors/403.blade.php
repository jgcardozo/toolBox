@extends('errors::minimal', ['color' => '#fea918', 'text'=>__('Forbidden')])

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __('Forbidden'))
