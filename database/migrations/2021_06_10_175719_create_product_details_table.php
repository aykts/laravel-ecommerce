<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->string('lang', 50)->nullable();
            $table->unsignedBigInteger('product_id');
            $table->string('slug', 350);
            $table->string('model', 50);
            $table->string('title', 300);
            $table->unsignedBigInteger('brand_id');
            $table->decimal('weight');
            $table->text('description');
            $table->string('meta_description', 250);
            $table->string('meta_keyword', 250);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();

            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_details');
    }
}
