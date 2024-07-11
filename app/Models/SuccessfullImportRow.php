<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessfullImportRow extends Model
{
    protected $table = 'successfull_import_rows';
    public $timestamps = false;

    public function import()
    {
        return $this->hasOne('App\Models\Imports', 'id', 'import_id');
    }

}
