<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

$database   =   new Database();
$file_model  =   new File_Model($database->connect());

$files_array =  [];
$files_array['version'] =   "1.0.0";
$files_array['data']    =   array();

$result_set =   $file_model->all();
$num_rows   =   $result_set->rowCount();

if($num_rows){

    while($row = $result_set->fetch(PDO::FETCH_ASSOC)){
        
        extract($row);

        $file = [
            "id"  =>   $id,
            "name"  =>   $name,
            "extension" =>  $extension,
            "mime_type" =>  $mime_type,
            "size"  =>  $size,
            "md5"   =>  $md5,
            "dimensions" =>  $dimensions,
            "created_at"    =>  $created_at
        ];

        array_push($files_array['data'],$file);
    }

    echo json_encode($files_array);

}else{

    echo json_encode(['message' => 'No records']);

}