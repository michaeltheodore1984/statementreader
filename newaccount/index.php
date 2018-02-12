<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../lib/css/font-awesome.min.css"/>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="../lib/js/angular.min.js"></script>
		<style>
			body
			{
				background:#eee;
			}
			#outer_box
			{
				display:table;
				height:80%;
				width:100%;
			}
			#inner_box
			{
				display:table-cell;
				vertical-align:middle;
				width:100%;
				
			}
			#content_signup
			{
				
				display:table-cell;
				width:400px;
				padding:30px;
				border:1px solid #ccc;
				background:#fff;
			}
			
			#footer
			{
				position:fixed;
				bottom:0px;
				padding:10px;
				font-size:12px;
			}
			
			.input-group
			{
				margin-top:10px;
			}
			
			.form-control
			{
				background:#f7f7f7;
			}
			
		</style>
	</head>
	<body ng-app="statement_reader" ng-controller="statement_controller">
		<script>
			var app = angular.module('statement_reader', []);

			app.controller('statement_controller', function($scope, $http) 
			{
			
				$scope.create_account = function()
				{
					$http.post('../helper/create_account.php', 
				    	{
				   		'full_name' : $scope.full_name,
				   		'company_name' : $scope.company_name,
				   		'email' : $scope.email,
				   		'password' : $scope.password
				   	}).then(function (response) 
				   	{
					  	if(response.data == true)
						  	location = "../myaccount/";
					  	else
					  	{
				   			$('#create_error').html("This account seems to already exist. Try <a href='../index.php'>signing in</a> with your email");
				   			$('#create_error').show();
					  	}
				   	});
				}
				
				
				});
		</script>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="#">StatementReader</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarNav">
		    <ul class="navbar-nav">
		      <li class="nav-item active">
		        <a style="cursor:pointer;" class="nav-link" href="../"><span class="btn btn-primary">Enter Account</span> <span class="sr-only">(current)</span></a>
		      </li>
		     
		    </ul>
		  </div>
		</nav>
		
		
		<div id="outer_box">
			<div id="inner_box" align="center">
				
				
				
				<div id="content_signup">
				<h4>Welcome!</h4><span style="color:#888"> Are you new to the app? Sign up</span>
				<hr/>
					
					
					<!-- full name -->
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-circle-o" aria-hidden="true"></span></span>
					  <input ng-model="full_name" type="text" class="form-control" placeholder="Full name" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<!-- company -->
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span style="padding:1px;" class="fa fa-building-o" aria-hidden="true"></span></span>
					  <input ng-model="company_name" type="text" class="form-control" placeholder="Company name" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<!-- email -->
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-envelope-o" aria-hidden="true"></span></span>
					  <input ng-model="email" type="text" class="form-control" placeholder="Email address" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<!-- password -->
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-key" aria-hidden="true"></span></span>
					  <input ng-model="password" type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<div id="create_error" style="display:none;margin-top:10px;" class="alert alert-warning" role="alert"></div>
					<button ng-click="create_account()" class="btn btn-primary" style="cursor:pointer;margin-top:10px;">Create Account</button>
					
					
				</div> <!-- content_signup -->
				
			</div>
			
		</div>
		
		<div id="footer">&copy; StatementReader</div>
	</body>
</html>