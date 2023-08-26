<?php

namespace App\Traits;
use Illuminate\Http\Request;
trait ApiResponseTrait
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message,$code=200)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['errors'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    public function sendException(\Exception $exception,$msg="Something Went Wrong. Please Try Again"){
        return $this->sendError($msg,[
            'error' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'code' => $exception->getCode(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTraceAsString()
        ],500);
    }
}
