<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->double('montant');
            $table->text('description');
            $table->enum("status", [0,1,2]);//0 :Waiting | 1 :Accepted | 2:Rejected
            $table->string("pays");
            $table->string("file");
            //user
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //payment
            $table->foreignId('paiement_id');
            $table->foreign('paiement_id')->references('id')->on('paiements')->onDelete('cascade');
            //devise
            $table->foreignId('devise_id');
            $table->foreign('devise_id')->references('id')->on('devises')->onDelete('cascade');
            //catgeory
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
        Schema::dropIfExists('depenses');
    }
}
