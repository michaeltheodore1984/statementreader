<?php 

    $document_names = array("ACME Invoice", "Statement of Account", "Monthly Credit Card Statement", "Accounts Payable", "Statement of Cash Flow");
    
?>
<html>
	<head>
	<!-- Less -->
	<link rel="stylesheet/less" type="text/css" href="styles.less" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	
	<!-- JQuery for special effects -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script src="https://unpkg.com/react@16/umd/react.production.min.js" crossorigin></script>
	<script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js" crossorigin></script>
		
		<script> 
		// Animate the search box when clicking on it
        $(document).ready(function(){
          $(".search_box").click(function(){
              // Bring the search box and associated input
              // to a larger width so that we can enter
              // document information
              $("#search_input").animate({
					width:'317px'
                  });
            $(".search_box").animate({
              width: '388px'
            },{complete:  function() { $("#search_button").fadeIn(); }})
          });
        });

       
        </script> 
        <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
	</head>
	<body>
	

	<!-- Header -->
	<div class="header">
		<div style="display: table">
			<img src="img/logo.png" style="display:table-cell;margin-right:15px;"/>	
			<span style="display: table-cell; vertical-align:middle;">StatementReader</span>
		</div>
	</div>
    
    <!-- Main container which is actually a table made of two major columns. 
         The first column holds information for the currently logged in user.
         The second column contains the list of documents along with a way to
         add and search for a document -->
    <div class="main">
    
    	<!-- The first column contains a user picture along with their name and a log out button -->
    	<div class="col content-col-1">	  
        		<img src="avatar.png" id="avatar"/>
        			
    			<span id="username">Mark L.</span>
    			<span class="logout">Log out</span>
    		
		</div>
		<!-- End of the first column -->
    	 
    	  <!--  Beginning of second column -->
    	  <div class="col content-col-2">
    	  
    	  <!-- Use the toolbar to add a document or search for one -->
    	  	<div class="toolbar">
    	  		<div class="col">
    	  			<i class="far fa-plus-square fa-2x"></i>
    	  		</div>
    	  		<div class="col" style="vertical-align:middle;padding:0px 10px 0px 10px">
    	  			ADD A DOCUMENT
    	  		</div>
    	  		<!-- The search box expands with an animation to the right
    	  		     and the search button to be clicked appears afterwards. -->
    	  		<div class="col">
    	  			<div style="width:388px;height:40px; ">
        				<div class="search_box">
        					<input id="search_input" placeholder="Find a Document"/>
        				</div>
        				<div id="search_button">
        					<i style="color:#FFFFFF; margin-top:10px;" class="fas fa-search"></i>
        				</div>
    			</div>
    	  	</div>
    	  </div>
    	  <!-- End of toolbar -->
    	  
    	  <!-- Separator for a clean look -->
    	   <div style="height:1px; background-color:#DDDDDD; margin-top:5px;"></div>
    	   
    	   <!-- Set the table headings -->
    	    
        	    <div class="data-table">
					<div style="display:table-row;">
    					<div class="col-heading">
        	    			<i class="fas fa-file-upload fa-2x"></i>	
        	    		</div>
        	    		<div class="col-heading">
        	    			DATE ADDED
        	    		</div>
        	    		<div class="col-heading">
        	    			TIME
        	    		</div>
        	    		<div class="col-heading">
        	    			DELETE
        	    		</div>
        	    		<div class="col-heading">
        	    			TYPE
        	    		</div>
        	    		<div class="col-heading">
        	    			GET PARSED
        	    		</div>
        	    		<div class="col-heading-end">
        	    			DOCUMENT NAME
        	    		</div>
					</div>
					
					
    	  <?php
    	
            	foreach($document_names as $item)
            	{
    	    ?>
    	    <div style="display: table-row">
    	    	<div class="col-data-start">
    	    		1d
    	    	</div>
    	    	<div class="col-data">
    	    	
    	    			<span style="display:block;font-size: 12px">JAN</span> 30
    	    		
    	    	</div>
    	    	<div class="col-data">
    	    		<span style="display:block;font-size: 15px">4:20</span> PM
    	    	</div>
    	    	<div class="col-data">
    	    		<i class="far fa-trash-alt" style="color:#C60000"></i>
    	    	</div>
    	    	<div class="col-data">
    	    			<i class="far fa-file-alt"></i>
    	    			<span style="font-size: 14px">PDF</span>
    	    		
    	    	</div>
    	    	<div class="col-data">
    	    		<i class="fas fa-download"></i>
    	    	</div>
    	    	<div class="col-data-end">
    	    		<?php echo $item;?>
    	    	</div>
    	    </div>
    	<?php }?>
    	</div>
    	<!-- End of the second column -->
    </div>
    	  
   </div>
  </div>
 </div>
   
   	</body>
</html>