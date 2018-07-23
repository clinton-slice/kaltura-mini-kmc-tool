
<?php
require_once(dirname(__FILE__) . '/assets/KalturaClient.php');

/**
 *  This script performs bulk thumbnail change
 *
 *  Expects one array via entries[]
 */

if(isset($_FILES["imageToUpload"]["type"]))
{
    

    // Setup API session
    require_once("include.php");
    // Handle POST variables
    $entries = $_POST['entries'];
    
    $entries = explode(',', $entries);
    
    //getting information of the file
    //Setting variables
    $fileName = $_FILES['imageToUpload']['name']; //name of file
    $fileSize = $_FILES['imageToUpload']['size']; //size of file
    $fileError = $_FILES['imageToUpload']['error']; //error
    $fileType = $_FILES['imageToUpload']['type']; //type of file

    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $fileName);
    $file_extension = end($temporary);

    // Check for errors
    if ((($fileType == "image/png") || ($fileType == "image/jpg") || ($fileType == "image/jpeg")
        ) && ($fileSize < 5000000)//Approx. 5MB files can be uploaded.
        && in_array($file_extension, $validextensions)) {
        if ($fileError > 0)
        {
            echo "Return Code: " . $fileError . "<br/><br/>";
        }
        else
        {
            if (file_exists("upload/" . $fileName)) {
                $fileName . " <span id='invalid'><b>already exists.</b></span> ";
            }
            else
            {
                $fileTmpName = $_FILES['imageToUpload']['tmp_name']; //temp location of file
                //$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $fileData = 'thumbnail_uploads/' . $fileName;// Target path where file is to be stored

                move_uploaded_file($fileTmpName,$fileData) ; // Moving Uploaded file

                echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
            	header("location:index.php");
	     }
        }
    }
    else
    {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
    // Process each entry
    foreach ($entries as $entry)
    {
        $entryId = $entry;
        //$fileData = "/path/to/file";
        try
        {
        $result = $client->baseEntry->updateThumbnailJpeg($entryId, $fileData);
    	var_dump($result);       
        }
        catch (Exception $e)
        {
            echo $e->getMessage();
        }
    }
header("location:index.php");
}
?>
