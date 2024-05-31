<?php

namespace App\Models;

use App\Entities\OrderEntity;
use CodeIgniter\Model;

class OrderModel extends Model
{
  protected $table            = 'orders';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $returnType       = OrderEntity::class;
  protected $useSoftDeletes   = true;
  protected $protectFields    = true;
  protected $allowedFields    = [
    'item_id',
    'order_machines_id',
    'order_pieces',
    'order_code'
  ];

  protected bool $allowEmptyInserts = false;

  // Dates
  protected $useTimestamps = true;
  protected $dateFormat    = 'datetime';
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';
  protected $deletedField  = 'deleted_at';

  // Validation
  protected $validationRules      = [];
  protected $validationMessages   = [];
  protected $skipValidation       = false;
  protected $cleanValidationRules = true;

  // Callbacks
  protected $allowCallbacks = true;
  protected $beforeInsert   = [];
  protected $afterInsert    = [];
  protected $beforeUpdate   = [];
  protected $afterUpdate    = [];
  protected $beforeFind     = [];
  protected $afterFind      = [];
  protected $beforeDelete   = [];
  protected $afterDelete    = [];
}
