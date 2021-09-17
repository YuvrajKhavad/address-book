<?php
include('../../include/db.php');
$res = mysqli_query($con, "SELECT * FROM persons WHERE ");
$count = 1;
while($row = mysqli_fetch_array($res))
{
    echo '<tr id="'.$row['ID'].'">
            <td>'.$count.'</td>
            <td>'.$row['Amount'].'</td>
            <td>'.$row['First_Name'].'</td>
            <td>'.$row['Last_Name'].'</td>
            <td>'.$row['Surname'].'</td>
            <td>'.$row['Village_Name'].'</td>
            <td><button class="btn btn-danger" id="'.$row['ID'].'">Remove</button></td>
          </tr>';
    $count++;
}



include('../../../include/db.php');
$column = $_POST["column"];
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