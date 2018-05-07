@extends('user\app')

@section('bg-img',Storage::disk('local')->url($visitor->image))

@section('head')
    <link rel="stylesheet" href="{{ asset('user/css/prism.css') }}">
@endsection


@section('title',$visitor->name)
@section('sub-heading',$visitor->surname)

@section('main-content')

    <hr>

@endsection
@section('footer')
    <script src="{{ asset('user/js/prism.js') }}"></script>
@endsection