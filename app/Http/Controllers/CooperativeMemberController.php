<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CooperativeMember;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Utils;

class CooperativeMemberController extends Controller
{
    public function index()
    {
        $cooperativeMembers = CooperativeMember::all();
        return response()->json($cooperativeMembers);
    }

    public function store(Request $request)
    {
        $user = auth('api')->user();
        $data = $request->all();
        $cooperativeMember = CooperativeMember::create($data);
        return Utils::apiSuccess($cooperativeMember, 'Cooperative Member submitted successfully.');
    }

    public function show($id)
    {
        $cooperativeMember = CooperativeMember::findOrFail($id);

        return response()->json($cooperativeMember);
    }

    public function update(Request $request, $id)
    {
        $cooperativeMember = CooperativeMember::findOrFail($id);

        $data = $request->all();
        $cooperativeMember->update($data);
        return Utils::apiSuccess($cooperativeMember, 'Cooperative Member edited successfully.');
    }

    public function destroy($id)
    {
        $cooperativeMember = CooperativeMember::findOrFail($id);
        $cooperativeMember->delete();
        return Utils::apiSuccess($cooperativeMember, 'Cooperative Member deleted successfully.');
    }
}
