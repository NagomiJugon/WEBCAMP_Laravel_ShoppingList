<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->id();
            $table->string( 'name' , 191 )->comment( '「買うもの」名(商品名)' );
            $table->unsignedBigInteger( 'user_id' )->comment( '「買うもの」登録者');
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->datetime( 'created_at' )->useCurrent();
            $table->datetime( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
            
            $table->collation = 'utf8mb4_bin' ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shopping_lists');
    }
}
