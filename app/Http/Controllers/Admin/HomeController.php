<?php

declare( strict_types = 1 );
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AdminLoginPostRequest;

class HomeController extends Controller
{
    public function top() {
        return view( 'admin.top' );
    }
    
    
}
