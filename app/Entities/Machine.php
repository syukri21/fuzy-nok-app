<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Machine extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        'id' => null,
        'name' => null,
        'qr_type' => null,
        'qr_path' => null,
        'created_at' => null,
        'updated_at' => null,
        'deleted_at' => null,
    ];
}
