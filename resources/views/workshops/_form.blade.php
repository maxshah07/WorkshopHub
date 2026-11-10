@php
    $editing = $workshop?->exists ?? false;
@endphp

<form action="{{ $editing ? route('workshops.update', $workshop) : route('workshops.store') }}" method="post"
    class="w-1/2">
    @csrf

    @if ($editing)
        @method('PUT')
    @endif

    <div class="flex flex-col border-2 border-solid border-black p-6 rounded-3xl gap-6">
        {{-- Title --}}
        <div class="flex flex-col gap-1">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $workshop->title) }}"
                placeholder="e.g. Programming Class" class="border-2 border-black p-3 border-solid rounded-2xl">
            @error('title')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Description --}}
        <div class="flex flex-col gap-1">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description', $workshop->description) }}"
                placeholder="e.g. This class features..." class="border-2 border-black p-3 border-solid rounded-2xl">
            @error('description')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Start Date and Time --}}
        <div class="flex flex-col gap-1">
            <label for="starts_at">Start Date and Time</label>
            <input type="datetime-local" name="starts_at" id="starts_at" value="{{ old('starts_at', $workshop->starts_at) }}"
                class="border-2 border-black p-3 border-solid rounded-2xl">
            @error('starts_at')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Capacity --}}
        <div class="flex flex-col gap-1">
            <label for="capacity">Capacity</label>
            <input type="number" min="0" name="capacity" id="capacity" value="{{ old('capacity', $workshop->capacity) }}"
                class="border-2 border-black p-3 border-solid rounded-2xl">
            @error('capacity')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        {{-- Category --}}
        <div class="flex flex-col gap-1">
            <label for="category_id">Category</label>
            <select name="category_id" id="category_id" class="border-2 border-black p-3 border-solid rounded-2xl">
                @forelse ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id', $workshop->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @empty
                    <option value="">No categories available</option>
                @endforelse
            </select>
            @error('category_id')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-2">
            <button type="button" onclick="window.location.href='{{ $editing ? route('workshops.show', $workshop) : route('workshops.index') }}'"
                class="flex-2 border-2 border-black py-2 px-3 rounded-2xl hover:cursor-pointer">Cancel</button>
            <button type="submit"
                class="bg-black text-white py-2 px-3 rounded-2xl flex-2 hover:cursor-pointer">Save</button>
        </div>
    </div>
</form>
