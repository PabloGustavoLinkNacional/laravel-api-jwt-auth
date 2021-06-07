<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller{

    public function user_permissions(){
        return Auth::user()->permission;
    }

}
