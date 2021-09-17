<form class="form-vertical" role="form" id="SearchForm">
	<div class="form-group mb-2">
		<label for="inputPassword2" class="sr-only">Village Name</label>
		<input type="text" name = "search-village-name" class="form-control" id="search-village-name" placeholder="Village Name">
		<div id="search-village-name-suggesstion-box"></div>
	</div>
	<div class="form-group mx-sm-3 mb-2">
		<input type="submit" class="btn btn-primary mb-2 search-button" value="Find" id="addBtn2" />
		<input type="submit" class="btn btn-success" value="Add" id="addBtn" />
	</div>
</form>
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
	<tbody id="table-boday">
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