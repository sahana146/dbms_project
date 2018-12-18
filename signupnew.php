<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8"/>
	<title>signup page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="loginstyles.css">
</head>
<body>
 <div class="navbar">
 <a id="x" href="homepage.html">About Us</a> 
 
<a id="x" href="first.html">Home</a> 

</div>
<?php
$db=mysqli_connect("localhost","root","");
$dt=mysqli_select_db($db,"sahana");
// define variables and set to empty values
$Err="";
$name = $lname = $email = $phone=$user=$pass=$hno=$street=$city=$pin="";

if (isset($_POST['signup']))
 {

  
  if (empty($_POST["name"]) && empty($_POST["lname"]) && empty($_POST["username"])) {
    $Err = "Name is required";
     echo "<div style='color:red;'>$Err</div>";
  } 
  else
   {
    $name = test_input($_POST["name"]);
    $lname = test_input($_POST["lname"]);
    $user = test_input($_POST["username"]);
    $pass=test_input($_POST["password"]);
    $phone=test_input($_POST["phone"]);
     $hno=test_input($_POST["hno"]);
      $street=test_input($_POST["street"]);
       $city=test_input($_POST["city"]);
        $pin=test_input($_POST["pin"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name ) && !preg_match("/^[a-zA-Z ]*$/",$lname) )
    {
      $Err = "Only letters and white space allowed"; 
        echo "<div style='color:red;'>$Err</div>";
    }
  }

  if (empty($_POST["email"]))
   {
    $Err = "Email is required";
      echo "<div style='color:red;'>$Err</div>";
  } 
    else
      {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $Err = "Invalid email format"; 
        echo "<div style='color:red;'>$Err</div>";
    }
  }


  if (empty($_POST["phone"]))
   {
    $Err = "Phone number is required";
   echo "<div style='color:red;'>$Err</div>";
  } 
    else
    {
     $phone = test_input($_POST["phone"]);
    
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$phone )) 
    {
      $Err = "only numbers allowed"; 
       echo "<div style='color:red;'>$Err</div>";
      
    }
  }
 if (empty($_POST["hno"]))
   {
    $Err = "House number is required";
   echo "<div style='color:red;'>$Err</div>";
  } 
    else
    {
     $hno = test_input($_POST["hno"]);
    
    // check if name only contains letters and whitespace
    if (!preg_match("/^[A-Za-z0-9]*$/",$hno )) 
    {
      $Err = "only characters and numbers allowed"; 
       echo "<div style='color:red;'>$Err</div>";
      
    }
  }
  if (empty($_POST["street"]))
   {
    $Err = "Street is required";
   echo "<div style='color:red;'>$Err</div>";
  } 
    else
    {
     $street = test_input($_POST["street"]);
    
    // check if name only contains letters and whitespace
    if (!preg_match("/^[A-Za-z' ']*$/",$street )) 
    {
      $Err = "only characters allowed"; 
       echo "<div style='color:red;'>$Err</div>";
      
    }
  }
  if (empty($_POST["city"]))
   {
    $Err = "City is required";
   echo "<div style='color:red;'>$Err</div>";
  } 
    else
    {
     $city = test_input($_POST["city"]);
    
    // check if name only contains letters and whitespace
    if (!preg_match("/^[A-Za-z]*$/",$city )) 
    {
      $Err = "only characters allowed"; 
       echo "<div style='color:red;'>$Err</div>";
      
    }
  }
  if (empty($_POST["pin"]))
   {
    $Err = "Pin number is required";
   echo "<div style='color:red;'>$Err</div>";
  } 
    else
    {
     $pin = test_input($_POST["pin"]);
    
    // check if name only contains letters and whitespace
    if (!preg_match("/^[0-9]*$/",$pin )) 
    {
      $Err = "only numbers allowed"; 
       echo "<div style='color:red;'>$Err</div>";
      
    }
  }

$pass = test_input($_POST["password"]);
  if (!empty($_FILES["uploadedimage"]["name"])) {

 

    $file_name=$_FILES["uploadedimage"]["name"];

    $temp_name=$_FILES["uploadedimage"]["tmp_name"];

    $imgtype=$_FILES["uploadedimage"]["type"];

    $target_path = "C:/xampp/htdocs/dbms/images".$file_name;
    $file_name='images/'.$file_name;

     if(move_uploaded_file($temp_name, $target_path)) 
     {
      
      $res1="";
      $query_upload="INSERT into signup (firstname,lastname,username,phone,photo,email) VALUES ('$name','$lname','$user','$phone','".$file_name."','$email')";
      $t=mysqli_query($db,$query_upload);
      if(!$t)
        echo "Error!!!";
    
     } 
      else
    {
      echo "Error!!!";
     } 
   }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


?>


	<form action="signupnew.php" enctype="multipart/form-data" method="post">
 <div class="signup-box">
 	<h1>Sign-up</h1>
 	  <div class="textbox">
 	  	<i class="fas fa-user" style="color:white"></i>
 		<input type="text" placeholder="first name" name="name" value="">
 	  </div>
 	  <div class="textbox">
 		<input type="text" placeholder="      last name" name="lname" value="">
 	  </div>
    <div class="textbox">
      <i class="fas fa-user" style="color:white"></i>
    <input type="text" placeholder=" user name" name="username" value="" >
  </div>
 	  <div class="textbox">
 	  	<i class="fas fa-phone" style="color:white"></i>
 		<input type="text" placeholder="phone" name="phone" value="">
 	  </div>
 	  <div class="textbox">
 	  	<i class="fas fa-envelope" style="color:white"></i>
 		<input type="text" placeholder="mail-id" name="email" value="">
 	  </div>
 	   <div class="textbox">
 	   	<i class="fas fa-lock" style="color:white"></i>
 		<input type="password" placeholder="Password" name="password" value="">
 	    </div>
      <div class="textbox">
      <i class="fas fa-home" style="color:white"></i>
    <input type="text" placeholder="  house number" name="hno" value="">
    </div>
    <div class="textbox">
    <input type="text" placeholder="      street" name="street" value="">
    </div>
    <div class="textbox">
    <input type="text" placeholder="       city" name="city" value="">
    </div>
    <div class="textbox">
    <input type="text" placeholder="       pincode" name="pin" value="">
    </div>
      <div class="textbox">
 	  	<i class="fas fa-image" style="color:white"></i>
 		<input type="file" name="uploadedimage"  >
 		
 	  </div>
 	<input class="btn" type="submit" name="signup" value="signup">
 </div>
</form>
<div class="req">*All Fields Are Required!</div>
<?php
if (isset($_POST['signup']) && $Err=="")
 {
$search="select  userID from signup where username='$user'";
  $sr=mysqli_query($db,$search);

 while($row=mysqli_fetch_array($sr))
{
     $res1=$row['userID'];
     
        
} 
       $ins="INSERT into signlogin values($res1,'$user','$pass')"; 
       mysqli_query($db,$ins); 
       $ins1="Insert into address values($res1,$hno,'$street','$city',$pin)";
       mysqli_query($db,$ins1);
}
?>
</body>
</html>