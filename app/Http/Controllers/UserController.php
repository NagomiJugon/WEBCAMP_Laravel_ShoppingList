<?php

declare( strict_types = 1 );
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Requests\UserRegisterPost;
use Illuminate\Support\Facades\Hash;
use App\Models\User as UserModel;

class UserController extends Controller
{
    /**
     * 会員登録画面表示
     */
    public function index() {
        return view( 'user.register' );
    }
    
    /**
     * ユーザー新規登録処理
     */
    public function register( UserRegisterPost $request ) {
        $datum = $request->validated();
        
        $datum[ 'password' ] = Hash::make( $datum[ 'password' ] );
        
        try {
            $r = UserModel::create( $datum );
        } catch ( \Throwable $e ) {
            $request->session()->flash( 'front.user_register_failure' , true );
            return redirect( route( 'front.index' ) );
        }
        
        $request->session()->flash( 'front.user_register_success' , true );
        
        return redirect( route( 'front.index' ) );
    }
}
