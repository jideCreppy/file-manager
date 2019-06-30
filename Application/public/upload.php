<?php
require "../vendor/autoload.php";
require_once "../model/curl_model.php";


$curl = new Curl_Model();

$storage = new \Upload\Storage\FileSystem('uploads');
$file = new \Upload\File('file_upload', $storage);


// Validate file upload
// MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
$file->addValidations(array(
    new \Upload\Validation\Size('5M')
));


// Access data about the file that has been uploaded
$data = array(
    'name'       => $file->getNameWithExtension(),
    'extension'  => $file->getExtension(),
    'mime_type'       => $file->getMimetype(),
    'size'       => $file->getSize(),
    'md5'        => $file->getMd5(),
    'dimensions' =>  $file->getDimensions()
);


$status = $curl->store($data);

echo $status;

// Try to upload file
try {
    // Success!
    $file->upload();

} catch (\Exception $e) {
    // Fail!
    $errors = $file->getErrors();
}

header('Location: index.php');
die();