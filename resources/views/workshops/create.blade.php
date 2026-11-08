@extends('layouts.app')

@section('title', 'Create Workshop - WorkshopHub')

@section('content')
    <div class="text-4xl mb-6 h-16">Create Workshop</div>

    <div class="flex justify-center items-center w-full">
        @include('workshops._form', [
            'workshop' => $workshop,
        ])
    </div>
@endsection
