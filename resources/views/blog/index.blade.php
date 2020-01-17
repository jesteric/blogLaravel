@extends('layouts/app')


@section('content')
<ul>
  @foreach($items as $item)
    <li>{{ $item->id }} - {{ $item->name }}</li>
  @endforeach
</ul>

@endsection
