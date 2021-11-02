<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public  function sendSuccess($data, $message = "Success")
    {
        $response = [
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response, 200);
    }

    public function notFound($message = "Resources not available")
    {
        $response = [
            'message' => $message,
        ];
        return response()->json($response, 404);
    }

    public function badRequest($message)
    {
        $response = [
            'message' => $message
        ];
        return response()->json($response, 422);
    }

    public function serverError($message = "Internal server error")
    {
        $response = [
            'message' => $message
        ];
        return response()->json($response, 500);
    }
}
