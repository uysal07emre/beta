<?php
session_start();
require_once( "inc/config.inc.php" );
require_once( "inc/functions.inc.php" );
$user = check_user();
include( "1/header.inc.php" );
$pdo = new PDO('mysql:host=localhost;dbname=rox', 'root', 'root');

?>


<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<!-- Logo -->
			<a href="index2.html" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>R</b>Lv</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Rox</b>Live</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
			
				<!--messages-menu-->
				<?php include("1/messages-menu.inc.php")?>

				<!--user-menu-->
				<?php include("1/user-menu.inc.php")?>

				<!--main-sidebar-->
				<?php include("1/main-sidebar.inc.php")?>


				<!-- Content Wrapper. Contains page content -->
				<div class="content-wrapper">
					<!-- Content Header (Page header) -->
					<section class="content-header">
						<h1>
        Dashboard
        <small>Control panel</small>
      </h1>
					
						<ol class="breadcrumb">
							<li><a href="#"><i class="ion ion-person-add"></i>Usere</a>
							</li>
							<li class="active">Yeni Kayıt</li>
						</ol>
					</section>

					<!-- Main content -->
					<section class="content">
						<!-- Small boxes (Stat box) -->
						<div class="row">
						  <div class="col-lg-3 col-xs-6">
								<!-- small box -->
							<div class="small-box bg-yellow">
									<div class="inner">
										<h3>
<?php
                    $statement = $pdo->prepare("SELECT COUNT(*) AS anzahl FROM users");
                    $statement->execute();  
                    $row = $statement->fetch();
                    echo "".$row['anzahl']."";
					
											
					?>
										</h3>

										<p>User Registrations</p>
									</div>
							  <div class="icon">
										<i class="ion ion-person-add"></i>
									</div>
									<a href="newregister" class="small-box-footer">Yeni Kayıt <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
							<!-- ./col -->
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								<div class="small-box bg-green">
									<div class="inner">
										<h3>53<sup style="font-size: 20px">%</sup></h3>

										<p>Bounce Rate</p>
									</div>
									<div class="icon">
										<i class="ion ion-stats-bars"></i>
									</div>
									<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
								</div>
						  </div>
							
							<!-- ./col -->
							
							<!-- ./col -->
							<div class="col-lg-3 col-xs-6">
								<!-- small box -->
								
						  </div>
						<!-- /.row -->
						<div class="col-lg-3 col-xs-6">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Tarih&amp;Saat</span>
              <span class="info-box-number">
				  <?php
                      $timestamp = time();
                      $datum = date("d.m.Y", $timestamp);
                      echo $datum;
                      ?>
				</span> 
              <div class="progress">
                <div class="progress-bar" style="width: <?php $timestamp = time(); $datum = date("s%", $timestamp);echo $datum;
					 ?>"> </div> 
              </div>
                  <span class="progress-description">
                    <?php
                       $timestamp = time();
                       $datum = date("H:i.s", $timestamp);
                        echo $datum;
                        ?>
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
							</section>
						<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Responsive Hover Table</h3>

              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tbody><tr>
                  <th>ID</th>
                  <th>İsim</th>
                  <th>Soy isim</th>
                  <th>Mail</th>
                </tr>
                <?php 
$statement = $pdo->prepare("SELECT * FROM users ORDER BY id");
$result = $statement->execute();
$count = 1;
while($row = $statement->fetch()) {
	echo "<tr>";
	echo "<td>".$count++."</td>";
	echo "<td>".$row['vorname']."</td>";
	echo "<td>".$row['nachname']."</td>";
	echo '<td><a href="mailto:'.$row['email'].'">'.$row['email'].'</a></td>';
	echo "</tr>";
}
?>
					
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
				<div class="control-sidebar-bg"></div>
	</div>
	<!-- ./wrapper -->
	<?php 
include("1/footer.inc.php")
?>