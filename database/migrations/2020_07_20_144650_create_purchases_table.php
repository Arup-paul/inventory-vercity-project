<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'purchases', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger( 'supplier_id' );
            $table->unsignedBigInteger( 'category_id' );
            $table->unsignedBigInteger( 'product_id' );
            $table->string( 'purchase_no' );
            $table->date( 'date' );
            $table->string('description')->nullable();
            $table->string('buying_qty');
            $table->string('unit_price');
            $table->string('buying_price');
            $table->tinyInteger( 'status' )->default( '0' );
            $table->integer( 'created_by' )->nullable();
            $table->integer( 'updated_by' )->nullable();
            $table->foreign( 'supplier_id' )->references( 'id' )->on( 'suppliers' )->onDelete( 'cascade' );
            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'cascade' );
            $table->foreign( 'product_id' )->references( 'id' )->on( 'products' )->onDelete( 'cascade' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'purchases' );
    }
}
