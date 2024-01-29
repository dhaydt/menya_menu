@extends('layouts.app')
@section('content')
  @livewire('pages.detail_banner', ['id' => $id])
@endsection