<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenucategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menucategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type_accumulation');
            $table->integer('shop_id');
            $table->string('description');
            $table->string('is_selected');
            $table->engine='Innodb';
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
        Schema::create('menucategories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('type_accumulation');
            $table->integer('shop_id');
            $table->string('description');
            $table->string('is_selected');
            $table->engine='Innodb';
            $table->timestamps();
        });
    }
}
