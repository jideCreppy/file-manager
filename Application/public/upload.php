<?php
require "../vendor/autoload.php";
require_once "../model/curl_model.php";
require_once "../helper/helper.php";

// Create instance of the curl_model
$curl = new Curl_Model();

// Set up codeguy/upload to hadle file and metadata upload
$storage = new \Upload\Storage\FileSystem('uploads');
$file = new \Upload\File('file_upload', $storage);

$file->setName(time().'_'.$file->getNameWithExtension());

// Validate file upload. SET max size to 50M
$file->addValidations(array(
    new \Upload\Validation\Size('50M')
));

// GET file metadata
$data = array(
    'name' => $file->getNameWithExtension(),
    'extension' => $file->getExtension(),
    'mime_type' => $file->getMimetype(),
    'size' => $file->getSize(),
    'md5' => $file->getMd5(),
    'dimensions' => $file->getDimensions()
);

// HTTP request to store file meta data
$status = $curl->store($data);
// echo $status;

// Save file to the uploads directory
try {
    // Success!
    $file->upload();

} catch (\Exception $e) {
    // Fail!
    $errors = $file->getErrors();
}

// Helper method to redirect the user to the home page
redirect_home();
die();