<?php

use Illuminate\Support\Facades\Auth;

if (!function_exists('userCan')) {
    function userCan($permission)
    {
        $user = auth()->user();
        return $user && $user->hasPermission($permission);
    }
}
