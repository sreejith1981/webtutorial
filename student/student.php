<?php
include 'dbConfig.php';

class student extends dbConfig
{
    function __construct()
    {
        parent::dbConnect();
    }


    function getStudent($search, $blnIsId)
    {
        $result = array();

        if($blnIsId)
        {
            $strSQL = "SELECT Id,name,email,createdDate FROM Student WHERE Id=$search";
        }
		else
        {
            $strSQL = "SELECT Id,name,email,createdDate FROM Student WHERE name like '%$search%'";
        }

        $query = parent::executeQuery($strSQL);
        while($row = mysqli_fetch_array($query))
        {
            $result[] = $row;
        }

        return $result;
    }


    function createStudent($strName, $strEmail, $dtmDate)
    {
        $strSQL = "INSERT INTO Student set name='$strName', email='$strEmail', createdDate='$dtmDate'";
        $result = parent::executeQuery($strSQL);
        return $result;
    }


    function updateStudent($intId, $strName, $strEmail, $dtmDate)
    {
        $strSQL = "UPDATE Student set name='$strName', email='$strEmail', createdDate='$dtmDate' WHERE Id=$intId";
        $result = parent::executeQuery($strSQL);
        return $result;
    }


    function deleteStudent($intId)
    {
        $strSQL = "DELETE FROM Student WHERE Id=$intId";
        $result = parent::executeQuery($strSQL);
        return $result;
    }
}
?>
