<?php

namespace App;

class Contact extends ModelByUser
{
    public $timestamps = false;

    protected $table = 'ref_contacts';

    protected $primaryKey = 'id';

    protected $keyType = 'uuid';

    protected $fillable = [
        'id',
        'name',
        'comment',
        'user_id'
    ];

    protected $hidden = ['user_id'];
}
