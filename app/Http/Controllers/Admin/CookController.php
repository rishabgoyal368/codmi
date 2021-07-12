<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CookProfile;
use App\Models\OnBoardSubmit;
use App\Models\User;

class CookController extends Controller
{

    public function list()
    {
        $users = CookProfile::with('user')->get();
        return view('admin.cook.list', compact('users'));
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status == CookProfile::PROOFDEACTIVATE ? CookProfile::PROOFACTIVATE : CookProfile::PROOFDEACTIVATE;
        $cookProfile = CookProfile::where('id', $id)->first();
        $cookProfile->proof_status = $status;
        $user_id = $cookProfile->user_id;
        $cookProfile->save();
        if ($status == CookProfile::PROOFACTIVATE) {
            $type = User::COOKTYPE;
        } else if ($status == CookProfile::PROOFDEACTIVATE) {
            $type = User::USERTYPE;
        }
        User::where('id', $user_id)->update([
            'type' => $type,
        ]);

        return response()->json(['message' => 'Proof Status changed', 'code' => 200]);
    }

    public function onBoardResult($id)
    {
        $results = OnBoardSubmit::where('user_id', $id)->get();
        return view('admin.users.onBoard', compact('results'));
    }
}
