<?php

namespace App\Traits;

trait GeneralTrait
{
    public function returnError($errNum, $msg, $isVerify = true)
    {
        if (empty($errNum)) {
            $errNum = '403';
        }

        return response()->json([
            'status' => false,
            'msg' => $msg,
            'is_verify' => $isVerify,
        ], $errNum);
    }

    public function returnSuccessMassage($msg = '', $status = true, $code = '200')
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ], $code);
    }

    public function returnSuccessMessage($msg = '', $status = true, $code = '200')
    {
        return response()->json([
            'status' => $status,
            'msg' => $msg,
        ], $code);
    }

    public function returnData($key, $value, $msg = '', $isVerify = true)
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value,
            'is_verify' => $isVerify
        ], 200);
    }

    public function returnArrayData($data, $msg = '')
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            'data' => $data,
        ], 200);
    }

    public function returnValidationError($code, $validator)
    {
        return $this->returnError($code, $validator->errors()->first());
    }
}
