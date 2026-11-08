@extends('layouts.app')

@section('title', "#{$workshop->id} | {$workshop->title} - WorkshopHub")

@section('content')
    <div class="mb-8 flex flex-col gap-1">
        <div class="text-4xl text-secondary">{{ $workshop->title }}</div>
        <div class="text-2xl text-accent">{{ $workshop->description }}</div>
    </div>

    <div class="flex flex-col gap-4">
        <div class="grid grid-cols-4 gap-4">
            <div class="shadow h-32 flex-1 rounded-2xl p-6 flex flex-col justify-between">
                <div class="text-xl">Capacity</div>
                <div class="text-4xl font-semibold">{{ $workshop->capacity }}</div>
            </div>
            <div class="shadow h-32 flex-1 rounded-2xl p-6 flex flex-col justify-between">
                <div class="text-xl">Category</div>
                <div class="text-4xl font-semibold">{{ $workshop->category?->name }}</div>
            </div>
            <div class="shadow h-32 flex-1 rounded-2xl p-6 flex flex-col justify-between">
                <div class="text-xl">Start Date</div>
                <div class="text-4xl font-semibold">{{ $workshop->starts_at->format('d/m/y') }}</div>
            </div>
            <div class="shadow h-32 flex-1 rounded-2xl p-6 flex flex-col justify-between">
                <div class="text-xl">Start Time</div>
                <div class="text-4xl font-semibold">{{ $workshop->starts_at->format('H:i') }}</div>
            </div>
        </div>
        <div class="flex gap-1">
            <a href="{{ route('workshops.edit', $workshop) }}" class="self-start bg-black text-white rounded-2xl py-2 px-4">
                Edit Workshop
            </a>
            <form action="{{ route('workshops.destroy', $workshop) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white rounded-2xl py-2 px-4 hover:cursor-pointer">
                    Delete Workshop
                </button>
            </form>
        </div>
    </div>

@endsection
