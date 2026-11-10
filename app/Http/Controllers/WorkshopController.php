<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Workshop;
use App\Models\Category;

class WorkshopController extends Controller
{
    private function validateWorkshop(Request $request) {
        return $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:2000',
            'starts_at' => 'required|date',
            'capacity' => 'required|integer|min:1|max:100'
        ]);
    }

    public function index(Request $request) {
        $validated = $request->validate([
            'search' => 'nullable|string|max:100',
            'category_id' => 'nullable|integer|exists:categories,id',
        ]);

        $search = $validated['search'] ?? null;
        $categoryId = $validated['category_id'] ?? null;

        $workshops = Workshop::query()->with('category')
            ->when($search, function($query) use ($search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->when($categoryId, function($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->orderBy('starts_at')
            ->orderBy('title')
            ->paginate(6)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('workshops.index', compact('workshops', 'categories'));
    }

    public function show(Workshop $workshop) {
        $workshop->load(['category', 'bookings']);
        return view('workshops.show', compact('workshop'));
    }

    public function create() {
        $categories = Category::orderBy('name')->get();
        $workshop = new Workshop;

        return view('workshops.create', compact('categories', 'workshop'));
    }

    public function store(Request $request) {
        $validated = $this->validateWorkshop($request);

        Workshop::create($validated);

        return redirect()->route('workshops.index')->with('success', 'Workshop created successfully');
    }

    public function edit(Workshop $workshop) {
        $categories = Category::orderBy('name')->get();

        return view('workshops.edit', compact('workshop', 'categories'));
    }

    public function update(Request $request, Workshop $workshop) {
        $validated = $this->validateWorkshop($request);

        $bookingCount = $workshop->bookings()->count();

        if ($validated['capacity'] < $bookingCount) {
            throw ValidationException::withMessages([
                'capacity' => "Capacity cannot be less than {$bookingCount} because that many bookings already exist.",
            ]);
        }

        $workshop->update($validated);

        return redirect()->route('workshops.show', $workshop)->with('success', 'Workshop updated successfully');
    }

    public function destroy(Workshop $workshop) {
        $workshop->delete();

        return redirect()->route('workshops.index')->with('success', 'Workshop deleted successfully');
    }
}