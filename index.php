<!DOCTYPE html>
<html lang="en">
<head>
  <title>Client</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body onload="listAll()">

<div class="container">
	<div class="col-xs-12 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading text-center">
				USERS
				<button type="button" id="create" class="btn btn-default btn-sm pull-right">Create New user</button>
			</div>
			<div class="panel-body">
				<div class="col-xs-12">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>NAME</th>
								<th>VALUE</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
					
						 
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6" id="container_form" style="display:none;">
		<div class="panel panel-info">
			<div class="panel-heading">FORMULARIO</div>
			<div class="panel-body"">
				<form id="form_save">
					<div class="form-group">
						<label for="email">Name:</label>
						<input type="text" class="form-control" id="name">
					</div>
					<div class="form-group">
						<label for="userValue">Value:</label>
						<input type="text" class="form-control" id="value">
					</div>
					<button  id="save" class="btn btn-default">Inserir</button>
				</form>
			</div>
		</div>
	</div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/main.js"></script>

</html>