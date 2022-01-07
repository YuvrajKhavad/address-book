<?php
include('../../../include/db.php');
$column = $_POST["column"];
if($column !== "full")
{
    $table = ($column == "Village_Name")?'location ':'persons';
    if($column == "Village_Name")
    {
        $search_query = mysqli_query($con, "SELECT `ID`, $column FROM $table WHERE $column like '%" . $_POST["keyword"] . "%'");
    }
    else
    {
        $search_query = mysqli_query($con, "SELECT DISTINCT($column) FROM $table WHERE $column like '%" . $_POST["keyword"] . "%'");
    }
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
    $id = (isset($row_search['ID']))?$row_search['ID']:'';
?>
    <?php if($column == 'First_Name') { ?>
        <li onClick="selectResultFirst_Name('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>', <?php echo $id; ?>);"><?php echo $row_search[$column]; ?></li>
    <?php } else if($column == 'Last_Name') { ?>
        <li onClick="selectResultLast_Name('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>', <?php echo $id; ?>);"><?php echo $row_search[$column]; ?></li>
    <?php } else if($column == 'Surname') { ?>
        <li onClick="selectResultSurname('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>', <?php echo $id; ?>);"><?php echo $row_search[$column]; ?></li>
    <?php } else { ?>
        <li onClick="selectResult('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>', <?php echo $id; ?>);"><?php echo $row_search[$column]; ?></li>
    <?php } ?>
<?php
}
?>
</ul>