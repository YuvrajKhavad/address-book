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
			<th>Village</th>
			<th>Taluka</th>
			<th>District</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="table-boday">
		<?php
			//include('../../include/db.php');
			$res = mysqli_query($con, "SELECT * FROM `location`");
			$count = 1;
			$tr = "";
			$sum = 0;
			while($row = mysqli_fetch_array($res))
			{
				$tr .= '<tr id="'.$row['ID'].'">
							<td>'.$count.'</td>
							<td>'.$row['Village_Name'].'</td>
							<td>'.$row['Taluka_Name'].'</td>
							<td>'.$row['District_Name'].'</td>
							<td><button class="btn btn-danger" id="'.$row['ID'].'">Delete </button></td>
					  </tr>';
				$count++;

				//$sum += (int)$row['Amount'];
			}
			echo $tr;
		?>
	</tbody>
</table>