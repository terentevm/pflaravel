<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableItemsExpenditure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_items_expenditure', function (Blueprint $table) {
            $table->uuid('id')->unique()->index();
            $table->uuid('user_id')->index();
            $table->uuid('parent_id')->nullable()->index();
            $table->string('active')->default(true);
            $table->string('name', 150);
            $table->string('comment', 150)->nullable()->default('');

            $table->foreign('user_id')
                ->references('id')->on('users')
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
        Schema::dropIfExists('ref_items_expenditure');
    }
}
