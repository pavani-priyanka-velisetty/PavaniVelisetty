<?php
session_start();
if($_SESSION['emailid']=="")
{
	header('location:login.php');
}
$myConnection = mysqli_connect("localhost","root","","browseplan") or die ("could not connect to mysql");
mysqli_select_db($myConnection,"browseplan");
$emailid=$_GET['emailid'];
$wamt="SELECT wallet from users where email='$emailid'";
$result=mysqli_query($myConnection,$wamt);
$row= mysqli_fetch_array($result);
$amt=$row['wallet'];

	if(isset($_POST['wallet']) )
	{
	$amount=$_POST['amount'];
	header("location:bankver.php?emailid=$emailid&amount=$amount");
	}
if(isset($_POST['proceed']) )
	{
	$mob=$_POST['mobile'];
	$amount=$_POST['amount'];	
	header("location:bankver.php?emailid=$emailid&amount=$amount");
	}
$op = isset($_POST['operator'])?$_POST['operator']:"Vodafone";
if(isset($_POST['submit']))
{
$op=$_POST['operator'];
}
?>


<html>
<head>
<link rel="stylesheet" href="css/bootstrap.css" />
	<link rel="stylesheet" href="customstyle.css" />
	<style>
	

	tr{
	border:2px solid gray;
	}
	td,th{
	padding:20px; 
	
	}
div.homestyle
{

border:1px solid #00BFFF;
 margin-top:10%;
padding-top:70px;
padding-right:15px;
padding-left:15px;
padding-bottom: 10px;
}
div.rightstyle{
float:left;
margin-top:10%;
margin-left:10%;
border:1px solid #00BFFF;

padding-left:15px;padding-right:15px;
padding-bottom: 35px;
}
input,select
{
width:100%;
font-size:25px;
}
input.submit
{
font-size:30px;
background-color:#00BFFF;
color:white;
border:1px solid #00BFFF;
border-radius:7px;
}
p{
	border-bottom:1px solid blue;
}
</style>
</head>
<body>

<div class="container">

<!-- <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">  -->
<nav class="navbar navbar-fixed-top" role="navigation" style="background-color:#0040ff;"> 
<div class="navbar-header">
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">  

<span class="icon-bar">  </span>
<span class="icon-bar">  </span>
<span class="icon-bar">  </span>
<a href=""></a>

</button>

 <a href="#" id="padma" class="navbar-brand"> GRAB IT.COM </a> 

</div> <!-- END OF  NAV BAR HEADER -->

<div class="collapse navbar-collapse" id="collapse">

<ul class="nav  navbar-nav navbar-right" >
<li><a href="" id="padma">  Home </a>  </li>
<li><a href="#" id="padma"> Wallet Rs.<?php echo $amt;?>  </a></li>
<li><a href="logout.php" id="padma"> Log Out </a>  </li>
</ul>

</div>  <!-- END OF DIV CLASS AFTER NAVBAR HEADER -->

</nav>



<div style="width:100%; ">
<div style="width:35%;float:left;margin-left:3%;" class="homestyle">
<form  action ="" method="post"> 

<input type="text" placeholder="Add money to wallet" name="amount" required="required"><br><br>
<input type="submit" value="Add to wallet" name="wallet" ><br><br> </form> 

<form  action ="" method="post"> 
  <input type="tel" placeholder="Enter Mobile Number" name="mobile" pattern="[789][0-9]{9}" required="required"> <br> <br>
   <select name="operators" required="required">
    <option value="vodafone">Vodafone</option>
    <option value="airtel">Airtel</option>
    <option value="reliance">Reliance</option>
  </select> <br> <br>
 <input type="text" placeholder="Enter Recharge Amount" name="amount" required="required">  <br> <br> <br>
