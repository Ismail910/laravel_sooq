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
        Schema::create('help_centers', function (Blueprint $table) {
            $table->id();
            $table->string("vid_category")->nullable();
            $table->text("link");
            $table->string("title");
            $table->string("subtitle")->nullable();
            $table->tinyInteger("hidden")->default(0); // 0 => false - 1 => true
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
        Schema::dropIfExists('help_centers');
    }
};
