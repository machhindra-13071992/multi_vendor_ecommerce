<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
           $table->bigIncrements('id');
           $table->uuid('uuid');
           $table->string('name');
           $table->string('image_file');
		   $table->tinyInteger('active')->default(1);
           $table->timestamp('created_at')->nullable();
           $table->timestamp('updated_at')->nullable();
           $table->integer('created_by');
           $table->integer('modified_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
