<?php

namespace App\Models;

use CodeIgniter\Model;

class Metadatamodels extends Model
{
    protected $table = 'meta_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['feature', 'meta_title', 'meta_description', 'meta_title_inggris', 'meta_description_inggris'];

    public function getMetaData()
    {
        return $this->first();
    }
}
