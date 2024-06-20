<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(Reservation::all(), 200);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        return response()->json($reservation, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'reserved_at' => 'required|date',
        ]);

        $reservation = Reservation::create($validatedData);

        return response()->json($reservation, 201);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validatedData = $request->validate([
            'book_id' => 'required|exists:books,id',
            'member_id' => 'required|exists:members,id',
            'reserved_at' => 'required|date',
        ]);

        $reservation->update($validatedData);

        return response()->json($reservation, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();

        return response()->json(null, 204);
    }
}
