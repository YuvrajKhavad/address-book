
<a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
Search
</a>
<div class="collapse" id="collapseExample">
  <div class="card card-body">
    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
  </div>
</div>

<p class="text-center" id="deleteRes"></p>
<table class="table table-condensed table-responsive">
	<thead>
		<tr>
			<th>No</th>
			<th>Amount</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Surname</th>
			<th>Village Name</th>
			<th>Actiona</th>
		</tr>
	</thead>
	<tbody>
		<?php
			include('../../include/db.php');
			$res = mysqli_query($con, "SELECT * FROM persons");
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
		?>
	</tbody>
</table>