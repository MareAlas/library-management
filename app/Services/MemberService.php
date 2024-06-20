<?php

namespace App\Services;

use App\Models\User;
use App\Models\Member;

class MemberService
{
    public function getAllMembers()
    {
        return Member::all();
    }

    public function getMemberById($id)
    {
        return Member::find($id);
    }

    public function createMember($validatedData)
    {
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'member',
        ]);

        return Member::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
        ]);
    }

    public function updateMember($member, $validatedData)
    {
        $member->update($validatedData);

        return $member;
    }

    public function deleteMember($member)
    {
        $member->delete();
    }
}
