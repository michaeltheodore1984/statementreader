<html>
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
			
				
				
				$scope.login = function()
				{
		
					$http.post('helper/login.php', 
				    	{
				   		'login_email' : $scope.login_email,
				   		'login_password' : $scope.login_password
				  
				   	}).then(function (response) 
				   	{
				   		if(response.data == false)
				   		{
				   			$('#login_error').html("Unable to login. <br/>Please check your email and password");
				   			$('#login_error').show();
				   		}
				   		else if (response.data == true)
				   			location = "myaccount/";
				   		else
				   		{
				   			$('#login_error').html(response.data);
				   			$('#login_error').show();
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
		        <a class="nav-link" style="cursor: pointer;" href="newaccount/"><span class="btn btn-primary">Create My Account</span><span class="sr-only">(current)</span></a>
		      </li>
		     
		    </ul>
		  </div>
		</nav>
		
		
		<div id="outer_box">
			<div id="inner_box" align="center">
				
				<div id="content_login">
					
					
					<h4>Welcome!</h4> <span style="color:#888">Enter my Account</span>
					<hr/>	
					
					
					
					<!-- login email -->
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span class="fa fa-user-circle-o" aria-hidden="true"></span></span>
					  <input ng-model="login_email" type="text" class="form-control" placeholder="Login email address" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					
					<!-- login password -->
					
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><span style="padding:1px;" class="fa fa-key" aria-hidden="true"></span></span>
					  <input ng-model="login_password" type="password" class="form-control" placeholder="Login password" aria-label="Username" aria-describedby="basic-addon1">
					</div>
					<div style="margin-top:10px;text-align:left">
					
						<a style="font-size:12px;cursor:pointer;" href="password/">Update my password</a>
					
					</div>
					<div id="login_error" style="display:none;margin-top:10px;" class="alert alert-warning" role="alert"></div>
					
					<button ng-click="login()" class="btn btn-primary" style="margin-top:10px;cursor:pointer;">Enter Account</button>
					
					
				</div> 
					
				
			</div>
			
		</div>
		
		<div id="footer">&copy; StatementReader</div>
	</body>
</html>