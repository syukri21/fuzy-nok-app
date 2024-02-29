<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;
use http\Exception\InvalidArgumentException;

class UserModel extends Model
{

    /**
     * @throws \ValidationException
     */
    public function login(string $username, string $password): array|object
    {
        $user = $this->groupStart()->where(['email' => $username])->orWhere(['username' => $username])->orWhere(['nik' => $username])->groupEnd()->doFirst();
        if ($user == null) {
            throw new InvalidArgumentException("Invalid username or password");
        }
        if (!$user->verify($password)) {
            throw new \InvalidArgumentException("Invalid username or password");
        }
        return $user;
    }

    public function register(UserEntity $userEntity)
    {

    }

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'nik',
        'password',
        'first_name',
        'last_name',
        'gender',
        'verify_at',
        'role'
    ];
    protected $useAutoIncrement = true;
    protected $returnType = UserEntity::class;
    protected $useSoftDeletes = true;
    protected $protectFields = true;

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];


}
