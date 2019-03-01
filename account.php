<?php 

    $document_names = array("Scotiabank Balance Sheet", "CIBC Statement of Account", "RBC Monthly Statement", "Accounts Payable", "Statement of Cash Flow");
    
?>
<html>
	<head>
	<!-- Less -->
	<link rel="stylesheet/less" type="text/css" href="styles.less" />
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.9.0/less.min.js" ></script>
	
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		
	</head>
	<body>
	
	<!-- Navigation Bar at the top -->
	<ul>
      <li style="width:200px"><a class="active" href="account.php">StatementReader</a></li>
<!--       <li><a href="#about">About</a></li> -->
    </ul>
    
    
    <div style="display:table;width:100%;height:100%;vertical-align:top">
    	<div style="display:table-cell;width:20px;">
    	    <div style="text-align:center;float:left;border-right:1px solid #DDDDDD;width:200px;padding-top:30px;height:100%; ">
		
    			<img src="avatar.png" style="border-radius:50%;width:70px;height:70px;"/>
    			
    			<span style="display:block;font-family:Helvetica, sans-serif;margin-top:15px;">Mark L.</span>
    			<span style="background-color:#4CAF50; display:block; width:60px;margin:30px 57px;border-radius:10px; padding:10px;color:#FFFFFF;font-family:Helvetica, sans-serif;">Log out</span>
			</div>
    	  </div>
    	  
    	  <div style="display:table-cell; text-align:left;vertical-align:top; padding:15px">
    	  
    		<div style="display:table;font-family:Helvetica,sans-serif;color:#888888">
    			<div style="display: table-cell;">
    				<span class="far fa-plus-square fa-2x"></span>
    			</div>
    			
    			<div style="display: table-cell; padding-left:10px;vertical-align:middle;font-size:14px">
    				ADD A DOCUMENT
    			</div>
    		</div>
    	    
        	    <div style="display:table;border-spacing:0 15px;text-align:left;width:100%;border-radius:10px;margin-bottom:10px;font-family:Helvetica,sans-serif;font-size:16px;color:#888888">
					<div style="display:table-row;">
    					<div style="display:table-cell;text-align:center;font-size:12px;width:100px;vertical-align:middle">
        	    			UPLOADED
        	    		</div>
        	    		<div style="display:table-cell;text-align:left;font-size:12px;vertical-align:middle">
        	    			DATE
        	    		</div>
        	    		<div style="display:table-cell;text-align:center;width:70px;font-size:12px;vertical-align:middle">
        	    			TIME
        	    		</div>
        	    		<div style="display:table-cell;text-align:center;width:10px;font-size:12px;vertical-align:middle">
        	    			DELETE
        	    		</div>
        	    		<div style="display:table-cell;text-align:center;width:100px;font-size:12px;vertical-align:middle">
        	    			TYPE
        	    		</div>
        	    		<div style="display:table-cell;text-align:center;width:50px;font-size:12px;vertical-align:middle">
        	    			GET EXCEL
        	    		</div>
        	    		<div style="display:table-cell;text-align:left;padding:10px;font-size:12px;vertical-align:middle">
        	    			DOCUMENT NAME
        	    		</div>
					</div>
    	  <?php
    	
            	foreach($document_names as $item)
            	{
    	    ?>
    	    <div style="display: table-row">
    	    	<div style="display:table-cell;text-align:center;vertical-align:middle;border: 1px dashed #CCCCCC;  border-right-style: none;padding:10px;border-radius:10px 0px 0px 10px">
    	    		1d
    	    	</div>
    	    	<div style="display:table-cell;vertical-align:middle;width:180px;border: 1px dashed #CCCCCC;border-right-style: none;border-left-style: none;">
    	    		January 30, 2019
    	    	</div>
    	    	<div style="display:table-cell;vertical-align:middle;text-align:center;border: 1px dashed #CCCCCC;border-right-style: none;border-left-style: none;">
    	    		6 PM
    	    	</div>
    	    	<div style="display:table-cell;text-align:center;vertical-align:middle;border: 1px dashed #CCCCCC;border-right-style: none;border-left-style: none;">
    	    		<span class="far fa-trash-alt" style="color:#C60000"></span>
    	    	</div>
    	    	<div style="display:table-cell;text-align:center;border: 1px dashed #CCCCCC;vertical-align:middle;border-right-style: none;border-left-style: none;">
    	    	
    	    			<span class="far fa-file-alt"></span>
    	    			<span style="font-size: 14px">PDF</span>
    	    		
    	    	</div>
    	    	<div style="display:table-cell;text-align:center;border: 1px dashed #CCCCCC;vertical-align:middle;border-right-style: none;border-left-style: none;">
    	    		<i class="fas fa-download"></i>
    	    	</div>
    	    	<div style="display:table-cell;padding-left:10px;vertical-align:middle;text-align:left;border: 1px dashed #CCCCCC;border-left-style: none;border-radius:0px 10px 10px 0px">
    	    		<?php echo $item;?>
    	    	</div>
    	    </div>
    	<?php }?>
   </div>
    	  </div>
    </div>
   
  
	</body>
</html>