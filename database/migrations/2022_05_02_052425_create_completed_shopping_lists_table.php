<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompletedShoppingListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completed_shopping_lists', function (Blueprint $table) {
            $table->unsignedInteger( 'id' );
            $table->string( 'name' , 191 )->comment( '「買うもの」名' );
            $table->unsignedBigInteger( 'user_id' )->comment( '「買うもの」購入者' );
            $table->datetime( 'created_at' )->useCurrent()->comment( '「買うもの」購入日' );
            $table->datetime( 'updated_at' )->useCurrent()->useCurrentOnUpdate();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' );
            $table->primary( 'id' );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completed_shopping_lists');
    }
}
