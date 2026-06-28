<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        $bookings = Booking::with(['user', 'court'])
            ->when($status !== 'all', fn($q) => $q->where('status', $status))
            ->latest()
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $booking->update(['status' => $request->status]);

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }

    public function markPaid(Booking $booking)
    {
        $booking->update([
            'payment_status'    => 'paid',
            'amount_paid'       => $booking->total_price,
            'remaining_payment' => 0,
        ]);

        return back()->with('success', 'Pelunasan berhasil dicatat. Booking dinyatakan LUNAS.');
    }
}
