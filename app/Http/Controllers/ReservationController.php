<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ReservationService;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }
    
    public function index()
    {
        return response()->json($this->reservationService->getAllReservations(), 200);
    }

    public function show($id)
    {
        $reservation = $this->reservationService->getReservationById($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        return response()->json($reservation, 200);
    }

    public function store(StoreReservationRequest $request)
    {
        $user = auth()->user();
        if (!$user || $user->role !== 'member') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = $this->reservationService->createReservation($request->validated(), $user);

        return response()->json($reservation, 201);
    }

    public function update(UpdateReservationRequest $request, $id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = $this->reservationService->getReservationById($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $updatedReservation = $this->reservationService->updateReservation($reservation, $request->validated());

        return response()->json($updatedReservation, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = $this->reservationService->getReservationById($id);

        if (is_null($reservation)) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $this->reservationService->deleteReservation($reservation);

        return response()->json(null, 204);
    }
}
