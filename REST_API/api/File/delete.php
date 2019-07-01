<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow_Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Header, Access-Control-Allow_Methods, Content-Type, X-Requested-With');

require_once('../../config/database.php');
require_once('../../model/File_Model.php');

// GET JSON POST body
$request_data = json_decode(file_get_contents("php://input"));

// Create instance of the database class
// Instance created is passed to the file_model constructor
$database   =   new Database();
$file_model  =   new File_Model($database->connect());

// Populate FILE_MODEL class object with the record id
$file_model->id = $request_data->id;

// Attempt to delete a new record
if(!empty($request_data) && $file_model->delete()){

    echo json_encode(['message' => 'Record deleted','status' => true]);

}else{

    echo json_encode(['message' => 'Nothing to delete']);
    http_response_code(404);
    die();
}
