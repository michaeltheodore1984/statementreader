<html2>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="lib/css/font-awesome.min.css"/>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="lib/js/angular.min.js"></script>
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
			
			#content_login
			{
				display:table-cell;
				width:400px;
				padding:10px;
				text-align:left;
				padding-left:50px;
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
			
			
			
		</style>
	</head>
	<body ng-app="statement_reader" ng-controller="statement_controller">
		<script>
			var app = angular.module('statement_reader', []);

			app.controller('statement_controller', function($scope, $http) 
			{
			
				$scope.password = function()
				{
					$http.post('helper/password.php', 
				    	{
				   		'full_name' : $scope.full_name,
				   		'company_name' : $scope.company_name,
				   		'email' : $scope.email,
				   		'password' : $scope.password
				   	}).then(function (response) 
				   	{
				   		$('#create_error').html(response.data);
				   		$('#create_error').show();
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
		        <a class="nav-link" href="newaccount/"><span class="btn btn-primary">Create My Account</span><span class="sr-only">(current)</span></a>
		      </li>
		     
		    </ul>
		  </div>
		</nav>
		
		
		<div id="outer_box">
			<div id="inner_box" align="center">
				
				<div id="content_login">
				
					Welcome! Set your password
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-circle-o" aria-hidden="true"></span></span>
					  <input ng-model="email" type="text" class="form-control" placeholder="Email address" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span style="padding:1px;" class="fa fa-key" aria-hidden="true"></span></span>
					  <input ng-model="password" type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<div id="login_error" style="display:none;margin-top:10px;" class="alert alert-warning" role="alert"></div>
					<button ng-click="password()" class="btn btn-primary" style="margin-top:10px;cursor:pointer;">Set password</button>
					
					
				</div>
					
				
			</div>
			
		</div>
		
		<div id="footer">&copy; StatementReader</div>
	</body>
</html>