<html>
<head>
<script src="js/jquery-3.3.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script> 
 <script src="operation.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">



<!-- Include the above in your HEAD tag -->
</head>


<?php

if(isset($_GET['un']))
{
 $db_connect=mysqli_connect("localhost","root","");                      //host name  , user name, password
 $db_selected=mysqli_select_db($db_connect,"sahana");             //database name
$uname=$_GET['un'];

if($db_connect && $db_selected)
{
  
  $search="select  * from signup where userID=$uname";
  $sr=mysqli_query($db_connect,$search);
 while($row=mysqli_fetch_array($sr))
{
     $res1=$row['userID'];
     $res2=$row['firstname'];
     $res2=$res2.$row['lastname'];
     $res3=$row['phone'];
     $res4=$row['email'];
     $image=$row['photo'];
        
}


}

}
?>



<body >
  <div id="parent">
<header>
<div>
    <div class="navbar">
  
  <div class="dropdown pull-right">
  <button class=" btn-primary " type="button" 
  data-toggle="dropdown" style="margin-top:-2px;">Profile
  <span class="caret"></span></button>

    <div class="dropdown-menu">
	<div class="row " >
		<div class="col-lg-3 col-sm-6">

            <div class="card hovercard">
                <div class="cardheader" style="height:100px;">

                </div>
                <div class="avatar">
                    <img onerror="this.src='images/smile.jpg'" src='<?php echo "$image"; ?>'
                     style="font-color:white;">
                </div>
                <div class="info">
                    <div class="title">
                        <b> <?php echo "$res2" ?></b>
                    </div>
                    
                    <div class="desc"><?php echo "$res3" ?></div>
                    <div class="desc"><?php echo "$res4" ?></div>
                    
                </div>
                
            </div>

        </div>
   </div>
	</div>
</div>

 <a id="x" href="homepage.html">About Us</a> 
 <a id="x" href="ragpicker.php">Deliver</a>
<a id="x" href="first.html">Home</a> 

</div>
</div>
</header>


<div style="height:300px; width:800px; margin:50px auto;">
 <div class="tablediv" style="margin-right:300px; margin-left:100px;">
      <table width="800px" height="auto" class="ragtable">
        <tr class="trow">
            <th>ItemID</th>
            <th>Item name</th>
            <th>Item quantity</th>
            <th>Item price</th>
            <th>Order</th>
            
        </tr>
   <?php   
   
error_reporting(E_ERROR);



$ret="select * from item";

if(isset($_GET['select']))
{
  $val=$_GET['select'];
  if($val!='item')
    {$ret="select * from item where itemtype_id=$val "; }
}
$sr=mysqli_query($db_connect,$ret);

if($sr)
{
 while($row=mysqli_fetch_array($sr))

{


      $r= $row['itemID'];
      $r1=explode("_",$row['itemname'])[0];
      $r2=$row['itemqty'] ;
      $r3=$row['discount'];


     echo "
     <tr>

         
        <td>  $r  </td>
        <td>  $r1   </td>
        <td>  $r2   </td>
        <td>  $r3   </td>
        <td><a href='buyer.php?un=$uname&ordbt=1&id=$r'><input class='ord' type='submit' onclick='popup()' value='Order'></a></td> 
        

     </tr>";

}

}

if(isset($_GET['ordbt']))
{

$dl=$_GET['id'];
      $del="delete from item_dup where item_id=$dl";
      $reslt=mysqli_query($db_connect,$del);

require("PHPMailer/class.PHPMailer.php");

$mail = new PHPMailer();

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'sahanagowda146@gmail.com';          // SMTP username
$mail->Password = 'success@'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('sahanagowda146@gmail.com', 'waste management');
$mail->addReplyTo('sahanagowda146@gmail.com', 'waste management');
$mail->addAddress("$res4");   // Add a recipient
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$mail->isHTML(true);  // Set email format to HTML
$bodyContent .= '<p> Thankyou, Your order has been successfully placed.</p><p>It will be delivered to you within next 10 days.</p>';

$mail->Subject = 'Email from Waste management';
$mail->Body    = $bodyContent;

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

  
      header("Refresh:0.5; url=buyer.php?un=$uname");
}

?>
       
      </table>
  </div>
</div>
<form method=get action=""> 
<div  class="filter" style=" position:relative; bottom:350px; left:50px; ">  
  <select class="filtersel" name=select id=itype >
  <option  value="item"  >- - - - ALL - - - -</option>}
  <option value=101>Plastic</option>
  <option value=102>Paper</option>
  <option value=103>Cloth</option>
  <option value=104>Metal</option>
  <option value=105>E-Waste</option>
  <option value=106>Wood</option>
</select>
<button class="btsel">OK</button> 
</div>
<input  style="display:none;" value='<?php echo "$uname"; ?>' name='un'>
</form>

</div>






 
  </form>
</div> 
<footer class="foo">
        <strong><br>All Rights Reserved <br> &copyWM</strong>
    </footer>


</body>
</html>