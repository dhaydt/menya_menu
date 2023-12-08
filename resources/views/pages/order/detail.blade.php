@extends('layouts.app')
@section('content')
  @livewire('order.detail', ['id' => $order_id])
@endsection