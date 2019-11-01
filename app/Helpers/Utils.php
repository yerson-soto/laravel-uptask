<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Utils {

    public static function generateSlug($from) {
        return strtolower(preg_replace('/\s+/', '-', $from)).'-'.Str::random(6);
    }

    public static function getRouteParam($paramName) {
        return request()->route()->parameter($paramName);
    }
}
