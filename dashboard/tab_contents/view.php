<form class="form-vertical" role="form" id="SearchForm">
	<div class="form-group mb-2">
		<input type="text" name = "search-village-name" class="form-control" id="search-village-name" placeholder="Search Village Name">
		<input type="hidden" class="form-control" name="search-village-id" id="search-village-id"/>
		<div id="search-village-name-suggesstion-box"></div>
	</div>

	<div class="form-group mb-2">
		<input type="text" name = "search-by-amout" class="form-control" id="search-by-amout" placeholder="Search By Amount">
		<div id="search-by-amout-suggesstion-box"></div>
	</div>

	<div class="form-group mb-2">
		<input type="text" name = "search-by-name" class="form-control" id="search-by-name" placeholder="Search By Full Name">
		<div id="search-by-name-suggesstion-box"></div>
	</div>

	<div class="form-group mx-sm-3 mb-2">
		<input type="submit" class="btn btn-success mb-2 search-button" value="Find"/>
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
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="table-boday">
		<?php
			include('../../include/db.php');
			$res = mysqli_query($con, "SELECT persons.ID as person_ID ,persons.Amount,persons.First_Name,persons.Last_Name,persons.Surname,location.Village_Name FROM persons INNER JOIN location ON persons.Village_Name = location.ID ORDER BY persons.ID");
			$count = 1;
			$tr = "";
			$sum = 0;
			while($row = mysqli_fetch_array($res))
			{
				$tr .= '<tr id="'.$row['person_ID'].'">
							<td>'.$count.'</td>

							<td>
								<label class="person" id="amount">'.$row['Amount'].'</label>
								<input type="text" name="amount" id="amount" class="form-control" style="display:none" value="'.$row["Amount"].'"/>
							</td>

							<td>
								<label class="person" id="fn">'.$row['First_Name'].'</label>
								<input type="text" name="fn" id="fn" class="form-control" style="display:none" value="'.$row["First_Name"].'"/>
							</td>

							<td>
								<label class="person" id="ln">'.$row['Last_Name'].'</label>
								<input type="text" name="ln" id="ln" class="form-control" style="display:none" value="'.$row["Last_Name"].'"/>
							</td>

							<td>
								<label class="person" id="surname">'.$row['Surname'].'</label>
								<input type="text" name="surname" id="surname" class="form-control" style="display:none" value="'.$row["Surname"].'"/>
							</td>

							<td>
								<label class="person" id="village-name">'.$row['Village_Name'].'</label>
								<input type="text" class="form-control" name="village-name" id="village-person-name" data-id="'.$row['person_ID'].'" data-person="village-person-name-'.$row['person_ID'].'" style="display:none" value="'.$row["Village_Name"].'" autocomplete="off">
								<input type="hidden" class="form-control" name="village-name-id" id="village-person-name-'.$row['person_ID'].'">
								<div id="village-person-name-'.$row['person_ID'].'-suggesstion-box"></div>
							</td>

							<td><button class="btn btn-success edit" id="'.$row['person_ID'].'">Edit</button></td>
							<td><button class="btn btn-danger delete" id="'.$row['person_ID'].'">Delete </button></td>
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
		?>
	</tbody>
</table>