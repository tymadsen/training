<?php session_start(); ?>
<html>
<body>
<?php
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$upload_message = "";
$upload_error = "";
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 600000)
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    $upload_error =  $upload_error . "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
    $upload_message =  $upload_message . "Upload: " . $_FILES["file"]["name"] . "<br>";
    $upload_message =  $upload_message . "Type: " . $_FILES["file"]["type"] . "<br>";
    $upload_message =  $upload_message . "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    $upload_message =  $upload_message . "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      $upload_error =  $upload_error . $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {//move file to folder
        $photo_folder = "photos";
        $photo_location = $photo_folder . "/" . $_FILES["file"]["name"];
        move_uploaded_file($_FILES["file"]["tmp_name"],$photo_location);
        $upload_message =  $upload_message . "Stored in: " . $photo_location;
        $error_message2 = "Successful upload";
        $con = mysqli_connect('localhost','root','root','Users');
        if(mysqli_connect_errno($con)){
          $error_message2 = "Failed to connect to MySQL server: " . mysqli_connect_error();
        }
        //$sql = "INSERT INTO user_id (username) VALUES ('$_POST[user_name]')";
        //echo "username: " . $_POST["user_name"];
        $img_loc = 'photos/' . $_FILES["file"]["name"];
        $user = $_SESSION['user_name'];
        $sql2 = "INSERT INTO users_photos (username, photo) VALUES ('$user','$img_loc')";
       
        /*if(!mysqli_query($con,$sql)){
          $error_message2 = $error_message2 . "Error inserting into database Users.user_id. " . mysqli_error($con);
        }*/
        if(!mysqli_query($con,$sql2)){
          $error_message2 = $error_message2 . "Error inserting into database Users.users_photos. " . mysqli_error($con);
        }
        mysqli_close($con);
      }
    }
  }
else
  {
  $invalid = "Invalid file";
  }
 
?>

<script>
//var un = "<?php echo $_POST[user_name]; ?>";
//alert("username: " + un);

var message_two = "<?php echo $error_message2; ?>";
if(message_two != "Successful upload")
  alert(message_two);
var upload_error = "<?php echo $upload_error; ?>";
if(upload_error != "")
  alert(upload_error);
var invalid = '<?php echo $invalid; ?>';
if(invalid == "Invalid file")
  alert(invalid);
location = 'Homepage.php';
//alert(message_two);
</script>
</body>
</html>