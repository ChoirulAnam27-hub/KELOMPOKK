<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Court;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())->with('court')->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Court $court)
    {
        return view('bookings.create', compact('court'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'court_id'     => 'required|exists:courts,id',
            'date'         => 'required|date|after_or_equal:today',
            'start_time'   => 'required|date_format:H:i',
            'end_time'     => 'required|date_format:H:i|after:start_time',
            'payment_type' => 'required|in:dp,lunas',
        ]);

        $court = Court::findOrFail($request->court_id);

        // Hitung durasi & total harga
        $start         = Carbon::parse($request->start_time);
        $end           = Carbon::parse($request->end_time);
        $durationHours = $start->diffInMinutes($end) / 60;
        $totalPrice    = $court->price_per_hour * $durationHours;

        // Hitung nominal berdasarkan pilihan pembayaran
        if ($request->payment_type === 'dp') {
            $amountPaid       = $totalPrice * 0.5;   // DP 50%
            $remainingPayment = $totalPrice * 0.5;   // Sisa 50%
            $paymentStatus    = 'dp_paid';
        } else {
            $amountPaid       = $totalPrice;          // Lunas
            $remainingPayment = 0;
            $paymentStatus    = 'paid';
        }

        // Cek jadwal bentrok
        $conflict = Booking::where('court_id', $court->id)
            ->where('date', $request->date)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_time', [$request->start_time, $request->end_time])
                      ->orWhereBetween('end_time', [$request->start_time, $request->end_time])
                      ->orWhere(function ($q) use ($request) {
                          $q->where('start_time', '<=', $request->start_time)
                            ->where('end_time', '>=', $request->end_time);
                      });
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if ($conflict) {
            return back()->with('error', 'Jadwal tersebut sudah dibooking. Silakan pilih waktu lain.');
        }

        Booking::create([
            'user_id'          => auth()->id(),
            'court_id'         => $court->id,
            'date'             => $request->date,
            'start_time'       => $request->start_time,
            'end_time'         => $request->end_time,
            'total_price'      => $totalPrice,
            'payment_type'     => $request->payment_type,
            'amount_paid'      => $amountPaid,
            'remaining_payment'=> $remainingPayment,
            'payment_status'   => $paymentStatus,
            'status'           => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dibuat! Silakan bayar ' . ($request->payment_type === 'dp' ? 'DP (50%)' : 'lunas') . ' saat tiba di lapangan.');
    }
}
