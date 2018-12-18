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
  
  $search="select  * from admin where adminid=$uname";
  $sr=mysqli_query($db_connect,$search);
 while($row=mysqli_fetch_array($sr))
{
     $res1=$row['adminid'];
     $res2=$row['name'];
     
     $res3=$row['phone'];
     
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
                    <img onerror="this.src='smile.jpg'" src='<?php echo "$image"; ?>'
                     style="font-color:white;">
                </div>
                <div class="info">
                    <div class="title">
                        <b> <?php echo "$res2" ?></b>
                    </div>
                    <div class="desc"><?php echo "$res3" ?></div>
                    
                    
                    
                </div>
                
            </div>

        </div>
   </div>
	</div>
</div>

 <a id="x" href="#">About Us</a> 
 <a id="x" href="ragpicker.php">Deliver</a>
<a id="x" href="first.html">Home</a> 

</div>
</div>
</header>
<div style="height:300px; width:800px; margin:100px auto;">
 <div class="tablediv" style="margin-left: 50px;">
      <table width="800px" height="auto" class="ragtable">
        <tr>
            <th>Item Type</th>
            <th>Available</th>
            <th>Sold</th>
           
            
        </tr>


<?php

$db_connect=mysqli_connect("localhost","root","");                      //host name  , user name, password
 $db_selected=mysqli_select_db($db_connect,"sahana");  

$view="create or replace view report(type,avialable) as select itemtype , sum(itemqty)  from item right outer join item_type on itemtype_id=itemtypeid group by itemtypeid ";
  if(isset($_GET['select']) && $_GET['select']!='item' )
  {
    $new=$_GET['select'];
    $view = $view." having itemtype = '$new' ";
  }
  $v1=mysqli_query($db_connect,$view);
  $view1="create or replace view report1(type,sold) as select itemtype , sum(itemqty) from items_sold i right outer join item_type j on i.itemtypeid=j.itemtypeid group by j.itemtypeid ";
if(isset($_GET['select']) && $_GET['select']!='item' )
  {
    $new=$_GET['select'];
    $view1="$view1"." having itemtype='$new'";
    
  }

  $v2=mysqli_query($db_connect,$view1);
  $final_view="create or replace view finalreport(Type,Available,Sold) as select * from report natural join report1";

  $v3=mysqli_query($db_connect,$final_view);

  $search="select * from finalreport";
  $sr=mysqli_query($db_connect,$search);
 while($row=mysqli_fetch_array($sr))
{
     $res1=$row['Type'];
     $res2=$row['Available'];
     $res3=$row['Sold'];
     if(is_null($res2))
      $res2=0;
     if(is_null($res3))
      $res3=0;
     echo "
     <tr>

         
        <td>  $res1  </td>
        <td>  $res2   </td>
        <td>  $res3   </td>
        

     </tr>";
        
}


?>   


</table>
  </div>
</div>




<form method=get action=""> 
<div  class="filter" style=" position:relative; bottom:450px; left:30px; ">  
  <select class="filtersel" name=select id=itype >
  <option  value="item"  >- - - - ALL - - - -</option>}
  <option value=Plastic>Plastic</option>
  <option value=Paper>Paper</option>
  <option value=Cloth>Cloth</option>
  <option value=Metal>Metal</option>
  <option value=E-Waste>E-Waste</option>
  <option value=Wood>Wood</option>
</select>
<button class="btsel">OK</button> 
</div>
<input  style="display:none;" value='<?php echo "$uname"; ?>' name='un'>
</form>
</div>

 
  

 <footer class="foo">
        <strong><br>All Rights Reserved <br> &copyWM</strong>
    </footer>
</body>
</html>