<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Simple PHP MySQL OpenShiftv3 S2I Example">
    <meta name="author" content="Greg Hoelzer, Red Hat Middleware Solutions Architect">

    <title>OpenShift version 3</title>

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/custom.css" rel="stylesheet">
    <style>
      html, body {
          height: 100%;
          width: 100%;
        }
        .content {
          height: 100%;
        }
        .panel {
          height: 100%;
        }
        .panel-body {
          height: 100%;
          padding-bottom: 55px;
        }
        .mybox {
          background-color: black;
          height: 100%;
          width: 100%;
        }
        </style>

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Simple PHP3tier</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>


          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <div class="starter-template">
        <h1>OpenShift POD</h1>
      <?php
        $MachineName = $_ENV["HOSTNAME"];
        echo '<p class="lead">' . $MachineName . '</p>';
      ?>
</br>
<!-- row -->
<div class="row">
<div class="col-lg-4"><div class="panel panel-primary">  <div class="panel-heading">
    <h3 class="panel-title">Sample MySQL Details</h3>
  </div><div class="panel-body">
 <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                 <span class="glyphicon glyphicon-book"></span>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"><?php echo "$colnr" ?></p>
                    <p class="announcement-text">Connection Details</p>
                  </div>
                </div>
              </div>
                <?php
                  $mysql_user = $_ENV['MYSQL_USER'];
                  $mysql_password = $_ENV['MYSQL_PASSWORD'];
                  $my_database = $_ENV['MYSQL_DATABASE'];
                  $mysql_service_host = $_ENV['MYSQL_SERVICE_HOST'];
                  $mysql_service_port = $_ENV['MYSQL_SERVICE_PORT'];
                ?>
                <div class="panel-footer announcement-bottom">
                  <div class="row">
                    <div class="col-xs-7">
                      <?php
                        echo $mysql_user . '@' . $mysql_service_host . ':' . $mysql_service_port;
                      ?>
                    </div>
                    <div class="col-xs-7 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-7">
                      <?php
                        echo 'Database: ' . $my_database;
                        $mysql_host = $mysql_service_host . ":" . $mysql_service_port;
                        // Connecting, selecting database
                        $mysqli = new mysqli($mysql_service_host, $mysql_user, $mysql_password, $my_database, $mysql_service_port);
                        if ($mysqli->connect_errno) {
                           die('Failed to connect to MySQL: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
                        }
                        echo ' successfully connected';
                      ?>
                    </div>
                    <div class="col-xs-7 text-right">
                      <i class="fa fa-arrow-circle-right"></i>
                    </div>
                  </div>
                </div>
            </div>
<div class="panel panel-warning">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                 <span class="glyphicon glyphicon-eye-open"></span>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading"></p>
                    <p class="announcement-text">Sample Table Data</p>
                  </div>
                </div>
              </div>
              <div class="panel-footer announcement-bottom">
                  <?php
                    // Performing SQL query
                    $query = 'SELECT * FROM sample_table';
                    $result = $mysqli->query($query) or die('Query failed: ' . $mysqli->error);
                    $result->data_seek(0);
                    echo '<div class="row">';
                    echo '<div class="col-xs-6">';
                      echo "<table>\n";
                      while ($line = $result->fetch_assoc()) {
                        echo "\t<tr>\n";
                        foreach ($line as $col_value) {
                          echo "\t\t<td>$col_value</td>\n";
                        }
                        echo "\t</tr>\n";
                      }
                      echo "</table>\n";
                    echo '</div>';
                    echo '<div class="col-xs-6 text-right">';
                      echo '<i class="fa fa-arrow-circle-right"></i>';
                      echo '</div>';
                    echo '</div>';
                    // Free resultset
                    mysqli_free_result($result);
                    // Closing connection
                    mysqli_close($mysqli);
                  ?>
                </div>
            </div>
    <!-- row -->
      <!--    <a href="#" class="btn btn-primary btn-default"><span class="glyphicon glyphicon-eye-open"></span> Default text here</a> -->
    </div>
        </div><!-- /.info -->
  </div>
</div>
  </div><!-- starter template -->
</div><!-- container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
  </body>
</html>
