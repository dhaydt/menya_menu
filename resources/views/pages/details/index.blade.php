@extends('layouts.app')
@section('content')
  @livewire('pages.details', ['id' => $id])
@endsection