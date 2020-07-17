<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\DocumentType;
Use App\Enums\TransactionType;
use Illuminate\Support\Facades\DB;

class ChangeRegMoneyTrans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reg_money_trans', function (Blueprint $table)
        {
            $table->uuid('document_id')->default('00000000-0000-0000-0000-000000000000');
            $table->enum('document_type', DocumentType::getValues())->default(DocumentType::Expense);
            $table->enum('type', TransactionType::getValues())->default(TransactionType::Expense);
            $table->index(['document_id', 'document_type'], 'idx_tr_doc_type');
            $table->index('document_id', 'idx_tr_doc');
        });

        $this->updateRecords();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reg_money_trans', function (Blueprint $table) {
            $table->dropIndex('idx_tr_doc');
            $table->dropIndex('idx_tr_doc_type');
            $table->dropColumn('document_type');
            $table->dropColumn('document_id');
            $table->dropColumn('type');
        });
    }

    private function updateRecords()
    {
        $transactions = DB::select('select * from reg_money_trans');

        foreach ($transactions as $transaction) {

            $props = $this->getDocProps($transaction);

            DB::update(
                'update reg_money_trans set document_id = ?, document_type = ?, type = ? where id=?',
                [$props['document_id'], $props['doc_type'], $props['type'], $transaction->id, ]
            );
        }
    }

    private function getDocProps($transaction)
    {
        $doc_type='';
        $id = '';
        $type = '';

        if (isset($transaction->expend_id)) {
            $id = $transaction->expend_id;
            $doc_type = DocumentType::Expense;
            $type = TransactionType::Expense;
        }
        elseif (isset($transaction->income_id)) {
            $id = $transaction->income_id;
            $doc_type = DocumentType::Income;
            $type = TransactionType::Income;
        }
        elseif (isset($transaction->transfer_id)) {
            $id = $transaction->transfer_id;
            $doc_type = DocumentType::Transfer;
            $type = $transaction->sum >= 0 ? TransactionType::Income : TransactionType::Expense;
        }
        elseif (isset($transaction->lend_id)) {
            $id = $transaction->lend_id;
            $doc_type = DocumentType::Debt;
            $type = $transaction->sum >= 0 ? TransactionType::Income : TransactionType::Expense;
        }
        elseif (isset($transaction->cb_id)) {
            $id = $transaction->cb_id;
            $doc_type = DocumentType::ChangeBalance;
            $type = $transaction->sum >= 0 ? TransactionType::Income : TransactionType::Expense;
        }

        return ['doc_type' => $doc_type, 'type' => $type, 'document_id' => $id];
    }
}
