<?php
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
$uploadOk = 1;
$pdfFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if file is a actual PDF or fake PDF
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["pdfFile"]["tmp_name"]);
    if($check != false) {
        echo "File is a PDF - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not a PDF.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["pdfFile"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
if($pdfFileType != "pdf") {
    echo "Sorry, only PDF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["pdfFile"]["name"])). " has been uploaded.";
        // Now you can store the file path in your database
        $filePath = $targetFile;
        // Store $filePath in your database
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
