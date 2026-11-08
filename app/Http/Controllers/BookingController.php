<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\Booking;
use App\Models\Workshop;

class BookingController extends Controller
{
    public function store(Request $request, Workshop $workshop) {
        $validated = $request->validate([
            'attendee_name' => 'required|string|max:100',
            'attendee_email' => 'required|email|max:255'
        ]);

        // Reject a workshop that has already started.
        if($workshop->starts_at <= now()) {
            throw ValidationException::withMessages([
                'booking' => 'This workshop has already started.',
            ]);
        }

        // Reject a workshop with no places left.
        $bookingCount = $workshop->bookings()->count();

        if($bookingCount >= $workshop->capacity) {
            throw ValidationException::withMessages([
                'booking' => 'This workshop is full',
            ]);
        }

        // Reject the same email booking this workshop again.
        $alreadyBooked = $workshop->bookings()->where('attendee_email', $validated['attendee_email'])->exists();

        if ($alreadyBooked) {
            throw ValidationException::withMessages([
                'attendee_email' => 'This email has already booked this workshop.',
            ]);
        }

        $workshop->bookings()->create($validated);

        return redirect()->route('workshops.show', $workshop)->with('success', 'Booking created successfully');
    }

    public function destroy(Booking $booking) {
        $workshopId = $booking->workshop_id;
        $booking->delete();

        return redirect()->route('workshops.show', $workshopId)->with('success', 'Booking cancelled successfully');
    }
}
