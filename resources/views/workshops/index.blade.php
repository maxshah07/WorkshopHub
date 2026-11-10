@extends('layouts.app')

@section('title', 'Workshops - WorkshopHub')

@section('content')
    <div class="text-4xl mb-8 h-16">Workshops</div>

    <div class="flex flex-col gap-4">
        <a href="{{ route('workshops.create') }}" class="self-start bg-black text-white rounded-2xl py-2 px-4">
            Create Workshop +
        </a>

        <form action="{{ route('workshops.index') }}" method="GET"
            class="flex gap-4 mb-8">

            {{-- Search --}}
            <input
                type="text"
                name="search"
                placeholder="Search workshops..."
                value="{{ request('search') }}"
                class="border rounded-lg p-3"
            >

            {{-- Category filter --}}
            <select name="category_id" class="border rounded-lg p-3">
                <option value="">All categories</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(request('category_id') == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="bg-secondary text-white p-3 rounded-lg">
                Filter
            </button>

            <a href="{{ route('workshops.index') }}" class="p-3">
                Clear
            </a>
        </form>

        @forelse ($workshops as $workshop)
            <a href="{{ route('workshops.show', $workshop) }}">
                <div class="w-full h-32 shadow rounded-3xl p-6 flex">
                    <div class="flex items-center justify-start gap-4">
                        <img src="https://placehold.co/600x400" alt="placeholer image" class="h-full">
                        <div class="flex flex-col items-start justify-center">
                            <div>{{ $workshop->title }}</div>
                            <div>{{ $workshop->description }}</div>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div>No workshops.</div>
        @endforelse


        <div class="mt-8">
            {{ $workshops->links() }}
        </div>
    </div>
@endsection
