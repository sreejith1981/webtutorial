<html>
<head>
<meta name="description"content="Php Code for View,Search, Edit and DeleteRecord" />
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<title>Search Student Record</title>
</head>
<body>
<center><h1><u>Student Database</u></h1></center>
<form name="search" method="post" action="search.php">
<table style=" border:1px solid silver" cellpadding="10px" cellspacing="0px"align="center">
<tr>
<td colspan="3" style="background:#0066FF; color:#FFFFFF; font-size:20px">Search</td>
</tr>
<tr>
<td>Enter Search Keyword</td>
<td><input type="text" name="search" size="40" /></td>
<td><input type="submit" value="Search" /></td>
</tr>
<tr>
<td colspan="3">&nbsp;</td>
</tr>
<tr bgcolor="#CCCCCC">
<th><a href="add.php">Add Record</a></th>
<th><a href="del.php">Delete Record</a></th>
<th><a href="del.php">Update Record</a></th>
</tr>
</table>
</form>
</body>
</html>
