<?php

namespace App\Facades;

class JsonResponse
{
    public static function json($result)
    {
        echo json_encode($result);
    }
}
