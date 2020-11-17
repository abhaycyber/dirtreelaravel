<?php

namespace App\Http\Controllers;

use App\folder;
use App\files;
use Illuminate\Http\Request;

class FolderController extends Controller
{


    public function deleteFolder(Request $request)
    {

            $param = $request->all();

            $delete = folder::deleteFolder($param['id']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$all_folder = folder::all();


       // $test = folder::with('files')->get()->toArray();

        $data = folder::getAllFolderName();

    
        $data = json_decode(json_encode((array) $data), true);

         

        $finalArray = [];
        foreach ($data as $data1) {

            $array1 = [];

            $i = 1;
            foreach ($data as $data2) {

            if($data2['ParentIdActive'] == 1){
                if ($data2['ParentId'] == $data1['folderId']) {

                    $array1[] = $data2;
                }
            }

                $i++;
            }

            $array1['foldername'] = $data1['foldeName'];
            $array1['folderId'] = $data1['folderId'];
            $array1['ParentId'] = $data1['ParentId'];

            $finalArray[$data1['folderId']] = $array1;
        }

        $data = folder::getAllData();

      //  echo "<pre>";
      //  print_r($data);
      //  die;


        $data = json_decode(json_encode((array) $data), true);

      // echo "<pre>";
       // print_r($data);
       // die;

        $FolderFiles = [];
        foreach ($data as $data1) {

            $array1 = [];

            $i = 1;
            foreach ($data as $data2) {
                if($data2['ParentIdActive'] == 1){
                if ($data2['folderId'] == $data1['folderId']) {

                    $array1[] = $data2;
                }

            }
                $i++;
            }

            $FolderFiles[$data1['folderId']] = $array1;
        }


        foreach ($finalArray as $finalArray1) {

            if ($finalArray1['ParentId'] == '' || $finalArray1['ParentId'] == 0) {

                $folderId = $finalArray1['folderId'];
                echo '<span style="color:red;"><b>' . $finalArray1['foldername'] . '</b></span><span><input type="button" value="delete" onclick="deletefolder('.$folderId.')"></span><br/><br/>';

                if (isset($FolderFiles[$finalArray1['folderId']])) {
                    foreach ($FolderFiles[$finalArray1['folderId']] as $files) {

                        if (isset($files['fileName'])) {
                            if($files['ParentIdActive'] == 1){
                                if($files['filIsActive'] == 1){
                            $fileId = $files['fileId'];
                            echo '<span style="color:blue;">&nbsp;&nbsp;->' . $files['fileName'] . '</span><span><input type="button" value="delete" onclick="deletefile('.$fileId.')"></span><br/><br/>';
                        } }
                    }
                    }
                }

                foreach ($finalArray1 as $finalArray2) {

                    if (isset($finalArray2['foldeName'])) {
                        $folderId = $finalArray2['folderId'];
                        echo '<span style="color:red;">&nbsp;&nbsp;->' . $finalArray2['foldeName'] . '</span><span><input type="button" value="delete" onclick="deletefolder('.$folderId.')"></span><br/><br/>';

                        if (isset($FolderFiles[$finalArray2['folderId']])) {

                            foreach ($FolderFiles[$finalArray2['folderId']] as $files) {
                              

                                if (isset($files['fileName'])) {

                                    if($files['ParentIdActive'] == 1){

                                        if($files['filIsActive'] == 1){

                                    $fileId = $files['fileId'];
                                    echo '<span style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp;->' . $files['fileName'] . '</span><span><input type="button" value="delete" onclick="deletefile('.$fileId.')"></span><br/><br/>';

                                    } }
                                }
                            }
                        }

                        if (isset($finalArray[$finalArray2['folderId']][0])) {


                            foreach ($finalArray[$finalArray2['folderId']] as $key => $insideChieldFolderCol) {

                                if (is_int($key)) {

                                    $folderId = $insideChieldFolderCol['folderId'];

                                    echo '&nbsp;&nbsp;&nbsp;&nbsp;->' . $insideChieldFolderCol['foldeName'] . '<span><input type="button" value="delete" onclick="deletefolder('.$folderId.')"></span><br/><br/>';

                                    if (isset($FolderFiles[$insideChieldFolderCol['folderId']])) {

                                        foreach ($FolderFiles[$insideChieldFolderCol['folderId']] as $files) {

                                            if (isset($files['fileName'])) {
                                                if($files['ParentIdActive'] == 1){
                                                    if($files['filIsActive'] == 1){
                                                $fileId = $files['fileId'];    
                                                echo '<span style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;->' . $files['fileName'] . '</span><span><input type="button" value="delete" onclick="deletefile('.$fileId.')"></span><br/><br/>';
                                            } }
                                        }
                                        }
                                    }

                                    $this->parseTree($insideChieldFolderCol, $finalArray, $FolderFiles);
                                }
                            }
                        }

                        if (isset($FolderFiles[$finalArray2['folderId']])) {

                            foreach ($FolderFiles[$finalArray2['folderId']] as $files) {

                                if (isset($files['fileName'])) {
                                    if($files['ParentIdActive'] == 1){
                                        if($files['filIsActive'] == 1){
                                    $fileId = $files['fileId'];
                                    echo '<span style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp;->' . $files['fileName'] . '</span><span><input type="button" value="delete" onclick="deletefile('.$fileId.')"></span><br/><br/>';
                                    }
                                }
                                }
                            }
                        }
                    }
                }
                echo "<br/>";
            }
        }
       
        return view('dirtree');

 }

      // Recursive function for creating the unlimited level tree

      public function parseTree($insideChieldFolderCol, $finalArray, $FolderFiles) {

        static $counter = 0;
        ++$counter;

        if (isset($finalArray[$insideChieldFolderCol['folderId']][0])) {

            foreach ($finalArray[$insideChieldFolderCol['folderId']] as $key1 => $chield2) {

                if (is_int($key1)) {

                    $folderId = $chield2['folderId'];


                    for ($j = 0; $j < $counter; $j++) {

                        echo "&nbsp;&nbsp;&nbsp;";
                    }

                    echo '&nbsp;&nbsp;&nbsp;&nbsp;->' . $chield2['foldeName'] . '<span><input type="button" value="delete" onclick="deletefolder('.$folderId.')"></span><br/><br/>';

                    if (isset($FolderFiles[$chield2['folderId']])) {

                        foreach ($FolderFiles[$chield2['folderId']] as $files) {

                            if (isset($files['fileName'])) {
                                if($files['ParentIdActive'] == 1){
                                    if($files['filIsActive'] == 1){
                                $fileId = $files['fileId'];

                                for ($j = 0; $j < $counter; $j++) {

                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                                }

                                echo '<span style="color:blue;">&nbsp;&nbsp;&nbsp;&nbsp;->' . $files['fileName'] . '</span><span><input type="button" value="delete" onclick="deletefile('.$fileId.')"></span><br/><br/>';
                            } }
                        }
                        }
                    }


                    $this->parseTree($chield2, $finalArray, $FolderFiles);
                }
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function show(folder $folder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function edit(folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, folder $folder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\folder  $folder
     * @return \Illuminate\Http\Response
     */
    public function destroy(folder $folder)
    {
        //
    }
}
