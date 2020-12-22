<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipsToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->Biginteger('order_id')->unsigned()->change();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')
                    ->onDelete('cascade');

            $table->Biginteger('product_id')->unsigned()->change();
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')
                    ->onDelete('cascade');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('orders_details_order_id_foreign');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropIndex('orders_details_order_id_foreign');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('order_id')->change();
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('orders_details_product_id_foreign');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropIndex('orders_details_product_id_foreign');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('product_id')->change();
        });
    }
}
