<?php 
namespace App\Models;

use CodeIgniter\Model;

class Subjects extends Model
{
    protected $table      = 'subjects';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';

    protected $allowedFields = ['name', 'description'];
    protected $useTimestamps = false;
    
    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
    
}