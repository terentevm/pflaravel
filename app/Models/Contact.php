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
        'phone',
        'email',
        'comment',
        'user_id'
    ];

    protected $hidden = ['user_id'];

    public function getId(): string
    {
        return $this->attributes['id'];
    }

    public function getName(): string
    {
        return trim($this->attributes['name']);
    }

    public function getEmail(): string
    {
        return trim($this->attributes['email']);
    }

    public function getPhone(): string
    {
        return trim($this->attributes['phone']);
    }

}
