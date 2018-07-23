<?php
$allowed_hosts = array("134.117.95.25","134.117.99.45", "134.117.122.56", "134.117.99.7", "134.117.197.63", "134.117.117.30");

if (!in_array($_SERVER['REMOTE_ADDR'], $allowed_hosts)) {
    die("no access.");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Mini KMC</title>
    <link rel="icon" type="image/png" href="img/icon.png" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/select/1.2.0/css/select.bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="User Interface Ui Kit Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="js/move-top.js"></script>
        <script type="text/javascript" src="js/easing.js"></script>
            <script type="text/javascript">
                    $(document).ready(function($) {
                        $(".scroll").click(function(event){
                            event.preventDefault();
                            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                        });
                    });
            </script>
</head>
    <body>
		
    <?php //include "thumbnail_change.php" ?>
    <!--container-->
    <div class="container">
		  <div class="main-content">
              <!--top-header-->
				<div class="top-header">
				 <!--top-nav-->
					<div class="col-md-8 top-nav">
					  <span class="menu"> <img src="images/icon.png" alt=""></span>
						<ul class="res">
							<li><a href="index.php"><i class="glyphicon glyphicon-film"> </i> <span>CUOL</span> Mini KMC</a></li> <!--Home URL here-->
						</ul>
				   	</div>
				 	<div class="clearfix"> </div>
				<!--//top-nav-->
		 		</div>
			  <!--//top-header-->
              <br/>


              <!--search tool-->
              <form id="search" class="form-inline">
                  <div class="btn-group">
                      <input type="search" class="form-control" id="query" placeholder="Convocation*" autocomplete="off">
                      <span class="glyphicon glyphicon-search"></span>
                  </div>
                  <button type="submit" class="btn btn-default">Search!</button>
                  <div id="spinner" class="form-group invisible">
                      <img src="img/spinner-dark.svg">
                  </div>
              </form>
              <!-- //search tool -->
              <br />

              <!-- table -->
              <table id="entries" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                  <thead>
                  <tr>
                      <th>Entry ID</th>
                      <th>Thumbnail</th>
                      <th>Name</th>
                      <th>Date</th>
                      <th>Creator</th>
                      <th>Owner</th>
                      <th>Co-Editors</th>
                      <th>Co-Publishers</th>
                  </tr>
                  </thead>
              </table>
              <!-- //table -->



			  <!--inner-content-->
		        <div class="inner-content">
				    <!--/accordions-->
                    <div class="col-md-6 accordions">
                        <section class="ac-container">
                            <!--Modify User Permissions-->
                            <div>
                                <input id="ac-1" name="accordion-1" class="checkbox" style="display:none;" type="checkbox" />
                                <label for="ac-1">Modify User Permissions</label>
                                <article class="ac-small">
                                    <!-- Modify User Permission From -->
                                    <div class="panel-body">
                                    <form id="add_users" class="form-inline" onsubmit="updateConfirm()">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="users" placeholder="User(s)" autocomplete="off">
                                            <select id="roles" class="selectpicker" data-width="fit" multiple>
                                                <optgroup label="Role">
                                                    <option value="0">Owner</option>
                                                    <option value="1">Co-Editor</option>
                                                    <option value="2">Co-Publisher</option>
                                            </select>
                                            <button type="submit" class="btn btn-default">Update</button>
                                            <button id="resetUserSelection" type="button" class="btn btn-default">Clear</button>
                                            <div id="user_spinner" class="form-group invisible">
                                                <img src="img/spinner-dark.svg">
                                            </div>
                                        </div>
                                    </form>
                                        <div class="note">
                                            <br><span>Note: The update will overwrite any role that might already exist!</span>
                                        </div>
                                    </div>
                                    <!-- //Modify User Permission From -->
                                </article>
                            </div>
                            <!--Modify Thumbnail-->
                            <div>
                                <input id="ac-2" name="accordion-1" style="display:none;" type="checkbox" />
                                <label for="ac-2">Modify Thumbnail</label>
                                <article class="ac-medium">
                                    <!-- Modify Thumbnail From -->
                                    <div class="panel-body">

                                        <form id="uploadimage" action="" method="post" enctype="multipart/form-data" class="form-inline" onsubmit="setTimeout(function(){window.location.reload(true);},3000) & thumbnailConfirm()" >
                                            <div class="form-group">
                                            <div id="selectImage">
                                                <input type="file" class="form-control" name="imageToUpload" id="imageToUpload" required />
                                                <button type="submit" class="btn btn-default">Make changes</button>
                                            </div>
                                            </div>
                                        </form>

                                        <div class="note">
                                            <br><span>Note: Thumbnail for all Selected entries would be modified!</span>
                                        </div>
                                    </div>
                                    <!-- //Modify Thumbnail From -->
                                </article>
                            </div>
                            <!--Delete Entries-->
                            <div>
                                <input id="ac-3" name="accordion-1" type="checkbox" style="display:none;" />
                                <label for="ac-3">Delete Entries</label>
                                <article class="ac-large">
                                    <!-- Delete Entries From -->
                                    <div class="panel-body">

                                        <form id="delete_entries" class="form-inline" onsubmit="return deleteConfirm() && delete_entries()">
                                            <div class="form-group">
                                                    <button type="submit" class="btn btn-default">Delete Entries</button>
                                            </div>
                                        </form>

                                        <div class="note">
                                            <br><span>Note: All selected entries will be deleted!</span>
                                        </div>
                                    </div>
                                    <!-- //Delete Entries form -->
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
              <div class="clearfix"> </div>
              <!--//accordions-->
          </div><!--//main-content-->
    </div>
    <!-- //Container-->
				<!--start-copyright-->
				<div class="copy-right">
						<p>Copyright &copy; 2016 CUOL. All rights  Reserved.
				</div>
	<!--//end-copyright-->

		</div>
	 <!--//container-->
	</body>

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script src="//cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/js/bootstrap-select.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
<script src="js/actions.js?v=2"></script>
<script src="js/thumbnail_action.js"></script>
<script src="js/confirmation.js"></script>
</html>


