<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    public function show($id)
    {
        $member = Member::find($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return response()->json($member, 200);
    }

    public function store(Request $request)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members',
        ]);

        $member = Member::create($validatedData);

        return response()->json($member, 201);
    }

    public function update(Request $request, $id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $member = Member::find($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:members,email,' . $id,
        ]);

        $member->update($validatedData);

        return response()->json($member, 200);
    }

    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $member = Member::find($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();

        return response()->json(null, 204);
    }

}
