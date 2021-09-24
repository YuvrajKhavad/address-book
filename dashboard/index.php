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
	<title>Home - Address Book</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<link href="https://fonts.googleapis.com/css?family=Baloo+Bhaina" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-1">
			</div>
			<div class="col-sm-10">
				<h1 class="title text-center">Address Book</h1>
				<div class="card">
					<ul class="nav nav-tabs" role="tablist" id = "tab-action">
						<li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
						<li role="presentation"><a href="#add" aria-controls="add" role="tab" data-toggle="tab">Add</a> </li>
						<li role="presentation"><a href="#view" aria-controls="view" role="tab" data-toggle="tab">View All</a></li>
						<!--li role="presentation"><a href="#update" aria-controls="update" role="tab" data-toggle="tab">Update</a></li-->
						<li role="presentation"><a href="logout/" aria-controls="logout">Logout</a></li>
					</ul>
					<div class="tab-content">
						<!-- Home -->
						<div role="tabpanel" class="tab-pane active" id="home">
							<div class="container">
								<div class="row">
									<div class="col-sm-2"></div>
									<div class="col-sm-5">
										<h4 class="font">Welcome to your address book,
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
												<td>Persons in Address Book</td>
												<td>:</td>
												<td id = "total-entry"><?php echo $personsCount; ?></td>
											</tr>
										</table>
									</div>
									<div class="col-sm-2"></div>

								</div>
							</div>
						</div>
						<!-- Add -->
						<div role="tabpanel" class="tab-pane" id="add">
							<?php include('tab_contents/add.php'); ?>
						</div>
						<!-- Update -->
						<div role="tabpanel" class="tab-pane" id="update">
							<?php include('tab_contents/update.php'); ?>
						</div>
						<!-- View -->
						<div role="tabpanel" class="tab-pane" id="view">
							<?php include('tab_contents/view.php'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="../js/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
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
			$(document).on("click", "button", function(){
				var id = event.target.id;
				if ($.isNumeric(id)) {
					if (confirm("Are sure to delete this person?")) {
						$.ajax({
							url: 'tasks/delete/',
							type: 'POST',
							data: 'id=' + id,
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

			// Search last name
			ln.keyup(function () {
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

			// Search Village_Name name
			village_name.keyup(function () {
				if($(this).val() != ""){
					search_ajax_call($(this).val(), village_name, 'village-name', 'Village_Name');
				}
			});

			// Seach by Village name
			$(document).on('keyup','#search-village-name',function( e ) {
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
				sid = $("#" + id + "-suggesstion-box");
				$.ajax({
					type: "POST",
					url: "tasks/search/",
					data: 'keyword=' + keyword + '&column=' + column_name + '&id=' + id,
					beforeSend: function () {
						object.css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
					},
					success: function (data) {
						//alert(data);
						sid.show();
						sid.html(data);
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

		});

		function selectResult(val, id) {
			$("#" + id).val(val);
			$("#" + id + "-suggesstion-box").hide();
		}

		$('#tab-action a').click(function (link) {
			// Update title based on tab
			$(document).prop('title','' + link.currentTarget.innerText + ' - Address Book');

			// call ajax to list all record
			if(link.currentTarget.innerText == "View All")
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