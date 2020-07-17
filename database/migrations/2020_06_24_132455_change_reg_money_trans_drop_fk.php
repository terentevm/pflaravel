<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeRegMoneyTransDropFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_money_trans', function (Blueprint $table) {
            $table->dropForeign(['expend_id']);
            $table->dropForeign(['income_id']);
            $table->dropForeign(['transfer_id']);
            $table->dropForeign(['cb_id']);
            $table->dropForeign(['lend_id']);

            $table->dropColumn('expend_id');
            $table->dropColumn('income_id');
            $table->dropColumn('transfer_id');
            $table->dropColumn('cb_id');
            $table->dropColumn('lend_id');
        });

        $this->createTriggerHandler();
        $this->createTriggers();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropTriggers();
        $this->dropTriggerHandler();

        Schema::table('reg_money_trans', function (Blueprint $table) {
            $table->uuid('expend_id')->nullable();
            $table->uuid('income_id')->nullable();
            $table->uuid('transfer_id')->nullable();
            $table->uuid('cb_id')->nullable();
            $table->uuid('lend_id')->nullable();

            $table->foreign('expend_id')
                ->references('id')->on('doc_expenses_header')
                ->onDelete('cascade');

            $table->foreign('income_id')
                ->references('id')->on('doc_income_header')
                ->onDelete('cascade');

            $table->foreign('transfer_id')
                ->references('id')->on('doc_transfers')
                ->onDelete('cascade');

            $table->foreign('cb_id')
                ->references('id')->on('doc_change_balance')
                ->onDelete('cascade');

            $table->foreign('lend_id')
                ->references('id')->on('doc_debts')
                ->onDelete('cascade');

        });
    }

    private function createTriggerHandler()
    {
        $sql =
        'CREATE OR REPLACE FUNCTION delete_transaction()
	        RETURNS TRIGGER AS $$
        BEGIN
	        DELETE FROM reg_money_trans t WHERE  document_id = OLD.id;
	        RETURN OLD;
        END;
        $$
        LANGUAGE plpgsql;';
        DB::statement($sql);
    }

    private function createTriggers()
    {
        $triggers = [
            'CREATE TRIGGER doc_income_header_after_del AFTER DELETE ON doc_income_header FOR EACH ROW EXECUTE PROCEDURE delete_transaction()',
            'CREATE TRIGGER doc_expenses_header_after_del AFTER DELETE ON doc_expenses_header FOR EACH ROW EXECUTE PROCEDURE delete_transaction()',
            'CREATE TRIGGER doc_transfers_after_del AFTER DELETE ON doc_transfers FOR EACH ROW EXECUTE PROCEDURE delete_transaction()',
            'CREATE TRIGGER doc_debts_after_del AFTER DELETE ON doc_debts FOR EACH ROW EXECUTE PROCEDURE delete_transaction()',
            'CREATE TRIGGER doc_change_balance_after_del AFTER DELETE ON doc_change_balance FOR EACH ROW EXECUTE PROCEDURE delete_transaction()'
        ];

        foreach ($triggers as $sql) {
            DB::statement($sql);
        }
    }

    private function dropTriggerHandler()
    {
        DB::statement('drop function delete_transaction()');
    }

    private function dropTriggers()
    {
        $triggers = [
            'DROP TRIGGER doc_income_header_after_del ON doc_income_header',
            'DROP TRIGGER doc_expenses_header_after_del ON doc_expenses_header',
            'DROP TRIGGER doc_transfers_after_del ON doc_transfers',
            'DROP TRIGGER doc_debts_after_del ON doc_debts',
            'DROP TRIGGER doc_change_balance_after_del ON doc_change_balance'
        ];

        foreach ($triggers as $sql) {
            DB::statement($sql);
        }
    }

}
