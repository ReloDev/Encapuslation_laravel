<?php

namespace App\Services;


class Utility
{
    public function apiResponse($status,$data,$message){

        return response()->json([
            'status_code' => $status,
            'data' =>$data,
            'message' => $message,
        ], 200);
    }
}
