<?php
include('../../../include/db.php');
$village_name = trim($_POST['search-village-name']);
$search_by_amout = trim($_POST['search-by-amout']);

// Main Query
$query = "SELECT * FROM `persons`";

if(!empty($village_name) || !empty($search_by_amout))
{
    $query .= " WHERE";
}

if(!empty($village_name))
{
    $query .= "`Village_Name` = '".$village_name."'";
}

if(!empty($search_by_amout))
{
    if(!empty($village_name))
    {
        $query .= "AND";
    }
    $query .= "`Amount` = '".$search_by_amout."'";
}
//$res = mysqli_query($con, "SELECT * FROM persons WHERE  `Village_Name` = ".$village_name);
$res = mysqli_query($con, $query);
//echo "SELECT * FROM persons WHERE  `Village_Name` = ".$village_name;
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