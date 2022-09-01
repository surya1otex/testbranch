<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title> Project Monitoring Dashboard</title>
    <!-- Favicon-->
    <link rel="icon" href="../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="../css/google_font/google_font.css" rel="stylesheet" type="text/css">
    <link href="../css/google_font/google_material-icons.css" rel="stylesheet" type="text/css">
    
    <link rel="stylesheet" href="../css/fontawesome-all.min.css"/>

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Bootstrap Material Datetime Picker Css -->
    <link href="../plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="../plugins/waitme/waitMe.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/custom.css" rel="stylesheet">
      
     <!-- icheck -->
    <link href="../css/icheck/flat/green.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/theme-pmms.css" rel="stylesheet" />
    
   <!-- Steps Css --> 
    <link href="../css/mstepper.min.css" rel="stylesheet"> 
   <style>
       .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
            background-color: #eee;
            opacity: 1;
        }
   </style>
</head>

<body class="theme-ey"  oncontextmenu="return false;">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    
    <!-- Top Bar -->
    
<?php include("include/header.php");?>
    <!-- #Top Bar -->
    <!-- #Left Menu Bar -->
    <section>
        <!-- Left Sidebar -->
       
<?php include("include/leftmenu.php");?> 
        <!-- #END# Left Sidebar -->

    </section>
    <!-- #Left Menu Bar -->

    <section class="content">
        <div class="container-fluid">
            <!-- <div class="block-header">
                <h4>Approval Status For Tendering</h4>
            </div> -->

        <!--  -->

        <div class="row m-b-20">
             
                <div class="col-xs-12 ol-sm-12 col-md-12 col-lg-12">
                  <div class="panel-group m-b-10" id="accordion_10" role="tablist" aria-multiselectable="true">  
                    <div class="panel panel-col-black">
                        <div class="panel-heading" role="tab" id="headingTwo_10">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion_10" href="#collapseTwo_10" aria-expanded="false"
                                   aria-controls="collapseTwo_10">
                                    <i class="more-less glyphicon glyphicon-plus"></i>
                                    Project Information </a>
                            </h4>
                        </div>
                   </div>
                </div>
            </div>
        </div>
        <!--  -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Issue Create </h2>
                        </div>
                        <div class="body">
                            <div class="m-b-15">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p><b>Issuer Name</b></p>
                                        <input class="form-control" type="text" placeholder="Issuer Name">
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Communication Type</b></p>
                                        <select  class="form-control" name="communication-type">
                                            <option value="0">Select Communication Type</option>
                                            <option value="1">Option 1</option>
                                            <option value="2">Option 2</option> 
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <p><b>Addressee Name</b></p>
                                        <input class="form-control" type="text" placeholder="Addressee Name">
                                    </div>

                                    <div class="col-md-4">
                                        <p><b>Timeline (if mentioned)</b></p>
                                        <input class="form-control" type="text" placeholder="Optional">
                                    </div>

                                    <div class="col-md-4">
                                    <p><b>Synopsis of the communication</b></p>
                                    <textarea class="form-control no-resize" rows="1" placeholder="Please type what you want..."></textarea>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <div class="issue-create-container m-b-15">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p><b>Issue Name</b></p>
                                        <input class="form-control" type="text" placeholder="Issue Name">
                                    </div>
                                    <div class="col-md-3">
                                        <p><b>Issue Owner</b></p>
                                        <select  class="form-control" name="issue-owner">
                                            <option value="0">Select Issue Owner</option>
                                            <option value="1">Works Dept</option>
                                            <option value="2">External Authority</option> 
                                        </select>
                                    </div> 
                                    <div class="col-md-3">
                                        <p><b>Upload Document</b></p>
                                        <input  type="file" name="fileupload" value="fileupload" id="" class="form-control">
                                    </div>
                                    <div class="col-md-2">
                                        <p><b>Issue Date</b></p>
                                        <input type="text" id="approve" class="datepicker form-control" placeholder="Please choose a date...">
                                    </div> 
                                    <div class="col-md-1 p-t-25">
                                        <button class="btn btn-success btn-circle waves-effect waves-circle waves-float issue-add" type="button"><i class="material-icons">add</i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 align-center">
                                <button class="btn btn-primary waves-effect" type="button">SAVE</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>            
                      </div>
                  </div>
            <!-- Select -->
        </div>
    </section>
    <!-- #Main Content -->
    
         <!-- Footer -->
            
<?php include("include/footer.php");?>
          <!-- #Footer -->
    
    
    <!-- Jquery Core Js -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../plugins/node-waves/waves.js"></script>

    <!-- Autosize Plugin Js -->
    <script src="../plugins/autosize/autosize.js"></script>

    <!-- Moment Plugin Js -->
    <script src="../plugins/momentjs/moment.js"></script>

    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="../plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>


    <!-- Custom Js -->
    <script src="../js/admin.js"></script>
    <script src="../js/pages/forms/basic-form-elements.js"></script>

    <!-- Demo Js -->
    <script src="../js/demo.js"></script>
    
  <!-- Steps js --> 
<script src="../js/mstepper.min.js"></script>

<script>
   var stepper = document.querySelector('.stepper');
   var stepperInstace = new MStepper(stepper, {
      // options
      firstActive: 0 // this is the default
   })
</script>  
    
    <script type="text/javascript">
function showDiv(select){
   if(select.value=="yes"){
    document.getElementById('dropped').style.display = "block";
   } else{
    document.getElementById('dropped').style.display = "none";
   }
} 

   $(function () {
      // $('#approve').datepicker({ format : 'DD MMMM YYYY' });
    });
</script>

<script>
   function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}
$('.panel-group').on('hidden.bs.collapse', toggleIcon);
$('.panel-group').on('shown.bs.collapse', toggleIcon);
</script>
<script>
    //Bidder details add remove 
    $(".issue-add").click(function () {
        $(".issue-create-container").append('<div id="issue-create-row"><div class="row"><div class="col-md-3"><input class="form-control" type="text" placeholder="Issue Name"></div><div class="col-md-3"> <select class="form-control" name="issue-owner"><option value="0">Select Issue Owner</option><option value="1">Works Dept</option><option value="2">External Authority</option> </select></div><div class="col-md-3"> <input type="file" name="fileupload" value="fileupload" id="" class="form-control"></div><div class="col-md-2"><input type="text" id="approve" class="datepicker form-control" placeholder="Please choose a date..."></div><div class="col-md-1"> <button class="btn btn-default btn-circle waves-effect waves-circle waves-float issue-remove" type="button"><i class="material-icons col-pink">delete</i></button></div></div></div>');
    });
    
     $("body").on("click", ".issue-remove", function() {
     $(this).closest('#issue-create-row').remove();
     });

</script>
</body>
</html>