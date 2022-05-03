<?php

declare( strict_types = 1 );
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompletedShoppingList as CompletedShoppingListModel;

class CompletedShoppingListController extends Controller
{
    public function list() {
        $per_page = 5;
        
        $list = CompletedShoppingListModel::where( 'user_id' , Auth::id() )
                                    ->orderBy( 'created_at' , 'DESC' )
                                    ->paginate( $per_page );
        
        foreach ( $list as $item ) {
            $item[ 'formatted_created_at' ] = $item[ 'created_at' ]->format( 'Y/m/d' );
        }
        
        return view( 'shopping_list.completed_list' , [ 'list' => $list ] );
    }
}
