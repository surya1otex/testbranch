<!DOCTYPE html>
<html>



<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title>Project Monitoring Dashboard</title>
<!-- Favicon-->
<link rel="icon" href="../favicon.ico" type="image/x-icon">



<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fontawesome-all.min.css"/>



<!-- Bootstrap Core Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">



<!-- Custom Css -->
<link href="<?php echo base_url();?>assets/css/style.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/css/custom.css" rel="stylesheet"/>



<link href="<?php echo base_url();?>assets/css/themes/theme-pmms.css" rel="stylesheet" />
<link href="<?php echo base_url();?>assets/css/mstepper.min.css" rel="stylesheet"/>
<!-- Jquery Core Js -->
<script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap Material Datetime Picker Css -->
<link href="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
<!-- Autosize Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/autosize/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/momentjs/moment.js"></script>
<!-- Bootstrap Material Datetime Picker Plugin Js -->
<script src="<?php echo base_url();?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
<script src="<?php echo base_url();?>assets/js/pages/forms/basic-form-elements.js"></script>




<script src="<?php echo base_url();?>assets/js/global.js"></script>



</head>



<body class="theme-ey">

<nav class="navbar">
<div class="container-fluid">
<div class="navbar-header">
<a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
<a href="javascript:void(0);" class="bars"></a>



<a class="navbar-brand" href="#"><img src="<?php echo base_url();?>assets/images/obcc_inner_logo.png"/ class="img-responsive"></a>
<span class="logo" style="width:525px;">
<h2>Project Monitoring Dashboard</h2><br>
<small>Odisha Bridge & Construction Corporation Limited</small>
</span>
</div>
<div class="collapse navbar-collapse" id="navbar-collapse">
<ul class="nav navbar-nav navbar-right">


<!-- Logged in as -->
<li class="logged_in">Logged in as : <?php echo $this->session->userdata('username');?>
<?php
//echo "<pre>";
//print_r($this->session->userdata());
if($this->session->userdata('user_type') == 3){
?>
<?php } ?>
</li>
<!-- #END# Logged in as-->

<!-- Log Out -->
<li>

<a href="<?php echo base_url();?>home/logout">
<i class="fas fa-lock-open"></i> <span> Log Out</span>
</a>
</li>
<!-- #END Log Out -->
</ul>
</div>
</div>
</nav>
<!-- #Top Bar -->