<?php
include('../../../include/db.php');
$column = $_POST["column"];
if($column !== "full")
{
    $table = ($column == "Village_Name")?'location ':'persons';
    $search_query = mysqli_query($con, "SELECT DISTINCT($column) FROM $table WHERE $column like '%" . $_POST["keyword"] . "%'");
}
else
{
    $search_query = mysqli_query($con, "SELECT DISTINCT(CONCAT(First_Name,' ',Last_Name,' ',Surname )) AS full FROM persons WHERE CONCAT(First_Name,' ',Last_Name,' ',Surname ) like '%" . $_POST["keyword"] . "%'");
}
?>
<ul class="search-result">
<?php
while($row_search = mysqli_fetch_array($search_query))
{
?>
    <li onClick="selectResult('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>', '<?php echo $row_search['ID']; ?>');"><?php echo $row_search[$column]; ?></li>
<?php
}
?>
</ul>