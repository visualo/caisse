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
        Schema::create('numeraries', function (Blueprint $table) {
            $table->id();
            $table->integer('value');            
            $table->enum('type', ['banknote','coin','cent']);
            $table->enum('status', ['accept','reject'])->default('accept');

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
        Schema::dropIfExists('numeraries');
    }
};
