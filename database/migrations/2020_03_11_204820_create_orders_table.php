<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('pastel_id');
            $table->string('status')->default(\App\Models\Order::ORDER_RECEIVED);
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients')
                ->onDelete('cascade');

            $table
                ->foreign('pastel_id')
                ->references('id')
                ->on('pastels')
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
        Schema::dropIfExists('orders');
    }
}
