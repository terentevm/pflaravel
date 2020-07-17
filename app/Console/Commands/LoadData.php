<?php

namespace App\Console\Commands;

use App\ChangeBalance;
use App\Currency;
use App\Debt;
use App\Expense;
use App\Income;
use App\Jobs\Documents\ChangeBalance\CreateChangeBalance;
use App\Jobs\Documents\ChangeBalance\UpdateChangeBalance;
use App\Jobs\Documents\Debt\CreateDebt;
use App\Jobs\Documents\Debt\UpdateDebt;
use App\Jobs\Documents\Expense\CreateExpense;
use App\Jobs\Documents\Expense\UpdateExpense;
use App\Jobs\Documents\Income\CreateIncome;
use App\Jobs\Documents\Transfer\CreateTransfer;
use App\Jobs\Documents\Transfer\UpdateTransfer;
use App\traits\Jobs;
use App\Transfer;
use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class LoadData extends Command
{
    use Jobs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:load {user} {pass} {dir}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $user;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('user');
        $pass = $this->argument('pass');
        $dir = $this->argument('dir');
        $file_scenario = $dir . DIRECTORY_SEPARATOR . 'scenario.json';

        if (!file_exists($dir)) {
            $this->error("Directory $dir doesn't exists!");
            die;
        }

        if (!file_exists($file_scenario)) {
            $this->error("File scenario.json doesn't exists!");
            die;
        }

        $user = User::where('login', $email)->first();

        if (!$user) {
            $this->error("User with email $email not found!");
            die;
        }

        $this->info("User is $email");
        $this->info("dir is is $dir ");

        if (Auth::attempt(['login'=>$email, 'password'=>$pass])) {

            $this->user = Auth::user();

            $actions = $this->get_data_from_file($file_scenario);

            foreach ($actions as $action) {

                $processor =  $this->getProcessors()[$action['section']];

                if (!method_exists($this, $processor)) {
                    continue;
                }

                DB::beginTransaction();

                $this->$processor($this->get_data_from_file($action['path']));

                DB::commit();
            }

        }
    }

    function getProcessors() : array
    {
        return [
            'items_expenses' => 'load_items_of_expense',
            'items_income' => 'load_items_of_income',
            'wallets' => 'load_wallets',
            'currencies' => 'load_currencies',
            'contacts' => 'load_contacts',
            'expenses' => 'load_expenses',
            'incomes' => 'load_incomes',
            'transfers' => 'load_transfers',
            'debts' => 'load_debts',
            'cb' => 'load_change_balance'
        ];
    }

    function get_data_from_file($file_name)
    {
        return json_decode(file_get_contents($file_name), true);
    }

    function getLoadMode($item)
    {

    }
    function load_currencies(array $items) :void
    {
        foreach ($items as $item) {

            $currency = null;

            if (array_key_exists('id', $item)) {
                $currency = Currency::find($item['id']);
            }

            if (!$currency) {
                Currency::create($item);
            }
            else {
                $currency->update($item);
            }

        }
    }

    function load_wallets(array $items)
    {
        foreach ($items as $item) {

            $model = null;

            if (array_key_exists('id', $item)) {
                $model = \App\Wallet::find($item['id']);
            }

            if (!$model) {
                \App\Wallet::create($item);
            }
            else {
                $model->update($item);
            }
        }
    }

    function load_items_of_expense(array $items)
    {
        foreach ($items as $item) {

            $model = null;

            if (array_key_exists('id', $item)) {
                $model = \App\ItemExpenditure::find($item['id']);
            }

            if (!$model) {
                \App\ItemExpenditure::create($item);
            }
            else {
                $model->update($item);
            }
        }
    }

    function load_items_of_income(array $items)
    {
        foreach ($items as $item) {

            $model = null;

            if (array_key_exists('id', $item)) {
                $model = \App\ItemIncome::find($item['id']);
            }

            if (!$model) {
                \App\ItemIncome::create($item);
            }
            else {
                $model->update($item);
            }
        }
    }

    function load_contacts(array $items)
    {
        foreach ($items as $item) {

            $model = null;

            if (array_key_exists('id', $item)) {
                $model = \App\Contact::find($item['id']);
            }

            if (!$model) {
                \App\Contact::create($item);
            }
            else {
                $model->update($item);
            }
        }
    }

    function load_incomes($items)
    {
        DB::table('doc_income_header')->delete();

        foreach ($items as $item) {
            $this->dispatch(new CreateIncome($this->user, $item));
        }
    }

    function load_expenses($items)
    {
        foreach ($items as $item) {

            $expense = Expense::find($item['id']);

            if (!$expense) {
                $this->dispatch(new CreateExpense($this->user, $item));
            }
            else {
                $this->dispatch(new UpdateExpense($expense, $item));
            }
        }
    }

    function load_change_balance($items)
    {
        foreach ($items as $item) {

            $cb = ChangeBalance::find($item['id']);

            if (!$cb) {
                $this->dispatch(new CreateChangeBalance($this->user, $item));
            }
            else {
                $this->dispatch(new UpdateChangeBalance($cb, $item));
            }
        }
    }

    function load_transfers($items)
    {
        foreach ($items as $item) {

            $transfer = Transfer::find($item['id']);

            if (!$transfer) {
                $this->dispatch(new CreateTransfer($this->user, $item));
            }
            else {
                $this->dispatch(new UpdateTransfer($transfer, $item));
            }
        }
    }

    function load_debts($items)
    {
        foreach ($items as $item) {

            $debt = Debt::find($item['id']);

            if (!$debt) {
                $this->dispatch(new CreateDebt($this->user, $item));
            }
            else {
                $this->dispatch(new UpdateDebt($debt, $item));
            }
        }
    }
}
