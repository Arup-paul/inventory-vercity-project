<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'products', function ( Blueprint $table ) {
            $table->bigIncrements( 'id' );
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('category_id');
            $table->string( 'name' );
            $table->double('quantity')->default(0);
            $table->tinyInteger( 'status' )->default( '1' );
            $table->integer( 'created_by' )->nullable();
            $table->integer( 'updated_by' )->nullable();
            $table->foreign( 'supplier_id' )->references( 'id' )->on( 'suppliers' )->onDelete( 'cascade' );
            $table->foreign( 'unit_id' )->references( 'id' )->on( 'units' )->onDelete( 'cascade' );
            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'cascade' );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'products' );
    }
}
