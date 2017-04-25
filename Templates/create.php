<!DOCTYPE html>
<html>
<head>
	<title>Create News</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

	<style type="text/css">
		#txtArea{
			resize: vertical;
			max-height: 180px;
		}
	</style>
</head>
<body>
	    <div class="wrapper">
        <div class="container">

            <div class="page-header text-center">
                <h1>Create News</h1>
            </div>

            <div class="row">
                
                <!-- Left side -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 

                </div> <!-- end left side -->

                <!-- Middle side -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                    <div class="text-left">

                        <form id="newsCreate" method="post" action="http://localhost/workspace/api/news">
				  			<div class="form-group">
						    	<label for="title">Title</label>
						    	<input type="text" class="form-control" name="newsTitle" id="title" placeholder="Title..." required>
					  		</div>

					  		<div class="form-group">
					    		<label for="date">Date</label>
						    	<input type="date" class="form-control" name="newsDate" id="date" required>
					  		</div>

					  		<div class="form-group">
					    		<label for="txtArea">Content</label>
					    		<textarea class="form-control" rows="4" name="newsText" id="txtArea" placeholder="Content here..." required></textarea>
					  		</div>
					  		
					  		<div class="text-right">
					  			<input type="submit" class="btn btn-success" value="Create"></input>
					  		</div>
						</form>

                    </div>

                </div> <!-- end middle side -->

                <!-- Right side -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                    
                </div> <!-- end right side -->

            </div> <!-- end row -->

        </div> <!-- end container -->

    </div><!-- end wrapper -->
    <!-- Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="js/handlebar-v4.0.5.js"></script>

	 <script>
	 	//  $("#newsCreate").submit(function(e){

		// 	var url = "http://localhost/workspace/api/news";
		// 	$.ajax({
		// 		type: "POST",
		// 		url: url,
		// 		data: $("#newsCreate").serialize(),
		// 		dataType: "json",
		// 		success: function(data)
		// 		{
		// 			alert(data);
		// 			console.log(data);
		// 			if (data.error === false) {
		// 				window.location.replace(data.redirectTo);
		// 			} else {
		// 				alert(data.message);
		// 			}
		// 		}
		// 	});
		// 	e.preventDefault();
		// });
	</script>
</body>
</html>