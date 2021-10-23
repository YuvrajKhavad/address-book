<?php
include('../../../include/db.php');
$village_name = trim($_POST['search-village-name']);
$search_by_amount = trim($_POST['search-by-amout']);
$search_by_name = trim($_POST['search-by-name']);

// Main Query
//			$res = mysqli_query($con, "SELECT * FROM persons, location WHERE location.ID = persons.Village_Name");
$query = "SELECT * FROM `persons`";
//$query = "SELECT * FROM `persons`, `location`";

//$query .= " WHERE";
if(!empty($village_name) || !empty($search_by_amount) || !empty($search_by_name))
{
    $query .= " WHERE";
}

if(!empty($village_name))
{
    $query .= "`Village_Name` = '".$village_name."'";

    if($search_by_amount || $search_by_name)
    {
        $query .= " AND ";
    }
}

if(!empty($search_by_amount))
{
    $query .= "`Amount` = '".$search_by_amount."'";

    if( $search_by_name)
    {
       $query .= " AND ";
    }
}

if(!empty($search_by_name))
{
    $query .= " CONCAT(First_Name,' ',Last_Name,' ',Surname ) like '%" . $search_by_name . "%'";
}

//$query .= " AND location.ID = persons.Village_Name";

$res = mysqli_query($con, $query);
$count = 1;
$tr = "";
$sum = 0;
while($row = mysqli_fetch_array($res))
{
    $tr .= '<tr id="'.$row['ID'].'">
                <td>'.$count.'</td>
                <td>'.$row['Amount'].'</td>
                <td>'.$row['First_Name'].'</td>
                <td>'.$row['Last_Name'].'</td>
                <td>'.$row['Surname'].'</td>
                <td>'.$row['Village_Name'].'</td>
                <td><button class="btn btn-danger" id="'.$row['ID'].'">Remove</button></td>
            </tr>';
    $count++;

    $sum += (int)$row['Amount'];
}
// Tr shows total
$tr .= '<tr id="total-amout">
            <td><b>Total</b></td>
            <td><b>'.$sum.'</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>';

echo $tr;