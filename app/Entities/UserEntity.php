<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{


    public function __construct(?array $data = null)
    {
        parent::__construct($data);
    }

    public static int $cost = 10;

    protected string $table = 'users';
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    protected $attributes = [
        'id' => null,
        'username' => '',
        'first_name' => '',
        'last_name' => '',
        'gender' => 'male',
        'email' => '',
        'password' => '',
        'nik' => '',
        'role' => '',
        'created_at' => null,
        'updated_at' => null,
        'verify_at' => null
    ];

    /**
     * @param string $password
     * @return void
     */
    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT, ['cost' => UserEntity::$cost]);
    }


    public function verify(string $password): bool
    {
        return password_verify($password, $this->attributes['password']);
    }
}
