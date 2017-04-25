<?php

try {
	if (isset($_GET["id"])) {
		$id = $_GET["id"];
		$response = json_decode(file_get_contents("http://localhost/workspace/api/news/".$id),true);

		if (isset($response["msg"])) {
			throw new Exception($response["msg"], 404);
		}
		$response = $response[0];
	} else {
		throw new Exception("This request require 'id' argument in URL", 400);
	}
} catch (Exception $e) {
	http_response_code($e->getCode());
	echo $e->getMessage();
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Update News</title>
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
                <h2>Update News</h2>
            </div>
            <div class="row">
                
                <!-- Left side -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4"> 

                </div> <!-- end left side -->

                <!-- Middle side -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">

                    <div class="text-left">

                        <form method="post" action="http://localhost/workspace/api/news/<?php echo $response["id"]; ?>" id="edit">
                        	<div class="form-group">
						    	<input type="hidden" class="form-control" name="newsId" id="id" value="<?php echo $response['id']; ?>">
					  		</div>

				  			<div class="form-group">
						    	<label for="title">Title</label>
						    	<input type="text" class="form-control" name="newsTitle" id="title" value="<?php echo $response['title']; ?>" required>
					  		</div>

					  		<div class="form-group">
					    		<label for="date">Date</label>
						    	<input type="date" class="form-control" name="newsDate" id="date"
						    	value="<?php echo $response['date']; ?>" required>
					  		</div>

					  		<div class="form-group">
					    		<label for="txtArea">Content</label>
					    		<textarea class="form-control" rows="4" name="newsText" id="txtArea" placeholder="Content here..." required ><?php echo $response['content'];?></textarea>
					  		</div>

					  		<div class="text-right">
					  			<input type="submit" class="btn btn-success" value="Update"></input>
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
</body>
</html>