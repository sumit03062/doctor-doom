@extends('layouts.app')

@section('content')
    @include('components.home.hero')
    @include('components.home.about')
    @include('components.home.service')
    @include('components.home.appointment', ['doctors' => $doctors])
    @include('components.home.contact')
@endsection
