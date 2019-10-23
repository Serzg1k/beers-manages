<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBeersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beers', function (Blueprint $table) {
            $table->bigIncrements('id')->index();
            $table->string('name', 100)->unique();
            $table->text('description');
            $table->unsignedBigInteger('make_id')->nullable()->index();
            $table->unsignedBigInteger('type_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('make_id')
                ->references('id')
                ->on('makes');
            $table->foreign('type_id')
                ->references('id')
                ->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beers');
    }
}
