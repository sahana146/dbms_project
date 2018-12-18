<html>
    <head>
        <title>ragpickerinfo</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" media="screen" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</script>
<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

</script>

<script>
function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");

  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";

    } else {
      a[i].style.display = "none";
    }
  }
  
}
</script>

    </head>
    <body>
        
<div id="wrapper">
</div>

        <style><?php include 'ragpickercss.css'; ?></style>
        <div class="topnav">
        
        </div>
        <div class="navbar">
        <a href="first.html" id="home">Home</a>
        <a href="homepage.html" id="aboutus">About Us</a>
    </div>
        
        





 
<div class="tablediv" align="center">
      <table width="800px"  class="ragtable">
        <thead>
        <tr >
            <th>RagID</th>
            <th>RName</th>
            <th>Locality</th>
            <th>Photo</th>
            <th>Age</th>
        </tr>
    </thead>
    <tbody>
 <?php 
 $db_connect=mysqli_connect("localhost","root","");                      
 $db_selected=mysqli_select_db($db_connect,"sahana"); 
$ret="select * from ragpicker";
if(isset($_GET['place']))
{
    $val=$_GET['place'];
    if($val !='city')
    {
        
        $ret="select * from ragpicker where locality like '%$val%' order by rname";
    }
}
    $sr=mysqli_query($db_connect,$ret);
if($sr)
{
    while($row=mysqli_fetch_array($sr))
    {
            $r1=$row['ragID'];
            $r2=$row['rname'];
            $r3=$row['locality'];
            $r4=$row['photo'];
            $r5=$row['age'];
            
            echo "
     <tr>

        <td>  $r1  </td>
        <td>  $r2   </td>
        <td>  $r3   </td>
        <td > <img src=$r4 alt='Invalid' id='ragpimage'> </td>
        <td>  $r5   </td>

     </tr>";            

    }
}

?>
</tbody>
</table>


  </div>
<form method=get action="">
    <div class="dropdown1">
            <button class="dropbtn1">Filter </button>
    <div class="dropdown-content1" >
        <select class="sel" name=place id=placename>
            
            <option value="city">City..</option>
            <option value="mysuru">Mysore</option>
            <option value="bangalore">Bangalore</option>
            <option value="mangalore">Mangalore</option>
            <option value="udupi">Udupi</option>
            <option value="chikmagalur">Chikmagalur</option>
            <option value="chamarajanagara">Chamarajanagara</option>
            <option value="kolar">Kolar</option>
        
        </select>
    </div>
        <button class="btsel">Ok</button>
    
    </div>
</form>
      
   <footer class="foo">
        <strong><br>All Rights Reserved <br> &copyWM</strong>
    </footer>

    </body>
</html>