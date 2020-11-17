<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class folder extends Model
{

   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'folder';
    protected $primaryKey = 'folderId';
    public $timestamps = false;


    public static function deleteFolder($id)
    {
        DB::table('folder')
        ->where('folderId', $id)
        ->update(['IsActive' => 0]); 

    }


    public function files()
    {
        return $this->hasMany('App\files', 'folderId', 'fileId');
    }


    public static function getAllFolderName(){

    return DB::select('SELECT fol.folderId, fol.foldeName, fol1.foldeName AS ParentName, fol1.folderId AS ParentId, fol1.IsActive AS ParentIdActive FROM folder AS fol LEFT JOIN folder AS fol1 on fol.parentId = fol1.folderId WHERE fol.IsActive = 1 ORDER BY fol.folderId ASC');

    }

    /*public static function getAllData() {

        return DB::select('SELECT fol.folderId, fol.foldeName, fol.parentId, fol.IsActive as folIsActive, fil.fileId, fil.fileName, fil.IsActive as filIsActive  FROM `folder` fol INNER JOIN files fil ON fol.folderId = fil.folderId WHERE fol.IsActive = 1');
       
    } */

    public static function getAllData() {

        return DB::select('SELECT fol.folderId, fol.foldeName, fol.parentId, fol.IsActive as folIsActive, fol1.folderId AS ParentId, fol1.IsActive AS ParentIdActive, fil.fileId, fil.fileName, fil.IsActive as filIsActive  FROM `folder` fol JOIN folder AS fol1 on fol.parentId = fol1.folderId JOIN files fil ON fol.folderId = fil.folderId WHERE fol.IsActive = 1');
       
    }







    
}