<!-- <div align="right" style="padding-left:40px"><a href="">Browse plan</a></div> <br> <br> -->
<input type="submit" value="Proceed to Recharge" name="proceed"> <br> <br>
</form>
</div>

 <div  style="width:45%;" class="rightstyle"> <br> 
 <form method="post"> <br> <br>
  <input type="text" placeholder="Enter Operator" name="operator" id="name" value="<?php echo $op; ?>"><br><br>
   <?php 
  if($op!='Vodafone' && $op!='Airtel' && $op!='Idea') 
  {
	echo '<script>alert("No Browse Plans !!")</script>';  
	echo '<script> location.href="insert1.php?emailid='.$emailid.'" </script>';
  }  
  ?>
  
  <input value="Select Operator" type="submit" name="submit">
</form>
 
<ul class="nav nav-tabs">
<li> <a href="#firstcontent" data-toggle="tab"> 3G Data </a> </li>
<li> <a href="#secondcontent" data-toggle="tab"> Full Talktime </a> </li>
<li> <a href="#thirdcontent" data-toggle="tab"> 2G Data </a> </li>

</ul>


<div class="tab-content"> 

<p class="tab-pane fade active in" id="firstcontent" >
<?php
if(isset($_POST['submit']))
{
$op=$_POST['operator'];
}
$q="SELECT * FROM browseplan WHERE Operators='$op' AND Plans='3G Data'"; 
$sql = mysqli_query($myConnection, $q)or die(mysqli_error($myConnection));

 		echo "<table>";
		echo "<tr >";
		echo "<th> Talktime </th>";
		echo "<th> Validity </th>";
		echo "<th> Description </th>";
		echo "<th> Price </th>";
		echo "</tr>";
	while($row= mysqli_fetch_array($sql))
	{
		$price=$row['Price'];
	
	 echo "<tr>";
	echo "<td>".$row['Talktime']."</td>";
	echo "<td>".$row['Validity']."</td>";
	echo "<td>".$row['Description']."</td>";
	echo "<td>".$row['Price']."</td>";
	echo "</tr>";
	}
echo "</table>";
?>  

</p>

<p class="tab-pane fade" id="secondcontent" >
<?php


$q1="SELECT * FROM browseplan WHERE Operators='$op' AND Plans='Talktime'"; 
$sql1 = mysqli_query($myConnection, $q1)or die(mysqli_error($myConnection));
 		echo "<table>";
		echo "<tr >";
		echo "<th> Talktime </th>";
		echo "<th> Validity </th>";
		echo "<th> Description </th>";
		echo "<th> Price </th>";
		echo "</tr>";
	while($row1= mysqli_fetch_array($sql1))
	{
	 echo "<tr>";
	echo "<td>".$row1['Talktime']."</td>";
	echo "<td>".$row1['Validity']."</td>";
	echo "<td>".$row1['Description']."</td>";
	echo "<td>".$row1['Price']."</td>";
	echo "</tr>";	
	
	}
echo "</table>";
?>  

</p>

<p class="tab-pane fade" id="thirdcontent" >
<?php
$q2="SELECT * FROM browseplan WHERE Operators='$op' AND Plans='2G Data'"; 
$sql2 = mysqli_query($myConnection, $q2)or die(mysqli_error($myConnection));
 		echo "<table>";
		echo "<tr >";
		echo "<th> Talktime </th>";
		echo "<th> Validity </th>";
		echo "<th> Description </th>";
		echo "<th> Price </th>";
		echo "</tr>";
	while($row2= mysqli_fetch_array($sql2))
	{
	 echo "<tr>";
	echo "<td>".$row2['Talktime']."</td>";
	echo "<td>".$row2['Validity']."</td>";
	echo "<td>".$row2['Description']."</td>";
	echo "<td>".$row2['Price']."</td>";
	echo "</tr>";	
	
	}
echo "</table>";
?>  

</p>

</div>
</div> <!-- END OF CONTAINER -->

	<script type="text/javascript" src="jquery-1.12.4.js"> </script>
	<script type="text/javascript" src="js/bootstrap.js"> </script>
	<script type="text/javascript"> 
	
	$(function(){
	
	$('.nav-tabs a:first').tab('show');
	
	
	
	});
	
	</script>

</body>
</html>