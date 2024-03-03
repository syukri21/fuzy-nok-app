<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class QR extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    protected $attributes = [
        "data" => null,
        "code" => null,
        "type" => 'machine',
    ];
}
