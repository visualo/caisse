<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caissedays', function (Blueprint $table) {
            $table->id();
            $table->timestamp('open_time');
            $table->timestamp('close_time')->nullable();
            $table->double('open_amount');
            $table->double('close_amount')->nullable();
            $table->bigInteger('caisse_id');
            $table->bigInteger('user_id');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caissedays');
    }
};
