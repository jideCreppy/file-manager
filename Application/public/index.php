<?php

require_once "../model/curl_model.php";
require_once "../helper/helper.php";

$curl = new Curl_Model();
$records = $curl->find_all();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <title>Latest | File Manager | Jide Creppy </title>
</head>
<body>

<div class="container">

<div class="row">
    <div class="col-">
<div class="jumbotron" id="hero-bg">
  <h1 class="display-4 animated rollIn">File Manager</h1>
  <p class="lead">- This is a simple application that uses an API to manage file upload(including storage of file meta data).</p>
  <hr class="my-4">
  <form method="POST" action="upload.php" enctype="multipart/form-data">
  <div class="form-group">
    <label for="exampleFormControlFile1">Please select a file to upload.</label>
    <input type="file" name="file_upload" class="form-control-file" id="exampleFormControlFile1">
  </div>
  <div class="form-group">
  <button type="submit" class='btn btn-primary'>Upload</button>
  </div>
</form>
</div>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Extension</th>
      <th scope="col">Mime Type</th>
      <th scope="col">Size</th>
      <th scope="col">MD5</th>
      <th scope="col">Dimensions</th>
      <th scope="col">Created At</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($records->data as $record):?>
    <tr>
      <th scope="row"><?= $record->id; ?></th>
      <td><a href="uploads/<?=$record->name?>" download><?= $record->name; ?></a></td>
      <td><?= $record->extension; ?></td>
      <td><?= $record->mime_type; ?></td>
      <td><?= formatSizeUnits($record->size); ?></td>
      <td><?= $record->md5; ?></td>
      <td><?= $record->dimensions; ?></td>
      <td><?= $record->created_at; ?></td>
    </tr>
<?php endforeach;?>
  </tbody>
</table>

</div>
</div>
</div>
</body>
</html>