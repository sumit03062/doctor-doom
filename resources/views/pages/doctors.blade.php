@extends('layouts.app')

@section('content')
    @include('components.doctors.hero')
    @include('components.doctors.listing', ['doctors' => $doctors])
    @include('components.doctors.cta')
@endsection
