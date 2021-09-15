<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-6">
			<form class="form-vertical" role="form" id="addPersonForm">
				<p class="text-center" id="res"></p>
				<div class="row">
					<div class="col-sm-4">
						<label>Amount</label>
					</div>
					<div class="form-group col-sm-6">
			    		<input type="text" class="form-control" name="amount" id="amount" autocomplete="on" />
						<div id="amount-suggesstion-box"></div>
			    	</div>
			    	<div class="col-sm-3"></div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label>First Name</label>
					</div>
					<div class="form-group col-sm-6">
						<input type="text" class="form-control" name="fn" id="fn" autocomplete="on" />
						<div id="fn-suggesstion-box"></div>
			    	</div>
			    	<div class="col-sm-3"></div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label>Last Name</label>
					</div>
					<div class="form-group col-sm-6">
			    		<input type="text" class="form-control" name="ln" id="ln" autocomplete="off" />
						<div id="ln-suggesstion-box"></div>
			    	</div>
			    	<div class="col-sm-3"></div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label>Surname</label>
					</div>
					<div class="form-group col-sm-6">
			    		<input type="text" class="form-control" name="surname" id="surname" autocomplete="off" />
						<div id="surname-suggesstion-box"></div>
			    	</div>
			    	<div class="col-sm-3"></div>
				</div>

				<div class="row">
					<div class="col-sm-4">
						<label>Village Name</label>
					</div>
					<div class="form-group col-sm-6">
			    		<input type="text" class="form-control" name="village-name" id="village-name" autocomplete="off" />
						<div id="village-name-suggesstion-box"></div>
			    	</div>
			    	<div class="col-sm-3"></div>
				</div>

				<div class="row">
					<div class="col-sm-4">
					</div>
					<div class="col-sm-3">
						<input type="submit" class="btn btn-success" value="Add" id="addBtn" />
					</div>
					<div class="col-sm-3">
						<input type="reset" class="btn btn-danger" value="Reset" id="resetBtn" />
					</div>
				</div>

			</form>
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
