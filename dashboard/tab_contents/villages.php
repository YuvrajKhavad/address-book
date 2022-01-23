<!--form class="form-vertical" role="form" id="SearchForm">
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
</form-->
<p class="text-center" id="deleteRes"></p>
<table class="table table-condensed table-responsive">
	<thead>
		<tr>
			<th>No</th>
			<th>Village</th>
			<th>District</th>
			<th>Taluka</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="table-boday">
		<?php
			//include('../../include/db.php');
			$res = mysqli_query($con, "SELECT * FROM `location`");
			$count = 1;
			$array_count = 1;
			$tr = "";
			$sum = 0;
			$districts = array("અમદાવાદ", "અમરેલી" , "આણંદ", "અરવલ્લી", "બનાસકાંઠા", "ભરૂચ", "ભાવનગર", "બોટાદ", "છોટા ઉદેપુર", " દાહોદ", "ડાંગ (આહવા)", "દેવભૂમિ દ્વારકા", "ગાંધીનગર", "ગીર સોમનાથ","જામનગર","જુનાગઢ","કચ્છ","ખેડા (નડિયાદ)","મહીસાગર","મહેસાણા"," મોરબી"," નર્મદા (રાજપીપળા)","નવસારી","પંચમહાલ (ગોધરા)","પાટણ","પોરબંદર","રાજકોટ","સાબરકાંઠા(હિંમતનગર)","સુરત","સુરેન્દ્રનગર","તાપી (વ્યારા)","વડોદરા", "વલસાડ");
			while($row = mysqli_fetch_array($res))
			{
				$tr .= '<tr id="'.$row['ID'].'">
							<td>'.$count.'</td>
							<td><input type="text" name="village-name" class="form-control" value="'.$row["Village_Name"].'"/></td>
							<td>';
								$tr .= '<select name="district" class="districts">';
								$district_name = $row['District_Name'];
								foreach($districts as $district)
								{
									$selected = ($district == $district_name)?' selected':'';
									$tr .= '<option value="'.$district.'" '.$selected.'>'.$district.'</option>';
								}
								$tr .= '</select>
							</td>';
							$tr .= '<td class = "taluka-list"></td>';
							$tr .= '<td><button class="btn btn-success edit" id="'.$row['ID'].'">Update</button></td>
					  </tr>';
				$count++;

				//$sum += (int)$row['Amount'];
			}
			echo $tr;
		?>
	</tbody>
</table>