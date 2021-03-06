<?php

	// account.php

	session_start();
	
	if(empty($_SESSION['user_email']))
		header("Location: ../../index.php");

?>
<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="../../lib/css/font-awesome.min.css"/>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
		<script src="../../lib/js/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
		<script src="../../lib/js/angular.min.js"></script>
		<style>
			body
			{
				background:#eee;
			}
			#outer_box
			{
				display:table;
				width:100%;
			}
			
			#add_statement_container
			{
				position:absolute;
				bottom:20px;
				right:10px;
				width:100%;
				height:150px;
				text-align:center
			}
			
			#add_statement_container #img_plus
			{
				width:100px;
				margin-top:10px;
				cursor:pointer;
			}
			
			#filename_container
			{
				
				display:none;
				background:#fff;
				border:1px solid #aaa;
				height:50px;
				margin-top:10px;
				margin-bottom:10px;
				padding:10px;
			}
			
			#upload_form_container
			{
				display:none;
			}
			
			#progress_bar 
			{
				width:0px;
				height:3px;
				position:relative;
				left:-10px;
				top:-10px;
				margin-right:-40px;
			    background: #42b3f4;
			    
			}
			
			#please_wait
			{
				display:none;
				margin:10px;
			}
			
			#footer
			{
				position:fixed;
				bottom:0px;
				padding:10px;
				font-size:12px;
				color:#fff;
				background:#555;
				width:100%;
			}
			
			#signout
			{
				cursor:pointer;
			}
			
			#signout:hover
			{
				color:#fff;
			}
			
			#item_container
			{
				background:#fff;
				padding:20px;
				margin-bottom:10px;
				font-family:Arial;
			}
			
			#label_parsing_progress
			{
				display:none;
			}
			
			.file_action
			{
				cursor:pointer;
				color:#555;
				
				margin-right:10px;
				font-family:Arial;
				font-size:12px;
			}
			
			iframe
			{
				height:500px;
				width:500px;
				position:absolute;
				right:0px;
			}
			
		</style>
	</head>
	<body ng-app="statement_reader" ng-controller="statement_controller">
	<div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Delete File</h5>
	        <button style="cursor: pointer" type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        You are deleting <span style="font-weight:bold" id="delete_file_name"></span>
	        <br/><br/>
	        Click "Confirm" to proceed or cancel to quit.
	        <br/>
	        This action cannot be undone.
	        <input type="hidden" ng-model="input_delete_file_name"/>
	        <input type="hidden" ng-model="input_delete_user_email"/>
	        
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" style="cursor: pointer" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-primary" style="cursor: pointer" ng-click="delete_confirm()">Confirm</button>
	      </div>
	    </div>
	  </div>
	</div>
		<script>
			var items = [];
			var app = angular.module('statement_reader', []);

			app.controller('statement_controller', function($scope, $http) 
			{

				$scope.get_user_files = function(user_email)
				{
					
					$http.post('../helper/get_all_files.php', 
					    	{
					   		'user_email':user_email
					   	}).then(function (response) 
					   	{
					   		var obj = response.data;
							
					   		for(i=0; i < obj.length ;i++)
								items.push(obj[i]['file_name']);
									
					   		$scope.all_files = response.data;
					   	});
				}
				
				$scope.logout = function()
				{
					
					$http.post('../helper/logout.php', 
				    {
				   
				  
				   	}).then(function (response) 
				   	{
				   		location = "../index.php";
				   	});
				}

				$scope.delete_file = function(user_email,file)
				{

					$('#delete_file_name').html(file);
					$scope.input_delete_file_name = file;
					$scope.input_delete_user_email = user_email;
					
					$('#delete_modal').modal();
					
				}

				$scope.delete_confirm = function()
				{
					
					$http.post('../helper/delete_file.php', 
					    	{
					   		'user_email' : $scope.input_delete_user_email,
					   		'file' : $scope.input_delete_file_name
					   	}).then(function (response) 
					   	{
					   		location.reload();
					   	});
				}

				$scope.cancel_upload = function()
				{
					location.reload();

				}

				$scope.find_file = function(user_email)
				{
					$http.post('../helper/find_file.php', 
					    	{
					   		'user_email' : user_email,
					   		'file_name' : $scope.file_to_search
					   		
					   	}).then(function (response) 
					   	{
						   	
						   	if(response.data == false)
						   	{
							   	
							 	$('#alert_error').html("No documents were found for your search.");
							 	$('#alert_error').show();
							 	
							}
						   	else
						   	{
						   		$('#alert_error').hide();
					   			$scope.all_files = response.data;
						   	}
						});
				}

				$scope.download_excel = function(form_id)
				{
					
					$(form_id).submit();
					
				}

				$scope.post_admin_description = function()
				{

					var content = "";
					content = $('#admin_description').val();
					content = content.replace(/(?:\r\n|\r|\n)/g, '<br />');
					
					$http.post('../helper/post_admin_description.php', 
					    	{
					   		'content' : content
					   		
					   	}).then(function (response) 
					   	{
							
						   	if(response.data == "")
							   	location.reload();
						   	else
						   	{
							   	$('#alert_admin_content').html(response.data);
						   		$('#alert_admin_content').show();
						   	}	
					   	});
				}

				$scope.get_admin_content = function()
				{

					
					$http.get('../helper/get_admin_content.php').then(function (response) 
					   	{
					   	
						   	$('#admin_content').html(response.data);
						   	
					   	});
				}
				
			});
		
			$(document).ready(function(){
				$('#img_plus').click(function(){
					$('#file').click();
				});
			});
			
				function file_operation(field)
		        {
		        
		        	var file_name = $(field).val();
		        	file_name=file_name.substring(file_name.lastIndexOf('\\') + 1); 
		        	
		        	var search = items.indexOf(file_name);
		        	var pdf = file_name.indexOf(".pdf");

		        	$('#filename').html(file_name);
		        	
		        	if(search != -1)
		        	{
		        		$('#alert_error').html("This file already exists.");
		 
		        		$('#select_bank').hide();
						$('#alert_error').show();
			        	return;
		        	}
		        	
		        	if(pdf == -1)
		        	{
		        		$('#alert_error').html("This doesn't seem to be a PDF file.");
		        		
		        		$('#select_bank').hide();
						$('#alert_error').show();
			        	return;
		        	}

		        	$('#alert_error').hide();
		         	$('#filename_container').show();
		         	$('#select_bank').show();
							         	

		        }
		        
		        function timer(interval)
		        {
			        $('#label_parsing_progress').html("Parsing in progress...");
		            var elem = document.getElementById("progress_bar");	 
				    var width = 0;
				    var id = setInterval(frame, interval);
				    function frame() {
				        if (width >= 100) {
				            clearInterval(id);
				            
				         	location.reload();
				            
				        } else {
				            width++; 
				            elem.style.width = width + '%'; 
				            //elem.innerHTML = width * 1 + '%';
				        }
				    }
		        }

		        function notifyParent(message)
		        {
			
		        	$('#alert_error').html(message);
		        	$('#alert_error').show();
		        	$('#label_parsing_progress').hide();
		        	$('#cancel_panel').show();
			    }

		        function notifyFileSize(file_size)
		        {
			        var interval = 900;
					var initial_megabyte = 1048576;
					
					for(i = initial_megabyte; i <= file_size; i += initial_megabyte)
					{
						interval += 30;
					}

					timer(interval);
			    }

		        function set_parser_id()
		        {
					var parser_id = $('#select_parser').val();

					if(parser_id == 0)
						return;

					$('#parser_id').val(parser_id);	

					$('#upload_form').submit();

					$('#select_bank').hide();
					$('#label_parsing_progress').show();
			    }

			   
		</script>
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="z-index:1">
		  <a class="navbar-brand" href="#">StatementReader</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		  </button>
		
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
		      <li class="nav-item">
		        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		      </li>
		      <li class="nav-item">
		        <a style="cursor:pointer;" class="nav-link" onclick="$('#how_to_use_app').show()">How to use the App</a>
		      </li>
		     
		    </ul>
		    
		      <input ng-model="file_to_search" style="margin-right:10px;width:400px" class="form-control" type="text" placeholder="Search for a Document..." aria-label="Search">
		      <button style="cursor:pointer;" ng-click="find_file('<?php echo $_SESSION['user_email']; ?>')" class="btn btn-success" type="submit"><span class="fa fa-search"></span></button>
		    
		  </div>
		</nav>
		
		
		<div id="outer_box">
			
				<div style="display:table-cell;padding-top:75px;color:#eee;position:fixed;top:0px;width:200px;height:100%;background:#27848e">
				
				<ul style="list-style:none;margin-left:-10px;">
					<li><span class="fa fa-user-circle"></span> <?php echo $_SESSION['user_name']; ?></li>
					<li style="background:#888;padding:10px;"><span class="fa fa-book"></span> ATB</li>
					<li><span class="fa fa-book"></span> BMO</li>
					<li><span class="fa fa-book"></span> CIBC</li>
					<li><span class="fa fa-book"></span> CWB</li>
					<li><span class="fa fa-book"></span> RBC</li>
					<li><span class="fa fa-book"></span> SCOTIABANK</li>
					<li><span class="fa fa-book"></span> TD</li>
					<li onclick="location='../'" style="cursor:pointer"><span class="fa fa-book"></span> My Account</li>
					<li><span id="signout" ng-click="logout()"><span class="fa fa-sign-out"></span> Sign out</span></li>
				</ul>
				
				
				 <div id="add_statement_container">
					<span>Add your PDF bank<br/> statement here</span>
					<br/>
					<img id="img_plus" src="../../lib/img/plus.png"/>
				 </div>
				</div>
				
				<div align="center" style="display:table-cell;text-align:left;height:100%;padding-left:210px;padding-bottom:50px;padding-right:10px;">
					
					<?php if($_SESSION['user_email'] == "admin@email.com")
							{
						?>
						<div style="margin-top:10px;" class="alert alert-warning">
						<div style="display:table-cell;width:425px;">
							<textarea id="admin_description" placeholder="Write here..." style="margin-top:10px;padding:10px;width:400px;height:150px;margin-bottom:10px;"></textarea>
						
						</div>
						<div style="display:table-cell;vertical-align:top;padding-top:10px;">
							Add a description for users<br/> including tips on how to use the App.
							<br/><br/>
							 All users will see this content.
							 <br/>
							 To see a preview, click "How to use the App" above.
							 <br/>
						</div>
						
							
							</div>
							<div>
							<div class="alert alert-warning" id="alert_admin_content" style="display: none;width:50%;"></div>	
							<button style="cursor:pointer;" ng-click="post_admin_description()" class="btn btn-success">Post Content</button>
						</div>
						<?php 
							}	
						?>
						<div id="how_to_use_app" style="display:none;">
							<div  class="alert alert-success" style="margin-top:10px;width:50%;">How to use the App<img src="../lib/img/delete.png" onclick="$('#how_to_use_app').hide()" class="pull-right" style="cursor:pointer;width:20px;"/></div>	
	
							<div  class="alert alert-warning" id="admin_content" ng-init="get_admin_content()" style="margin-top:10px;width:50%;"></div>	
						</div>
					<!-- <input ng-model="file_to_search" placeholder="Enter part or the full file name you need to find" type="text" style="width:50%;border:1px solid #aaa;margin-top:10px;padding:7px;">
					<button ng-click="find_file('<?php echo $_SESSION['user_email']; ?>')" class="btn btn-primary" style="cursor:pointer"><span class="fa fa-search"></span></button>
					 -->
					<!--  <div class="input-group">
				      <input ng-model="file_to_search" placeholder="Search for..." type="text" style="padding:6px;width:50%;border:1px solid #aaa">
					<span class="input-group-btn">
				        <button ng-click="find_file('<?php echo $_SESSION['user_email']; ?>')" class="btn btn-primary" style="padding:10px;cursor:pointer;outline:0" type="button"><span class="fa fa-search"></span></button>
				      </span>
				    </div>-->
					<div id="filename_container">
						  <div id="progress_bar"></div>
							
								<span id="filename"></span>
								<span id="label_parsing_progress" class="pull-right">Upload in progress...</span>
								<span ng-click="cancel_upload()" id="cancel_panel" class="pull-right" style="display:none;cursor:pointer;">
								<img style="margin-top:-3px;width:30px;" src="../lib/img/delete.png" />
								 Cancel
								</span>
							<div class="pull-right" id="select_bank">
								<select onchange="set_parser_id()" class="pull-right" id="select_parser">
								  <option value="0"></option>
								  <option value="yvpbqrvtldmz">ATB</option>	
								  
								  <option value="ydnwzkbhuqpi">BMO</option>	
								  <option value="lpfjoydbmecs">CIBC</option>	
								  <option value="zldwwgzobhbc">CWB</option>
								  
								  <option value="odczvbkjpqpg">RBC</option>
								  <option value="eanixoelurgc">Scotiabank</option>
								  <option value="debdutjsovry">TD</option>
								  
								</select>	
								<span class="pull-right" style="margin-right: 10px;">
									Select your bank for parsing
								</span>
							</div>	
										
					</div>
					
					<div class="alert alert-warning" id="alert_error" style="display: none;margin-top:10px;"></div>	
					
					
					<div style="margin-top:10px;background:#27848e;border:none;color:#eee;" class="alert alert-primary">My Documents<span class="pull-right" style="cursor: pointer" onclick="location.reload()">See all my Documents</span></div>
					<div ng-init="get_user_files('<?php echo $_SESSION['user_email']; ?>')">
						<div ng-repeat="d in all_files">
							<div id='item_container'><span ng-bind="d.file_name"></span>
							<hr/>
							<span style='color:#555' class='fa fa-download'></span>
							
							
							<form id={{d.id}} style='display:none;' method='get' action='{{d.form_action}}'></form>
							<span ng-click='download_excel("#"+d.id)' class='file_action'>Download Excel File</span>
							<span style='color:#555' class='fa fa-trash-o'></span>
							<span ng-click='delete_file(d.user_email,d.file_name)' class='file_action'>Delete <span ng-model="delete_file_name" ng-bind="d.file_name"></span></span>
		
							</div>
						</div>
					</div>
					
					
					<div id="upload_form_container">
							<form id="upload_form" action="../helper/upload_helper.php" method="post" enctype="multipart/form-data" target="target_iframe">
								<input type="file" name="file" id="file" onchange="file_operation('#file')"/>
								<input type="hidden" name="user_email" value="<?php echo $_SESSION['user_email']; ?>"/>
								<input type="hidden" name="parser_id" id="parser_id"/>
							</form>
							
							<iframe name="target_iframe"></iframe>
						
					</div>
				
			</div>
			
		</div>
		
		<div id="footer">&copy; StatementReader | Terms | Privacy</div>
	</body>
</html>