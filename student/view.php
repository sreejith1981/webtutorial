<?php
include 'student.php';
$objStudent = new student();
?>

<html>
<head>
<meta name="description" content="Php Code for View,Search, Edit and DeleteRecord" />
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<title>View StudentRecord</title>
</head>
<body>
<center><h1><u>Student Database</u></h1></center>
<?php
$id = $_GET["studentid"];
$result = $objStudent->getStudent($id, true);

foreach ($result as $row)
{
?>
<table style=" border:1px solid silver" cellpadding="5px" cellspacing="0px"align="center" border="1">
<tr>
<td colspan="4" style="background:#0066FF; color:#FFFFFF; font-size:20px">VIEW STUDENT DATABASE</td>
</tr>
<tr>
<td> Name of Student</td><td><?php echo $row[1]; ?></td>
<td> Email</td><td><?php echo $row[2]; ?></td>
</tr>
<tr>
<td>Date</td><td><?php echo $row[3]; ?></td>
</tr>
</table>
<?php } ?>
<p align="center"><a href="index.php">Go Back to Home</a></p>
</body>
</html>
