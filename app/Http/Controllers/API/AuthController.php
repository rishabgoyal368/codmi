<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use stdClass;
use App\Http\Traits\CommonTrait;
use App\Models\User;
use App\Models\OnBoardSubmit;
use App\Models\DeviceToken;

class AuthController extends Controller
{

    use CommonTrait;

    public function user_register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50',
            'login_type' => 'required|in:email,facebook,google',
            'type' => 'required|in:1,2'
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
        $input = $request->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50',
            'fcm_token' => 'required',
            'device_type' => 'required|in:android,ios',
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
        try {
            $credentials = $request->only('email', 'password');
            if (!$tkn = JWTAuth::attempt($credentials)) {
                $data['code'] = 400;
                $data['status'] = 'error';
                $data['message'] = 'You have entered wrong credentials';
                $data['data'] = new \stdClass();
                return $this->commonResponse($data);
            }

            $devicetoken = DeviceToken::where('fcm_token', $request->fcm_token)->first();
            if (empty($devicetoken)) {
                $devicetoken = new DeviceToken();
            }
            $devicetoken->fcm_token = $request->fcm_token;
            $devicetoken->user_id = user::where('email', $request->email)->value('id');
            $devicetoken->device_type = @$request->device_type;
            $devicetoken->save();


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

    public function getOnboadingQuestion()
    {
        $question =  $this->onBoardingQuestion();
        $data['code'] = 200;
        $data['status'] = 'success';
        $data['message'] = 'Onboard Question';
        $data['data'] = $question;
        return $this->commonResponse($data);
    }

    public function submitOnboadingQuestion(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'answer' => 'required',
            'question_id' => 'required',
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        } else {
            $user = JWTAuth::parseToken()->authenticate();
            OnBoardSubmit::updateOrcreate(
                [
                    'question_id' => $request->question_id,
                    'user_id' => $user->id
                ],
                [
                    'answer' => $request->answer
                ]
            );
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['message'] = 'Onboard Question submit successfully';
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
    }

    public function getProfile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user['profile_pic'] = $user->getProfileImage();
        $data['code'] = 200;
        $data['status'] = 'success';
        $data['message'] = 'User Profile';
        $data['data'] = $user;
        return $this->commonResponse($data);
    }

    public function updateProfile(Request $request)
    {
        $data = $request->all();
        $user = JWTAuth::parseToken()->authenticate();
        $validator = Validator::make($data, [
            'name' => 'required|max:35',
            'email' => 'required|email|unique:users,email,' . $user['id'] . ',id,deleted_at,NULL',
            'profile_pic' => 'nullable|mimes:jpeg,jpg,png|max:10000',
            'mobile_number' => 'required|numeric',
            // 'gender' => 'required|in:male,female,others',
        ]);
        if ($validator->fails()) {
            $data['code'] = 404;
            $data['status'] = 'error';
            $data['message'] = $validator->errors()->first();
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        } else {
            if ($request->profile_pic) {
                $profile_pic = $request->profile_pic->getClientOriginalName() . '_' . time() . '.' . $request->profile_pic->extension();
                $request->profile_pic->move(public_path(User::PROFILE_PIC), $profile_pic);
                $user->profile_pic = $profile_pic;
            }
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->mobile_number = $data['mobile_number'];
            // $user->gender = $data['gender'];
            $user->save();
            $data['code'] = 200;
            $data['status'] = 'success';
            $data['message'] = 'Profile updated successfuly';
            $data['data'] = new \stdClass();
            return $this->commonResponse($data);
        }
    }
}
