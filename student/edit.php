<?php
include 'student.php';
$objStudent = new student();
?>

<html>
<head>
<meta name="description" content="Php Code for View,Search, Edit and DeleteRecord" />
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<title>Update Student Record</title>
</head>
<body>
<?php
if($_POST["do"] == "update")
{
    $id = $_POST["studentid"];
    $name = $_POST["sname"];
    $email = $_POST["email"];
    $date = $_POST["cdate"];

    $result = $objStudent->updateStudent($id, $name, $email, $date);
    if($result) echo "<center>Successfully Updated in DATABASE</center>";

    header("Location: search.php");
}
?>
<center><h1><u>Student Database</u></h1></center>
<?php
$id = $_GET["studentid"];
$result = $objStudent->getStudent($id, true);
foreach ($result as $row)
{
?>
<form name="update" method="post" action="edit.php">
<table style=" border:1px solid silver" cellpadding="5px" cellspacing="0px"align="center" border="0">
<tr>
<td colspan="4" style="background:#0066FF; color:#FFFFFF; font-size:20px">ADD STUDENT RECORD</td>
</tr>
<tr>
<tr>
<td><?php echo $row[0]; ?><input type="hidden" name="studentid" size="20" value="<?php echo $row[0]; ?>"></td>
<td>Enter Name of Student</td><td><input type="text" name="sname" size="20" value="<?php echo $row[1]; ?>"></td>
</tr>
<tr>
<td>Enter Email</td><td><input type="email" name="email" size="20" value="<?php echo $row[2]; ?>"></td>
<td>Enter Date</td><td><input type="date" name="cdate" size="20" value="<?php echo $row[3]; ?>"></td>
</tr>
<tr>
<td colspan="4" align="center"><input type="hidden" name="do"value="update"><input type="submit" value="UPDATE RECORD"></td>
</tr>
</table>
</form>
<?php } ?>
<p align="center"><a href="index.php">Go Back to Home</a></p>
</body>
</html>
