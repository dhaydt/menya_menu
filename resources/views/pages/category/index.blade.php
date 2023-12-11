@extends('layouts.app')
@section('content')
  @livewire('pages.category.list-cat', ['id' => $id])
@endsection