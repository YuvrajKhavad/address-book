<?php
	session_start();
	include('../include/db.php');
	if(! (isset($_SESSION['UID']))){
		header("Location:../");
	}
	$row = mysqli_fetch_array(mysqli_query($con, "SELECT count(*) FROM persons"));
	$personsCount = $row[0];
?>
<html>

<head>
	<title>Home - Marriage Shaguna Records</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="title text-center">Marriage Shaguna Records</h1>
				<div class="card">
					<ul class="nav nav-tabs" role="tablist" id = "tab-action">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
						<li role="presentation"><a href="#view" aria-controls="view" role="tab" data-toggle="tab">View</a></li>
						<li role="presentation"><a href="#add" aria-controls="add" role="tab" data-toggle="tab">Add</a></li>
						<li role="presentation"><a href="#villages" aria-controls="villages" role="tab" data-toggle="tab">Villages</a> </li>
						<li role="presentation"><a href="logout/" aria-controls="logout">Logout</a></li>
					</ul>
					<div class="tab-content">
						<!-- Home -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="container">
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-5">
										<h4 class="font">Welcome to your Marriage Shaguna Records,
											<?php echo $_SESSION['First_Name'].' '.$_SESSION['Last_Name']; ?>!</h4>
										<table class="table borderless">
											<tr>
												<td>Name</td>
												<td>:</td>
												<td><?php echo $_SESSION['First_Name'].' '.$_SESSION['Last_Name']; ?>
												</td>
											</tr>
											<tr>
												<td>Username</td>
												<td>:</td>
												<td><?php echo $_SESSION['Username']; ?></td>
											</tr>
											<tr>
												<td>Last Login</td>
												<td>:</td>
												<td><?php echo $_SESSION['Last_Login']; ?></td>
											</tr>
											<tr>
												<td>Persons in Marriage Shaguna Records</td>
												<td>:</td>
												<td id = "total-entry"><?php echo $personsCount; ?></td>
											</tr>
										</table>
									</div>
									<div class="col-sm-2"></div>

								</div>
							</div>
						</div>

						<!-- View -->
						<div role="tabpanel" class="tab-pane" id="view">
							<?php include('tab_contents/view.php'); ?>
						</div>

						<!-- Add -->
						<div role="tabpanel" class="tab-pane" id="add">
							<?php include('tab_contents/add.php'); ?>
						</div>

						<!-- View -->
						<div role="tabpanel" class="tab-pane" id="villages">
							<?php include('tab_contents/villages.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<!--script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script-->
	<script>
		var amount = $("#amount");
		var fn = $("#fn");
		var ln = $("#ln");
		var surname = $("#surname");
		var village_name = $("#village-name");
		var search_by_village = $("#search-village-name");
		var search_by_amout = $("#search-by-amout");
		var search_by_name = $("#search-by-name");

		$(document).ready(function () {
			//alert(village_name);
			//reset btn
			$('.btn-danger').click(function () {
				$('#res').text('');
				$('#updateRes').text('');
			});

			//Add Information
			$('#addPersonForm').submit(function () {
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/add/',
					type: 'POST',
					data: formData,
					async: true,
					success: function (data) {
						$('#res').html(data);
					},
					cache: false,
					contentType: false,
					processData: false
				});
				$(this)[0].reset();
				return false;
			});
			//update

			//get previous data
			$('#pemail').change(function () {
				var pemail = $(this).val();
				if (pemail != 0) {
					var dataString = 'email=' + pemail;
					$.ajax({
						url: 'tasks/update/fetch.php',
						type: 'POST',
						dataType: 'json',
						data: dataString,
						async: false,
						success: function (data) {
							var name = data[1].split(' ');
							var mobile = data[2];
							var permanant = data[4];
							var temporary = data[5];
							$('#updatefn').val(name[0]);
							$('#updateln').val(name[1]);
							$('#updatemobile').val(mobile);
							$('#updatepermanant').val(permanant);
							$('#updatetemporary').val(temporary);
						},
					});
				}
				return false;
			});

			//update the data
			$('#updatePersonForm').submit(function () {
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/update/',
					type: 'POST',
					data: formData,
					async: true,
					success: function (data) {
						$('#updateRes').html(data);
					},
					cache: false,
					contentType: false,
					processData: false
				});
				$(this)[0].reset();
				return false;
			});

			//delete a person
			$(document).on("click", ".delete", function(){
				var id = event.target.id;
				if ($.isNumeric(id)) {
					if (confirm("Are sure to delete this person?")) {
						$.ajax({
							url: 'tasks/delete/',
							type: 'POST',
							data: 'id=' +	 id,
							async: false,
							success: function (data) {
								var objID = '#' + id;
								$('#deleteRes').html(data);
								$(objID).hide(500);
								setTimeout(function () {
									$('#deleteRes').text('');
								}, 2000);
							},
						});
					}
				}
				return false;
			});

			//update a person 
			$(document).on("click",'.edit',function(){
				var id = event.target.id;
				$("#"+id+" .person").css("display","none");
				$("#"+id+" input").css("display","block");
				$(this).attr("Class","btn btn-primary update").html("Update");
			});

			$(document).on("click",".update",function(){
				var id = event.target.id;
				var amount = $("#"+id+" input[name='amount']").val();
				var firstname = $("#"+id+" input[name='fn']").val();
				var Lastname = $("#"+id+" input[name='ln']").val();
				var surname = $("#"+id+" input[name='surname']").val();
				var villagename = $("#"+id+" input[name='village-name']").val();
				var villageid = $("#"+id+" input[name='village-name-id']").val();
				 $.ajax({
				 	url: 'tasks/update/',
				 	type: 'POST',
				 	data: {	
						id:id,
						amount:amount,
						firstname:firstname,
						Lastname:Lastname,
						surname:surname,
						villagename:villagename,
						villageid:villageid
					 },
				 	// async: true,
				 	success: function (data) {
						$("#"+id+" .person").css("display","block");
						$("#"+id+" input").css("display","none");
						$("#"+id+" label[id='amount']").html(amount);
				 		$("#"+id+" label[id='fn']").html(firstname);
						$("#"+id+" label[id='ln']").html(Lastname);
						$("#"+id+" label[id='surname']").html(surname);
						$("#"+id+" label[id='village-name']").html(villagename);
						$(".update[id="+id+"]").attr("Class","btn btn-success edit").html("Edit");
				 	},
				 	// cache: false,
				 	// contentType: false,
				 	// processData: false
				 });
			});

			$(document).on("click",".update-village",function()
			{
				var id = event.target.id;
				var error = false;
				var village_name = $("#village-"+id+" input[name='edit-village-name']").val();
				var village_district = $("#village-"+id+" .districts").find(":selected").val();
				var village_taluka = $("#village-"+id+" .talukas").find(":selected").val();
				if(village_name == "")
				{
					error = true;
				}

				if(village_district == "")
				{
					error = true;
				}

				if(village_taluka == "")
				{
					error = true;
				}

				if(error == true)
				{
					alert("Please add and select all filed");
					return false;
				}
				else
				{
					$.ajax({
						url: 'tasks/edit-village/',
						type: 'POST',
						data:
						{
							id : id,
							village : village_name,
							district : village_district,
							taluka : village_taluka
						},
						success: function (data)
						{
							//alert(data);
							$("#village-message").html(data);
						},
					});
				}
			});

			$(document).on('keyup','#village-person-name',function( e ) {
				$("#village-id").val("");
				var person_id = $(this).attr("data-id");
				//alert(person_id);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), search_by_village, 'village-person-name-'+person_id, 'Village_Name');
				}
			});

			// Edit Time Search first name
			$(document).on('keyup','#person-fn',function( e ) {
				var person_fn = $(this).attr("data-id");
				//alert(person_fn);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), fn, person_fn, 'First_Name');
				}
			});

			// Edit Time Search last name
			$(document).on('keyup','#person-ln',function( e ) {
				var person_ln = $(this).attr("data-id");
				//alert(person_ln);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), ln, person_ln, 'Last_Name');
				}
			});

			// Edit Time Search surname name
			$(document).on('keyup','#person-surname',function( e ) {
				var person_surname = $(this).attr("data-id");
				//alert(person_surname);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), surname, person_surname, 'Surname');
				}
			});

			// Add Time Search village name
			$(document).on('keyup','#village-name',function( e ) {
				$("#village-id").val("");
				var village_name = $(this).val();
				//alert(village_name);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), search_by_village, village_name, 'Village_Name');
				}
			});

			// Add Time Search Surname
			$(document).on('keyup','#surname',function( e ) {
				$("#surname").val("");
				var addsurname = $(this).val();
				//alert(addsurname);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), surname, addsurname, 'Surname');
				}
			});
			// Add Time Search first name
			$(document).on('keyup','#fn',function( e ) {
				$("#fn").val("");
				var addfn = $(this).val();
				//alert(addln);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), fn, addfn, 'First_Name');
				}
			});
			// Add Time Search last name
			$(document).on('keyup','#ln',function( e ) {
				$("#ln").val("");
				var addln = $(this).val();
				//alert(addln);
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), ln, addln, 'Last_Name');
				}
			});

			// Search amout
			amount.keyup(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), amount, 'amount', 'Amount');
				}
			});

			// Search first name
			fn.keyup(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), fn, 'fn', 'First_Name');
				}
			});
			fn.focus(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), fn, 'fn', 'First_Name');
				}
			});

			// Search last name
			ln.keyup(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), ln, 'ln', 'Last_Name');
				}
			});
			ln.focus(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), ln, 'ln', 'Last_Name');
				}
			});

			// Search Surname name
			surname.keyup(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), surname, 'surname', 'Surname');
				}
			});
			surname.focus(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), surname, 'surname', 'Surname');
				}
			});

			// Search Village_Name name
			village_name.keyup(function () {
				$("#village-id").val("");
				if($(this).val() != ""){
					search_ajax_call($(this).val(), village_name, 'village-name', 'Village_Name');
				}
			});
			village_name.focus(function () {
				$("#village-id").val("");
				if($(this).val() != ""){
					search_ajax_call($(this).val(), village_name, 'village-name', 'Village_Name');
				}
			});

			village_name.on('input',function() {
				$("#village-id").val("");
				if($(this).val() != ""){
					search_ajax_call($(this).val(), village_name, 'village-name', 'Village_Name');
				}
			});

			// Seach by Village name
			$(document).on('keyup','#search-village-name',function( e ) {
				$("#village-id").val("");
				//alert("fgfg");
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), search_by_village, 'search-village-name', 'Village_Name');
				}
			});

			// Seach by Village amount
			$(document).on('keyup','#search-by-amout',function( e ) {
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), search_by_amout, 'search-by-amout', 'Amount');
				}
			});

			// Seach by Village name
			$(document).on('keyup','#search-by-name',function( e ) {
				if($(this).val() != "")
				{
					search_ajax_call($(this).val(), search_by_name, 'search-by-name', 'full');
				}
			});

			function search_ajax_call(keyword, object, id, column_name) {
				//alert(object); 
				//alert(column_name);
				//alert(id);
				sid = $("#" + id + "-suggesstion-box");
				//vid = $("#village-person-name-suggesstion-box");
				vid = $("#village-name-suggesstion-box");
				fnid = $("#fn-suggesstion-box");
				lnid = $("#ln-suggesstion-box");
				surid = $("#surname-suggesstion-box");
				editfnid = $("#fn-" + id + "-suggesstion-box");
				editlnid = $("#ln-" + id + "-suggesstion-box");
				editsurid = $("#surname-" + id + "-suggesstion-box");
				//alert(editsurid);
				$.ajax({
					type: "POST",
					url: "tasks/search/",
					data: 'keyword=' + keyword + '&column=' + column_name + '&id=' + id,
					beforeSend: function () {
						object.css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
					success: function (data) {
						//alert(data);
						if(column_name == 'First_Name') {
							fnid.show(); fnid.html(data);
							editfnid.show(); editfnid.html(data);
						} else if(column_name == 'Last_Name') {
							lnid.show(); lnid.html(data);
							editlnid.show(); editlnid.html(data);
						} else if(column_name == 'Surname') {
							surid.show(); surid.html(data);
							editsurid.show(); editsurid.html(data);
						} else if(column_name == 'Village_Name') {
							vid.show();	vid.html(data);
							sid.show();	sid.html(data);
							//vpid.show(); vpid.html(data);
						} else {
							sid.show();	sid.html(data);
						}
						//vid.show();	vid.html(data);
						//fnid.show(); fnid.html(data);
						//lnid.show(); lnid.html(data);
						//surid.show(); surid.html(data);
						object.css("background", "#FFF");
					}
				});
			}

			$(document).on("submit", "#SearchForm", function (e) {
				e.preventDefault();
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/search/search.php',
					type: 'POST',
					data: formData,
					async: true,
					success: function (data) {
						$('#table-boday').html(data);
						//alert(data);
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});

			$(document).on("submit", "#SearchFormVillage", function (e) {
				e.preventDefault();
				var formData = new FormData($(this)[0]);
				$.ajax({
					url: 'tasks/search/search-taluka.php',
					type: 'POST',
					data: formData,
					async: true,
					success: function (data) {
						$('#table-boday-village').html(data);
						
					},
					cache: false,
					contentType: false,
					processData: false
				});
			});

			$( "#target" ).keyup(function() {
				alert( "Handler for .keyup() called." );
			});

			// select event on select box
			$(document).on("change", ".districts", function (e) {
			//$('.districts').change(function() {
				var obj = $(this);
				var district = $(this).val();
				$.ajax({
					url: 'tasks/search/taluka.php',
					type: 'POST',
					data: 'district=' + district + '&type=no-search',
					success: function (data) {
						$(obj).parent().next('td').html(data);
					},
				});
			});

			// select event on select box
			$(document).on("change", ".search-districts", function (e) {
			//$('.search-districts').change(function() {
				var district = $(this).val();
				$.ajax({
					url: 'tasks/search/taluka.php',
					type: 'POST',
					data: 'district=' + district + '&type=search',
					success: function (data) {
						$(".search-talukas-list").html(data);
					},
				});
			});

		});

		function selectResult(val, id, f_id) {
			//alert(val);
			//alert(id);
			//alert(f_id);
			$("#" + id).val(val);
			$("#" + id + "-suggesstion-box").hide();
			$("#village-name-suggesstion-box").hide();
			//$("#fn-suggesstion-box").hide();
			//$("#ln-suggesstion-box").hide();
			//$("#surname-suggesstion-box").hide();
			if(id == "village-name")
			{
				//alert(f_id);
				$("#village-id").val(f_id);
			}
			else
			{
				//alert(val);
				$("#" + id).val(f_id);
				$("#village-person-name[data-person="+id+"]").val(val);

				$("#village-id").val(f_id);
				//$("#village-name[data-vlgname='vlgname']").attr('value',val);
				$(".addvlgname").val(val);

				//$(".addfirstname").val(val);
				//$(".addlastname").val(val);
				//$(".addsurname").val(val);
			}

			if(id == "search-village-name")
			{
				//alert(f_id);
				$("#search-village-id").val(f_id);
			}
		}
		function selectResultFirst_Name(val, id, f_id) {
			//$("#" + id).val(val);
			$("#fn-suggesstion-box").hide();
			$("#fn-"+ id +"-suggesstion-box").hide();
			$("#" + id).val(f_id);
			$(".addfirstname").val(val);
			$(".editfirstname").val(val);
		}
		function selectResultLast_Name(val, id, f_id) {
			//$("#" + id).val(val);
			$("#ln-suggesstion-box").hide();
			$("#ln-"+ id +"-suggesstion-box").hide();
			$("#" + id).val(f_id);
			$(".addlastname").val(val);
			$(".editlastname").val(val);
		}
		function selectResultSurname(val, id, f_id) {
			//$("#" + id).val(val);
			//alert(id);
			$("#surname-suggesstion-box").hide();
			$("#surname-"+ id +"-suggesstion-box").hide();
			$("#" + id).val(f_id);
			$(".addsurname").val(val);
			$(".editsurname").val(val);
		}

		$('#tab-action a').click(function (link) {
			// Update title based on tab
			$(document).prop('title','' + link.currentTarget.innerText + ' - Marriage Shaguna Records');

			// call ajax to list all record
			if(link.currentTarget.innerText == "View")
			{
				$.ajax({
					url: 'tab_contents/view.php',
					async: true,
					success: function (data) {
						$('#view').html(data);
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}

			// update count at home tab
			if(link.currentTarget.innerText == "Home")
			{
				$.ajax({
					url: 'tasks/fetch.php',
					async: true,
					success: function (data) {
						$('#total-entry').html(data);
					},
					cache: false,
					contentType: false,
					processData: false
				});
			}
		})
	</script>
</body>

</html>