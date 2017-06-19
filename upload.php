
<?php
$target_dir = "D:/work/replaceimg/uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// echo $target_file;

$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        // echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		
		// Picture Upload from user 
		$photo = imagecreatefromjpeg('D:\work\replaceimg\uploads\\'.basename( $_FILES["fileToUpload"]["name"]));

		// source frame fronts 
		$src = imagecreatefrompng('D:\work\replaceimg\sign.png');


		$w = imagesx($src);
		$h = imagesy($src);
		imagealphablending($photo,true);

		// $src = imagecreatefrompng("images/girls-dresses/1.png");
		imagecopy($photo,$src,0,0,0,0,$w,$h);

		imagepng($photo,"output.png",9);
		echo '<img src="output.png" />';

    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    // dfdfd
}


?>