<?php

namespace App\Http\Traits;

trait CommonTrait
{

    public function commonResponse($data)
    {
        $response['code'] = $data['code'];
        $response['status'] = $data['status'];
        $response['message'] = $data['message'];
        $response['data'] = @$data['data'];
        return $response;
    }

    public function onBoardingQuestion()
    {
        $data = array(
            array(
                'id' => 1,
                'question' => "What's your profession?",
            ),
            array(
                'id' => 2,
                'question' => "What cuisine do you love making?",
            ),
            array(
                'id' => 3,
                'question' => "How often would you be ablet?",
            ),
            array(
                'id' => 4,
                'question' => "How many dishes can you comfortably cook?",
            ),
        );
        return $data;
    }
}
