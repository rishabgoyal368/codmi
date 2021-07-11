<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\CommonTrait;
use App\Models\CookProfile;

class CookController extends Controller
{

    use CommonTrait;

    public function uploadProof(Request $request)
    {
        $data = $request->all();
        $user = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($data, [
            'proof' => 'required|max:10000',
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        } else {
            $proof = '';
            if ($request->proof) {
                $proof = $request->proof->getClientOriginalName() . '_' . time() . '.' . $request->proof->extension();
                $request->proof->move(public_path(CookProfile::PROOFPATH), $proof);
            }
            CookProfile::create([
                'user_id' => $user['id'],
                'proof' => $proof,
                'proof_status' => CookProfile::PROOFDEACTIVATE,
            ]);
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['message'] = 'Profile updated successfuly';
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
    }
}
