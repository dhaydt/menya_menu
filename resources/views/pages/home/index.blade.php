@extends('layouts.app')
@section('content')
  @include('pages.home.partials._banner')
  @livewire('category-home')
  @livewire('category-list')
@endsection