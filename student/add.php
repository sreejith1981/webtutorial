<?php
include 'student.php';
$objStudent = new student();
?>

<html>
<head>
<meta name="description"content="Php Code for View, Search,Edit and Delete Record" />
<meta http-equiv="Content-Type"content="text/html; charset=iso-8859-1" />
<title>Add Student Record</title>
</head>
<body>
<center><h1><u>Student Database</u></h1></center>

<?php
if($_POST["do"] == "store")
{
    $name = $_POST["sname"];
    $email = $_POST["email"];
    $createdDate = $_POST["cdate"];

    $result = $objStudent->createStudent($name, $email, $createdDate);
    if($result) echo "<center>Successfully store in DATABASE</center>";
}
?>

<form name="add" method="post" action="add.php">
<table style=" border:1px solid silver" cellpadding="5px" cellspacing="0px"align="center" border="0">
<tr>
<td colspan="4" style="background:#0066FF; color:#FFFFFF; font-size:20px">ADD STUDENT RECORD</td>
</tr>
<tr>
<td>Enter Name</td><td><input type="text" name="sname" size="20"></td>
<td>Enter Email</td><td><input type="email" name="email" size="20"></td>
</tr>
<tr>
<td>Enter Date</td><td><input type="date" name="cdate" size="20"></td>
</tr>
<tr>
<td colspan="4" align="center"><input type="hidden" name="do" value="store"><input type="submit" value="ADD RECORD"></td>
</tr>
</table>
</form>
<p align="center"><a href="index.php">Go Back to Home</a></p>
<?php include("search.php"); ?>
</body>
</html>
