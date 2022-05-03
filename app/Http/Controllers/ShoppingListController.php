<?php

declare( strict_types = 1 );
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShoppingListItemRegisterPostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ShoppingList as ShoppingListModel;
use App\Models\CompletedShoppingList as CompleteShoppingListModel;

class ShoppingListController extends Controller
{
    public function list() {
        $per_page = 5;
        
        $list = ShoppingListModel::where( 'user_id' , Auth::id() )
                                    ->orderBy( 'name' )
                                    ->paginate( $per_page );
        foreach ( $list as $item ) {
            $item[ 'formatted_created_at' ] = $item[ 'created_at' ]->format( 'Y/m/d' );
        }
        
        return view( 'shopping_list.list' , [ 'list' => $list ] );
    }
    
    public function register( ShoppingListItemRegisterPostRequest $request ) {
        $datum = $request->validated();
        
        $datum[ 'user_id' ] = Auth::id();
        
        try {
            $r = ShoppingListModel::create( $datum );
        } catch ( \Throwable $e ) {
            $request->session()->flash( 'front.shopping_list_item_register_failure' , true );
            return redirect( route( 'front.list') );
        }
        
        $request->session()->flash( 'front.shopping_list_item_register_success' , true );
        
        return redirect( route( 'front.list' ) );
    }
    
    public function complete ( Request $request , $shopping_list_id ) {
        try {
            DB::beginTransaction();
            
            $item = $this->getShoppingListModel( $shopping_list_id );
            if ( $item === null ) {
                throw new \Exception( '' );
            }
            
            $item->delete();
            
            $item_datum = $item->toArray();
            unset( $item_datum[ 'created_at' ] );
            unset( $item_datum[ 'updated_at' ] );
            $r = CompleteShoppingListModel::create( $item_datum );
            if ( $r === null ) {
                throw new \Exception( '' );   
            }
            
            DB::commit();
            $request->session()->flash( 'front.shopping_list_item_complete_success' , true );
        } catch ( \Throwable $e) {
            DB::rollback();
            $request->session()->flash( 'front.shopping_list_item_complete_failure' , true );
        }
        
        return redirect( '/shopping_list/list' );
    }
    
    public function delete( Request $request , $shopping_list_id ) {
        $item = $this->getShoppingListModel( $shopping_list_id );
        
        if ( $item !== null ) {
            $item->delete();
            $request->session()->flash( 'front.shopping_list_item_delete_success' , true );
        } else {
            $request->session()->flash( 'front.shopping_list_item_delete_failure' , true );
        }
        
        return redirect( '/shopping_list/list' );
    }
    
    protected function getShoppingListModel( $shopping_list_id ) {
        $item = ShoppingListModel::find( $shopping_list_id );
        if ( $item === null ) {
            return null;
        }
        if ( $item->user_id !== Auth::id() ) {
            return null;
        }
        
        return $item;
    }
}
