<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

// Create instance of the database class
// Instance created is passed to the file_model constructor
$database = new Database();
$file_model = new File_Model($database->connect());

// Prepare array as final JSON response
$files_array = [];
$files_array['version'] = "1.0.0";
$files_array['data'] = array();

// API call to fetch all records from the database
$result_set = $file_model->all();

// Get database row count
$num_rows = $result_set->rowCount();

// If records are found build the JSON response
// Else output a message
if ($num_rows) {

    while ($row = $result_set->fetch(PDO::FETCH_ASSOC)) {

        extract($row);
        $file = [
            "id" => $id,
            "name" => $name,
            "extension" => $extension,
            "mime_type" => $mime_type,
            "size" => $size,
            "md5" => $md5,
            "dimensions" => $dimensions,
            "created_at" => $created_at
        ];
        array_push($files_array['data'], $file);

    }

    echo json_encode($files_array);

} else {

    echo json_encode(['message' => 'No records']);

}