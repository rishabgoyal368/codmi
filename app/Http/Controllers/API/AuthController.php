<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use stdClass;

class AuthController extends Controller
{

    protected function commonResponse($data)
    {
        $response['code'] = $data['code'];
        $response['status'] = $data['status'];
        $response['message'] = $data['message'];
        $response['data'] = @$data['data'];
        return $response;
    }

    public function user_register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
        $data['password'] = Hash::make($data['password']);
        $data['status'] = User::PENDINGSTATUS;
        $data['type'] = User::USERTYPE;
        User::addEdit($data);
        $data['code'] = 200;
        $data['status'] = 'success';
        $data['message'] = 'User registration successfully';
        $data['data'] = new \stdClass();
        return $this->commonResponse($data);
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
        try {
            if (!$tkn = JWTAuth::attempt($credentials)) {
                $data['code'] = 400;
                $data['status'] = 'error';
                $data['message'] = 'You have entered wrong credentials';
                $data['data'] = new \stdClass();
                return $this->commonResponse($data);
            }
            $token = new \stdClass();
            $token->token = $tkn;
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['message'] = 'User login successfully';
            $data['data'] = $token;
            return $this->commonResponse($data);
        } catch (JWTException $e) {
            $data['code'] = 400;
            $data['status'] = 'error';
            $data['message'] = $e->getMessage();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
    }

    public function logout(Request $request)
    {
        //valid credential
        $validator = Validator::make($request->only('token'), [
            'token' => 'required'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        //Request is validated, do logout        
        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'success' => true,
                'message' => 'User has been logged out'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, user cannot be logged out'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get_user(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        $user = JWTAuth::authenticate($request->token);

        return response()->json(['user' => $user]);
    }
}
