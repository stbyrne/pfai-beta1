<?php

$table = $_POST['table'];
$rowid = $_POST['row_id'];
$id = $_POST['delete_id'];

echo $table;
echo $row_id;
echo $id;

mysql_connect("localhost", "root", "")or die("cannot connect");
mysql_select_db("transfer")or die("cannot select DB");

$query = "DELETE FROM $table WHERE $rowid = $id";
echo $query;
if(mysql_query($query)){
    echo 'Data deleted';   
}else{
    die(mysql_error());   
}

?>