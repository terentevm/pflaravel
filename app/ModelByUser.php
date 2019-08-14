<?php
/**
 * Created by PhpStorm.
 * User: zaich
 * Date: 31.07.2019
 * Time: 19:34
 */

namespace App;

use App\Facades\UUID;
use App\Scopes\ByUserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelByUser extends Model
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ByUserScope);

        self::creating(function ($model) {

            if ($model->primaryKey === 'id' && $model->keyType === 'uuid'
                && (!isset($model->id) || is_null($model->id) || $model->id === '')  ) {

                $model->id = UUID::gen();
            }

            if (!isset($model->user_id)) {
                $model->user_id = Auth::user()->id;
            }

        });

        self::updating(function ($model) {

            if (!isset($model->user_id)) {
                $model->user_id = Auth::user()->id;
            }

        });

    }
}