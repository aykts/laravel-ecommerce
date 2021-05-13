<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_details', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 15);
            $table->unsignedBigInteger('catalog_id');
            $table->string('catalog_name', 150);
            $table->string('title', 150)->nullable();
            $table->string('slug', 250);
            $table->text('catalog_description')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('catalog_id')->references('id')->on('catalogs')
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
        Schema::dropIfExists('catalog_details');
    }
}
