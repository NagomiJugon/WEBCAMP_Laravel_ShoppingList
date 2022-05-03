<?php

declare( strict_types = 1 );
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as UserModel;

class UserController extends Controller
{
    public function list() {
        $group_by_column = [ 'users.id' , 'users.name' ];
        $list = UserModel::select( $group_by_column )
            ->selectRaw( 'count( completed_shopping_lists.id ) as item_num' )
            ->leftJoin( 'completed_shopping_lists' , 'users.id' , '=' , 'completed_shopping_lists.user_id' )
            ->groupBy( $group_by_column )
            ->orderBy( 'users.id' )
            ->get();
        return view( 'admin.user.list' , [ 'users' => $list ] );
    }
}
