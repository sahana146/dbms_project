<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8"/>
	<title>login page</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
	<link rel="stylesheet" type="text/css" href="loginstyles.css">
</head>
<body>

	<?php
// define variables and set to empty value
$nameErr = $passErr = "";
$name = $pass = "";
$admin_status = 'unchecked';
$buyer_status = 'unchecked';
$buyer_status = 'unchecked';
if(isset($_GET['usertype']))
{
$selected_radio = $_GET['usertype'];
$db_connect=mysqli_connect("localhost","root","");                      //host name  , user name, password
 $db_selected=mysqli_select_db($db_connect,"sahana"); 
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['un'])) {
  if (empty($_GET["un"])) {
    $nameErr = "user Name is required";
  } else {
    $name = $_GET["un"];
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed"; 
    }
  }
  
  if (empty($_GET["pass"])) {
    $pass = "password is required";
  } else {
    $pass  = $_GET["pass"];
  }
    
if($_GET['usertype']=="admin")
{
  $query = "SELECT adminid FROM adminlogin WHERE username='$name' AND password='$pass'";
}
 
else{ 
$query = "SELECT userID FROM signlogin WHERE username='$name' AND password='$pass'";
}
    $results = mysqli_query($db_connect, $query);
 
    $match  = mysqli_num_rows($results);
    
    
    if($match<1)
    {
      echo "invalid username/password!try again";
    }
    else if ($match == 1) 
   {
    if($_GET['usertype']=="admin")
    {
    while($row=mysqli_fetch_array($results))
    {
      $res=$row['adminid'];
    }
   }
   else
    {
    while($row=mysqli_fetch_array($results))
    {
      $res=$row['userID'];
    }
   }

       if($selected_radio == 'admin')
      {
        $admin_status = 'checked';
        header("Location: admin.php?un=$res"); 
         
    
      }
      else if ($selected_radio == 'buyer') 
      {
        $buyer_status = 'checked';
        header("Location: buyer.php?un=$res"); 
         
      }
      else if($selected_radio == 'seller')
      {
        $seller_status = 'checked';
        header("Location: seller.php?un=$res"); 
         
      }
}
}
}
?>
<?php

$db_connect=mysqli_connect("localhost","root","");                      //host name  , user name, password
 $db_selected=mysqli_select_db($db_connect,"sahana"); 
 if(isset($_GET['counter']))
 {
$counter=$_GET['counter'];
echo date('Y/m/d');
if(date("Y/m/d")=="2018/11/10" && $counter==0)
{

 $res="call festivalupdate()";
 $x=mysqli_query($db_connect,$res);
 $counter=$counter+1;
 header("Refresh:0.5; url=loginnew.php?counter=$counter");
}
}
?>
	<form action="loginnew.php" method="get">
 <div class="login-box">
 	<h1>Login</h1>
 	  <div class="textbox">
 	  	<i class="fas fa-user" style="color:white"></i>
 		<input type="text" placeholder="username" name="un" value="">
 	  </div>
    <div class="rad">
      <input type="radio" name="usertype" value="buyer">buyer
      <input type="radio" name="usertype" value="seller">seller
      <input type="radio" name="usertype" value="admin">admin
    </div>
 	   <div class="textbox">
 	   	<i class="fas fa-lock" style="color:white"></i>
 		<input type="password" placeholder="Password" name="pass" value="">
 	    </div>
 	<input class="btn" type="submit" name="" value="login">
 </div>
 </form>
</body>
</html>
