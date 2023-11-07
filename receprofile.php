
<?php
// error_reporting(0)

    require 'db.php';
    if (isset($_POST["submit"])){
      $id = $_POST["id"];
      $name_surname = $_POST["name_surname"];
      $age = $_POST["age"];
      $gender = $_POST["gender"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $phone_number = $_POST["phone_number"];
      $rank = $_POST["rank"];
      $profile_img = $_POST["profile_img"];

        if ($_FILES["image"]["error"] === 4) {
            echo "<script> alert('Image Does Not Exist'); </script>";
        } 
        
        else{
            $fileName = $_FILES["image"]["name"];
            $fileSize = $_FILES["image"]["size"];
            $tmpName = $_FILES["image"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if ( !in_array($imageExtension, $validImageExtension) ){
                echo
                "
                <script>
                  alert('Invalid Image Extension');
                </script>
                ";
              }
              else  if($fileSize > 1000000){
                echo "<script> alert('Image Size To Large'); </script>";
            }
            else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, 'images/'. $newImageName);
                $sql = "INSERT INTO receptionists (name_surname, age, gender, email, password, phone_number, rank, profile_img) VALUES ('$name_surname', '$age', '$gender', '$email', '$password', '$phone_number', '$rank', '$profile_img')";
                mysqli_query($conn, $sql);
                echo "<script> alert('Successfully Added'); </script>";
            }
        }
        // $conn->query($sql);
        // $conn->close();

        // header("location: patients.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="patient.css">

    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="index.js"></script>


</head>
<body style="background-color: #F7FBFE;">

<nav class="navbar">
<div class="navbar-logo">
      <img src="Images\Logo.png" alt="Logo">
    </div>
    <div class="navbar-options">
      <ul>
        <li><a style="color: #126197" href="doctors.php">Doctors</a></li>
        <li><a style="color: #126197" href="index.php">Appointments</a></li>
        <li><a style="color: #126197" href="patients.php">Patients</a></li>
        <li class="dropdown">
          <a style="color: #126197" href="#">Profile</a>
          <div class="dropdown-content">
            <a href="receprofile.php">Profile</a>
            <a href="receptionistlogin.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  


    <div class="container" style="background-image: url('Images/Background.png'); background-repeat: no-repeat;">
  <h1 class="title_home">Receptionist Information</h1>

  <div id="appointments" style="width: 750px; margin-left: auto; margin-right: auto; box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2); border-radius: 10px; padding-left: 80px; padding-top: 50px; margin-top: 50px">
    <table class="table" style="margin-left: 50px; background-image: url('Images/Background.png'); background-repeat: no-repeat;">
      <tbody>
        <?php include 'readprofile.php'; ?>
      </tbody>
    </table>

    <div id="table" style="margin-left: 40px">
    <form class="form-inline m-2" action="createprofile.php" method="POST">
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Name and Surname:</label>
        <input style="width: 600px" type="text" class="form-control m-2" id="name" name="name_surname">
      </div><break>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="score">Age:</label>
        <inpu style="width: 600px"t type="number" class="form-control m-2" id="name" name="age">
      </div>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Gender:</label>
        <input style="width: 600px" type="text" class="form-control m-2" id="name" name="gender">
      </div>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Email:</label>
        <input style="width: 600px" type="text" class="form-control m-2" id="name" name="email">
      </div>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Password:</label>
        <input style="width: 600px" type="password" class="form-control m-2" id="name" name="password">
      </div>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Phone Number:</label>
        <input style="width: 600px" type="number" class="form-control m-2" id="name" name="phone_number">
      </div>
      <div style="margin-left: 40px" class="form-group">
        <label style="margin-top: 30px;" for="name">Rank:</label>
        <input style="width: 600px" type="text" class="form-control m-2" id="name" name="rank">
      </div>

<!-- Image -->

      <label for="image">Upload Image</label><br>
      <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png" value=""><br><br>

      <button style="margin-top: 50px; margin-left: 40px; width: 300px; background-color: #09456B; padding-top: 10px; padding-bottom: 10px" type="submit" class="btn btn-primary">Add</button>
    </form>
  </div>
  </div>
</div>



</nav>
</body>
</html>