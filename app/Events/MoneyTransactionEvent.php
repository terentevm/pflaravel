<?php
/**
 * Created by PhpStorm.
 *
 * Date: 20.08.2019
 * Time: 11:14
 */

namespace App\Events;

use Illuminate\Database\Eloquent\Model;

class MoneyTransactionEvent
{
    public $model = null;
    public $eventType = 'create';
    /**
     * Create a new event instance.
     *
     * @param  \Model  $model
     * @return void
     */
    public function __construct($model, $eventType = 'create')
    {
        $this->model = $model;
        $this->eventType = $eventType;
    }
}