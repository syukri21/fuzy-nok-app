<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;

class UserModel extends Model
{

    /**
     * @throws \ValidationException
     */
    public function login(string $username, string $password): UserEntity
    {
        $userModel = $this->groupStart()->where(['email' => $username])->orWhere(['username' => $username])->orWhere(['nik' => $username])->groupEnd()->doFirst();
        if ($userModel == null) {
            throw new \ValidationException("Invalid username or password");
        }

        $hashPassword = UserEntity::hash($password);
        if ($userModel['password'] !== $hashPassword) {
            throw new \ValidationException("Invalid username or password");
        }
        return new UserEntity($userModel);
    }

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'email',
        'nik',
        'password',
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
