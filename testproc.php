<?php



$db_connect=mysqli_connect("localhost","root","");                      //host name  , user name, password
 $db_selected=mysqli_select_db($db_connect,"sahana"); 
 $counter=$_GET['counter'];
echo date('Y/m/d');
if(date("Y/m/d")=="2018/11/06" && $counter==0)
{
 
 $res="call festivalupdate()";
 $x=mysqli_query($db_connect,$res);
$counter+=1;
 header("Refresh:0.5; url=testproc.php?counter=$counter");
}

?>