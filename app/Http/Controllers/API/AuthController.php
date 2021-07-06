<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use JWTAuth;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use stdClass;
use App\Http\Traits\CommonTrait;
use App\Models\User;
use App\Models\OnBoardSubmit;

class AuthController extends Controller
{

    use CommonTrait;

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
            'password' => 'required|string|min:6|max:50',
            'login_type' => 'required|in:email,facebook,google'
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
