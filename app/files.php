<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class files extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'files';
    protected $primaryKey = 'fileId';
    public $timestamps = false;

    public function folder()
    {
        return $this->belongsTo('App\folder', 'folderId');
    }

}
