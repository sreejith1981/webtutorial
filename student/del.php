<?php
include 'student.php';
$objStudent = new student();
?>
<html>
<head>
<meta name="description" content="Php Code for View, Search, Edit and DeleteRecord" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Student Record</title>
</head>
<body>
<?php
$id = $_GET["studentid"];
$result = $objStudent->deleteStudent($id);
if($result) echo "<center>Successfully Deleted</center>";
//include("search.php");
header("Location: search.php");
?>
</body>
</html>
