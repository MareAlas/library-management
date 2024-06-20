<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

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

    public function store(StoreMemberRequest $request)
    {
        $validatedData = $request->validated();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'member',
        ]);

        $member = Member::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
        ]);

        return response()->json($member, 201);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $member = Member::find($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->update($request->validated());

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
