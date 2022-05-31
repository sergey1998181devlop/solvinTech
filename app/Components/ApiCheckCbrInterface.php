<?php

namespace App\Components;

use Carbon\Carbon;

interface ApiCheckCbrInterface
{

    /**
     * @return bool
     * @throws ApiCheckCbrException
     */
    public function checkCbrFromApi($date): \Illuminate\Http\JsonResponse;
}
