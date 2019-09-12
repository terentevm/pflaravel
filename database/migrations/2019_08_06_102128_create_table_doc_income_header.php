<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDocIncomeHeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_income_header', function (Blueprint $table) {
            $table->uuid('id')->unique()->index();
            $table->uuid('user_id')->index();
            $table->date('date');
            $table->string('comment', 150)->nullable()->default('');
            $table->decimal('sum', 15, 2);
            $table->timestamps();

            $table->index(['date', 'user_id'], 'idx_income_h_date_user');
            $table->index(['date','created_at']);

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
        Schema::dropIfExists('doc_income_header');
    }
}
