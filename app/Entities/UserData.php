<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserData extends Entity
{
    protected $datamap = [];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts = [];

    protected $attributes = [
        'id' => null,
        'user_id' => '',
        'image' => '',
        'alamat' => '',
        'created_at' => null,
        'updated_at' => null,
        'verify_at' => null
    ];
}
