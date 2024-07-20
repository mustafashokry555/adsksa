<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponser
{

    protected function SuccessResponse($status, $message, $data)
    {
        return response()->json([
            // 'status'=>$status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    protected function ErrorResponse($status, $message, $data = NULL)
    {
        return response()->json([
            // 'status'=>$status,
            'message' => $message,
            'data' => null,
        ], $status);
    }
}
