<?php

namespace App\Services;

use App\Models\Reservation;

class ReservationService
{
    public function getAllReservations()
    {
        return Reservation::all();
    }

    public function getReservationById($id)
    {
        return Reservation::find($id);
    }

    public function createReservation($validatedData, $user)
    {
        return Reservation::create([
            'book_id' => $validatedData['book_id'],
            'member_id' => $user->member->id,
            'reserved_at' => now(),
        ]);
    }

    public function updateReservation($reservation, $validatedData)
    {
        $reservation->update($validatedData);

        return $reservation;
    }

    public function deleteReservation($reservation)
    {
        $reservation->delete();
    }
}
