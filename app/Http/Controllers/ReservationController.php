<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

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

    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'book_id' => $request->book_id,
            'member_id' => auth()->user()->member->id,
            'reserved_at' => now(),
        ]);

        return response()->json($reservation, 201);
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        $reservation = Reservation::find($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->update($request->validated());

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
