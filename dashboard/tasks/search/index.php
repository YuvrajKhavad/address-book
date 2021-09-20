<?php
include('../../../include/db.php');
$column = $_POST["column"];
if($column == "full")
{

}
else
{

}
$search_query = mysqli_query($con, "SELECT  DISTINCT($column) FROM persons WHERE $column like '" . $_POST["keyword"] . "%'");
?>
<ul class="search-result">
<?php
while($row_search = mysqli_fetch_array($search_query))
{
?>
    <li onClick="selectResult('<?php echo $row_search[$column]; ?>', '<?php echo $_POST["id"]; ?>');"><?php echo $row_search[$column]; ?></li>
<?php
}
?>
</ul>