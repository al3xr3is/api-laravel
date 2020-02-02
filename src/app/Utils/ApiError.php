<?php

namespace app\Api;

class ApiError {

    public static function errorMessage($message, $code) {
        return [
            'data' => [
                'msg' => $message,
                'code' => $code
            ]
        ];
    }
}
