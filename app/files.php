<?php

namespace App;
use DB;

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



    public static function deleteFiles($id)
    {
        DB::table('files')
        ->where('fileId', $id)
        ->update(['IsActive' => 0]); 

    }


    public function folder()
    {
        return $this->belongsTo('App\folder', 'folderId');
    }

}
