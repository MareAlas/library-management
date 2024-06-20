<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Services\MemberService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

class MemberController extends Controller
{
    protected $memberService;

    public function __construct(MemberService $memberService)
    {
        $this->memberService = $memberService;
    }

    public function index()
    {
        return response()->json($this->memberService->getAllMembers(), 200);
    }

    public function show($id)
    {
        $member = $this->memberService->getMemberById($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        return response()->json($member, 200);
    }

    public function store(StoreMemberRequest $request)
    {
        $member = $this->memberService->createMember($request->validated());

        return response()->json($member, 201);
    }

    public function update(UpdateMemberRequest $request, $id)
    {
        $member = $this->memberService->getMemberById($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $updatedMember = $this->memberService->updateMember($member, $request->validated());

        return response()->json($member, 200);
    }


    public function destroy($id)
    {
        if (Gate::denies('admin-only')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $member = $this->memberService->getMemberById($id);

        if (is_null($member)) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $this->memberService->deleteMember($member);

        return response()->json(null, 204);
    }

}
