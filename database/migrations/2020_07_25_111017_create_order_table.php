<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable()->default(null); //updated by
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->float('amount'); //total order amount after discount

            $table->string('status');
            /*** == Statuses ===
            /* 1: New
            /* 2: Processing
            /* 3: Pending
            /* 4: Dispatched
            /* 5: Completed
            /* 6: Canceled
            /* 7: Aborted
            /* 8: Failed
            /* 9: Refunded
            */
            // order status - Placed, Packing, Dispatched, Delivered, Completed

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
