<html>

<head>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script> 
<script type="text/javascript" src="operation.js"></script>
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
  
   if(isset($_GET['iqty']))
   {
    $x=ucfirst(strtolower($_GET['iname']))."_".$uname;
    $q=$_GET['iqty'];
    $p=$_GET['iprice'];
    $t=$_GET['select'];
    if($q>100 and $q<500)
      $l=$p-($p/10);
    else
      $l=$p;
  $insert="insert into item (userID,itemname,itemqty,itemprice,itemtype_id,discount) values($uname,'$x',$q,$p,$t,$l)";
  

    $sr=mysqli_query($db_connect,$insert);

   }


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


<div style="height:300px; width:800px; margin:50px auto ;" class="table">
<div class="tablediv" align="center"  >
  <table width="800px" height="300px"  class="ragtable">
        <tr class="trow">
            <th>ItemID</th>
            <th>Item name</th>
            <th>Item quantity</th>
            <th>Item price</th>
            <th>Edit</th>
            <th>Remove</th>
        </tr>
   <?php   
   
$ret="select * from item where userID=$uname";
$sr=mysqli_query($db_connect,$ret);


 while($row=mysqli_fetch_array($sr))
{


      $r= $row['itemID'];
      $r1=explode("_",$row['itemname'])[0];
      $r2=$row['itemqty'] ;
      $r3=$row['itemprice'];

     echo "
     <tr>

         
        <td>  $r  </td>
        <td>  $r1   </td>
        <td>  $r2   </td>
        <td>  $r3   </td>
        <td><a href='seller.php?un=$uname&id=$r'> Edit</a></td> 
        <td><a href='seller.php?un=$uname&stat=rm&idr=$r' id='rm'>Remove</a></td>

     </tr>";

}



?>
       
      </table>
  </div>
</div>

<button  type="submit" class="addbtn" onClick="openForm1()" style=" position:relative; bottom:150px; left:50px; height:40px; width:150px; font-weight:bold; "> ADD ITEM </button>


<?php


    if(isset($_GET['stat']))
    {

      $dl=$_GET['idr'];
      $del="delete from item where itemID=$dl";
      $reslt=mysqli_query($db_connect,$del);
      if($reslt)
     header("Refresh:0; url=seller.php?un=$uname");
    }

     if(isset($_GET['id']))
    
      {
            $c=$_GET['id'];
            $uname=$_GET['un'];

        $ret="select * from item inner join item_type on itemtype_id=itemtypeid where itemID=$c";
        $sr=mysqli_query($db_connect,$ret);


 while($row=mysqli_fetch_array($sr))
{

      $rid=$row['itemtypeid'];
      $r=$row['itemtype'];
      $r1=explode("_",$row['itemname'])[0];
      $r2=$row['itemqty'] ;
      $r3=$row['itemprice'];

}  
       
       
      

    echo '<div class="form-popup" id="editform" style="background-color: white">
  <form action="seller.php" class="form-container" >
    <h1 style="color:#b52a62"><b>Item Update </b></h1>

    <pre id=lg >

 <h4 ><span style="font-weight:bolder;">Item_type</span>      <select name=select id=itype style="width:215px;">
  <option value='."$rid".'  >'."$r".'</option>}
  <option value=101>Plastic</option>
  <option value=102>Paper</option>
  <option value=103>Cloth</option>
  <option value=104>Metal</option>
  <option value=105>E-Waste</option>
  <option value=106>Wood</option>
</select> </h4>
 
 <h4><span style="font-weight:bolder;">Item_name</span>      <input type =text pattern="[A-Za-z]+" title="Only alphabets" name=iname id=in width=30 value='."$r1".'> </h4>
 <h4><span style="font-weight:bolder;">Item_quantity</span>  <input type =number min=0 title="Greater than 0" name=iqtye id=iq width=30 value='."$r2".'> </h4> 
 <h4><span style="font-weight:bolder;">Item_price</span>     <input type =number min=0 title="Greater than 0" name=iprice id=ip  width=30 value='."$r3".'>  </h4> 
</pre>

<h4 style="text-align:center; margin-right:10px; " class=" btn1 pull-left"> <input onClick=f() type=submit name=submit value=Update> </h4> 
 
 <h4 style="text-align:center; margin-left:10px; " class="btn2 pull-right"> <input type=button name=submit value=Close onclick="closeForm2()"> </h4> 
    <!-- <button type="submit" class="btn cancel" >Close</button>-->
   <input name ="un"  style="display:none;" value='."$uname".'>
   <input name ="ide"  style="display:none;" value='."$c".'>
  </form>
</div>' ;


   
    echo '<script type="text/javascript">openForm2();</script>';
    }



  
?>

<?php

      if(isset($_GET['iqtye']))
      {
  
    $x=ucfirst(strtolower($_GET['iname']))."_".$uname;
    $q=$_GET['iqtye'];
    $p=$_GET['iprice'];
    $t=$_GET['select'];
    $id=$_GET['ide'];
    
  $update="update item set itemname='$x',itemqty=$q,itemprice=$p,itemtype_id=$t where itemID=$id";

    $sr=mysqli_query($db_connect,$update);

     if($sr)
     header("Refresh:0; url=seller.php?un=$uname");
      }


?>

</div>




<div class="form-popup" id="addform" style="background-color: white">
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"    class="form-container" >
    <h1 style="color:#b52a62"><b>New Item</b></h1>

    <pre id=lg >

 <h4 ><span style="font-weight:bolder;">Item_type</span>      <select name=select id=itype style="width:215px;">
  <option value="item"  >-------SELECT------</option>}
  <option value="101">Plastic</option>
  <option value="102">Paper</option>
  <option value="103">Cloth</option>
  <option value="104">Metal</option>
  <option value="105">E-Waste</option>
  <option value="106">Wood</option>
</select> </h4>
 <h4><span style="font-weight:bolder;">Item_name</span>      <input type =text pattern="[A-Za-z' ']+" title="Only alphabets" name=iname id=in width=30 value=""> </h4>
 <h4><span style="font-weight:bolder;">Item_quantity</span>  <input type =number min=0 title="Greater than 0" name=iqty id=iq width=30 value=""> </h4> 
 <h4><span style="font-weight:bolder;">Item_price</span>     <input type =number min=0 title="Greater than 0" name=iprice id=ip  width=30 value="">  </h4> 
 </pre>

<h4 style="text-align:center; margin-right:10px; " class=" btn1 pull-left"> <input onClick=f()  type=submit name=submit value=Add> </h4> 
 
 <h4 style="text-align:center; margin-left:10px; " class="btn2 pull-right"> <input   type=submit name=submit value=Close onclick="closeForm1()"> </h4> 
 <input name ='un'  style="display:none;" value="<?php echo $uname ?>">
    <!-- <button type="submit" class="btn cancel" >Close</button>-->
 
  </form>
</div> 



 <footer class="foo">
        <strong><br>All Rights Reserved <br> &copyWM</strong>
    </footer>


</body>
</html>