<?php $CI =& get_instance();?>

    <!-- Bootstrap Select Css 
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />-->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<style>
      .cursors > div {
            box-sizing: border-box;
            white-space: nowrap;
            &:nth-child(even) {
               background: #eee;
            }
            &:hover {
               opacity: 0.25
            }
        }
        .pointer {cursor: pointer;}
        .cursors a{
            text-decoration: none !important;
        }
        
    </style>
    <style type="text/css">
.loading {
     
    margin: 0 auto;
    display: table;
    width: 3em;
    position: relative;
    top: 25px;
   

}

</style>

   <!--  Morris Chart Css-->
    <link href="<?php echo base_url();?>assets/plugins/morrisjs/morris.css" rel="stylesheet" />
<section class="content">
        <div class="container-fluid">

            <div align="right">

                 <h4>Jurisdiction-
                     <?php  if($this->session->userdata('circle_id') == 1){  ?>
                             <?php echo "Circle 1"; ?>

                     <?php }
                         elseif($this->session->userdata('circle_id') == 2){ ?>
                         <?php   echo "Circle 2"; ?>
                     <?php }
                      elseif($this->session->userdata('circle_id') == 3){ ?>
                          <?php   echo "Circle 3"; ?>

                    <?php }else{ ?>
                        <?php   echo "ALL Circle"; ?>

                    <?php } ?>
                      -  <?php  echo $division_name; ?>
                 </h4> 

            </div>

            <div class="block-header">
                <h4>MIS-Dashboard</h4>
            </div>

            

            <!-- Search Start -->
            <div class="row clearfix">
                
               
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" >
                <div class="card">
                        <!--
                        <div class="header">
                          <h5><a href="#"><span id="search" class="font-bold col-cyan pull-right m-b-25px;"><i class="fa fa-search"></i> Advance Search</span></a></h5>
                        </div>
                        -->
                        
                        <div class="body">
                           <div class="section_clone">  
                            <div class="row clearfix">
                                  <div class="col-md-4">
                                    <p>
                                        <b>Category </b>
                                    </p>
                                      <select class="form-control show-tick" id="project_category_id">
                                                <option value="0">Default all</option>
                                                <?php foreach ($project_category as $key => $val ){?>
                                                    <option value="<?php echo $val['id']; ?>"><?php echo $val['project_type']; ?></option>
                                                <?php } ?>
                                            </select>

                                </div> 
                                <div class="col-md-4">
                                    <p>
                                        <b>Scheme</b>
                                    </p>
                                  <select class="form-control show-tick" id="project_group_id">
                                                <option value="0">All</option>
                                                <?php foreach ($group_list as $key => $valg ){?>
                                                    <option value="<?php echo $valg['id']; ?>"><?php echo $valg['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                </div> 
                                
                                <div class="col-md-4">
                                    <span>
                                        <h5 class="m-t-5"><a href="#"><span id="search" class="font-bold col-cyan"><i class="fa fa-search"></i> Advance Search</span></a></h5>
                                    </span>
                                  <button class="btn bg-indigo waves-effect"  onclick="clickFunction();" type="button">
                                    <i class="material-icons">search</i>
                                    <span>SEARCH</span>
                                </button>
                                </div>
                                  
                                  
                                
                                
                                   <div id="searchinfo" style="display:none;">
                                  <!-- <div class="col-md-4" style="display:none;">
                                    <p>
                                        <b>Circle </b>
                                    </p>
                                     <select class="form-control" id="project_sector_id">
                                                <option value="0">All</option>
                                                <?php foreach ($sector_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['name']; ?></option>
                                                <?php } ?>
                                            </select>

                                </div> -->
                                <div class="col-md-4">
                                    <p>
                                        <b>Location </b>
                                    </p>
                                    <select class="form-control show-tick" id="project_area_id" onchange="destination_list();">
                                            <option value="0">Default All</option>
                                            <?php foreach ($project_area as $key => $val ){?>
                                                <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
                                            <?php } ?>
                                     </select>
                                </div>
                                <div class="col-md-4">
                                    <p>
                                        <b>Circle</b>
                                    </p>
                                  <select class="form-control" id="project_wing_id" onchange="divisionfunc(1)">
                                                <option value="0">All</option>
                                                <?php foreach ($wing_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['wing_name']; ?></option>
                                                <?php } ?>
                                            </select>

                                </div>

                                <div class="col-md-4">
                                    <p>
                                        <b>Division</b>
                                    </p>
                                    <select class="form-control" id="project_division_id">
                                               
                                   <option value="">Select project Division</option>
                                         
                                       
                                    </select>

                                </div>
                                <!-- <div class="col-md-4">
                                    <p>
                                        <b>Division</b>
                                    </p>
                                    <select class="form-control" id="project_division_id">
                                                <option value="0">All</option>
                                                <?php foreach ($division_list as $key => $vals ){?>
                                                    <option value="<?php echo $vals['id']; ?>"><?php echo $vals['division_name']; ?></option>
                                                <?php } ?>
                                    </select>

                                </div> -->
                              </div>
                                  
                               </div>
                               <!--
                                <div class="pull-right" style="margin-top: -21px;">
                                  <button class="btn bg-indigo waves-effect"  onclick="clickFunction();" type="button">
                                    <i class="material-icons">search</i>
                                    <span>SEARCH</span>
                                </button>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>


                    </div>


                    
                    <!-- <div id="proj_delayed">

                    
                   </div> -->
                    <div id="proj_delayed">

                
                   </div>
                  
                <div class=" loading" id="loading3">
                    <img class="img-responsive" src="<?php echo base_url().'assets/images/loader.jpg'; ?>">
                   </div>
                
                
            </div>                  
            <!-- Search End -->
            
            <div id="dash_area">

                <!-- Project Summary Start -->
                <div class="row clearfix">  
                
                 
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">  

                    <!-- Project Summary Start --> 
                     <div id="proj_sum">
                           
                     </div>
                    
                    <!-- Project Summary End --> 

                    <!-- Project Overview Start --> 
                    <div id="proj_overview">

                
                   </div>

                  
                  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" id="loading4">
                        <div class="header">
                            <h2>Project Overview</h2>
                            
                        </div>
                        <div class="body">
                            <div class=" loading">
                                <img class="img-responsive" src="<?php echo base_url().'assets/images/loader.jpg'; ?>">
                               </div>
                        </div>
                    </div>

                    

                
                    <!-- Project Overview End -->
                    
                        <div class="clearfix"></div> 
                    </div>
                    </div>
                    
                </div>
                <!-- Project Summary End -->

                
             
                
                <!-- Financial Overview WITH monthly and Cumulative Start -->
                
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card"> <div class="header">
                                
                                   <div style="float:left">  <h2>Overall Progress – Construction</h2></div>
                                   <div style="float:right">
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="percentage" onclick="type_button(this.value);"    type="button"><strong>%</strong></button>
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="actual"  onclick="type_button(this.value);"   type="button"><strong>Rs.</strong></button>
                                    </div>
                                    <div style='clear:both'></div>
                            </div>
                            <div class="body">
                              <!-- Nav tabs -->
                            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                                <li role="presentation" class="active"><a href="#home" data-toggle="tab">Monthly Overview</a></li>
                                <li role="presentation"><a href="#profile" onclick="cumulativeFunction();" data-toggle="tab">Cumulative Overview </a></li>
                            </ul>
                            
                            
                            <div class="tab-content">
                                
                                <div role="tabpanel" class="tab-pane fade in active" id="home"> 
                                    <div id="loading1" class="loading"><img class="img-responsive" src="<?php echo base_url().'assets/images/loader.jpg'; ?>"></div>
                                <div id = "financial_data" style = "min-width: 550px; height: 400px; margin: 0 auto"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile">
                                    <div id="loading2" class="loading"><img class="img-responsive" src="<?php echo base_url().'assets/images/loader.jpg'; ?>"></div>
                                     <div id = "financial_datacum" style = "min-width: 550px; height: 400px; margin: 0 auto"></div>
                                </div>
                            </div>
                            
                            

                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Financial Overview WITH monthly and Cumulative End -->
                <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Tendering Project overview</h2>
                            </div>
                            <div class="body">
                                <!-- <div id="bar_chart" height="150"></div> -->
                                <div id="container_tendering" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Vendor Overview Start --> 


                 <!-- over all financial data test  -->
                 <div class="row clearfix">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="header">
                                <h2>Financial Project overview</h2>
                            </div>
                            <div class="body">
                               
                                <div id="container_financialdata" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                               <!-- <a href="<?php echo base_url();?>Dashboard/yearly_financial?startdate=2020-04-01&enddate=2021-03-31">
                                <div id="container_financialdata" style="min-width: 310px; height: 400px; margin: 0 auto"></div></a> -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- over all financial data test  -->
                <div class="row clearfix">    

                  

             <!-- Source Of Fund Overview Start -->
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="card"> 
                        <div class="header p-b-10">
                          <div style="float:left">  <h2>Overview | Funds Utilized- Pre-Construction Activity</h2></div>
                                   <div style="float:right">
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="percentage" onclick="PCtype_button(this.value);"    type="button"><strong>%</strong></button>
                                    <button  id="type" class="btn bg-blue-grey waves-effect" value="actual"  onclick="PCtype_button(this.value);"   type="button"><strong>Rs.</strong></button>
                                    </div>
                                    <div style='clear:both'></div>
                        
                          </div>
                        <div class="body">
                         <?php
                            $get_url = site_url().'/Dashboard/sourceof_fund_overview'; 
                          ?>
                          
                          <div id = "source" style = " margin: 0 auto"></div>
     
                          </div>
                        </div>
                    </div>
                    
                    <!-- Source Of Fund Overview End --> 
                    
                    

                    <!-- Source Of Fund Overview Start -->
                 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="card">
                        
                         <div class="header"><h2>Overview | All Project Pre-Construction Activity</h2></div>
                        <div class="body">
                         <?php
                          $get_url = site_url().'/Dashboard/sourceof_fund_overview'; 
                          ?>
                          
                          <div id = "pre_construction" style = " margin: 0 auto"></div>
     
                          </div>
                        </div>
                    </div>
                    
                    <!-- Source Of Fund Overview End --> 
                    
                </div>              
                
                
                <!-- Vendor Overview End --> 


                <!-- Project Progress Start -->
                <div id="project_progress">

                
                </div>
                
                <!-- Project Progress End -->


               <!-- Project Isuue Start -->

                <div id="project_issue">

                
                </div>
                <!-- <div id="project_issue">
     

                        <div class="row clearfix">
                         <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="card">
                                
                                <div class="body">
                                    <div class="">
                                        <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                                <tr>
                                                    <th>Sl No</th>
                                                    <th>Project Name</th>
                                                    <th>Open issue</th>
                                                    <th>Close Issue</th>
                                                </tr>

                                            </thead>
                                            <tbody>


                                           </tbody>
                                        </table>
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


             </div> -->

       
                

        


             

         <!-- Project Isuue end -->




            </div>                            

          
    <!-- START WELCOME MODAL MESSAGE  -->
        <div id="welcome-modal" class="modal" tabindex="-1" role="dialog"  data-backdrop="static" data-keyboard="false">


        </div>  
    <!-- End WELCOME MODAL MESSAGE  -->

        </div>
    </section>
    
    
<script src = "<?php echo base_url(); ?>assets/js/jquery.min.js"> </script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css">


<script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/series-label.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pages/charts/hi_charts/export-data.js"></script>
<script src="https://code.highcharts.com/modules/no-data-to-display.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.redirect.js"></script>

<!-- Morris Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.bundle.js"></script>

<!-- Select Plugin Js
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script> -->
  <script type="text/javascript">
        <?php
     $login_type = $_GET['type'];
     
    if ($login_type == "login"){
    ?>
     $(document).ready(function() {

    
    load_details();
    //$('#initial_modal').modal('show');
     });
    <?php
    } 
    ?>
    </script>
    
    <script type="text/javascript">
function load_details()
{
         var Rurl = "<?php echo base_url();?>Userdashboard/modalwelcomemsgDetails";
        $.ajax({
            type: 'GET',
            url: Rurl,
            success: function (output) {
            $('#welcome-modal').html(output).modal('show');//now its working
            },
            error: function(output){
            alert("fail");
            }
     });
    
 
}
</script>  
    
<script type="text/javascript">
       
   $(document).ready(function(){
       
  get_pre_construction_data();
  // we call the function
  fetchorgsummaryData();
  fetchproject_overview();
  financial_overviewdata();
  //vendor_overview();
  fetchSOFData();
  project_progress();
  project_issue();
 // wi_overviewdata();
  //workitem_progress();
  financial_progressmonthly();
  financial_progresscum();
  fetchprojectDelayedData();
  tenderingdashboard();
  financialdatafetch();

$("#loading1").show();
$("#financial_data").hide();
$("#loading2").show();
$("#financial_datacum").hide();
$("#loading3").show();
$("#proj_delayed").hide();
$("#loading4").show();
$("#proj_overview").hide();
});

 $( document ).ready(function() {
     
        $("#search").click(function() {
            $("#searchinfo").fadeToggle();
        });
  
});
        
    
    function clickFunction(){

  fetchorgsummaryData();
  fetchproject_overview();
  //financial_overviewdata();
  //financial_overviewdatacum();
  //vendor_overview();
  fetchSOFData();
  project_progress();
  project_issue();
 // wi_overviewdata();
 // workitem_progress();
  financial_progressmonthly();
  financial_progresscum();
  fetchprojectDelayedData();
  get_pre_construction_data();
  tenderingdashboard();
  financialdatafetch();
$("#loading1").show();
$("#financial_data").hide();
$("#loading2").show();
$("#financial_datacum").hide();
$("#loading3").show();
$("#proj_delayed").hide();
$("#loading4").show();
$("#proj_overview").hide();
}   
    
    function cumulativeFunction(){

  financial_progresscum();
}   

        /*newly added by  SUDIPTA*/
        
function type_button(fired_button) {
                // var fired_button = $(this).val();
                 financial_progressmonthly(fired_button);
                 financial_progresscum(fired_button);
                 $("#loading1").show();
                $("#financial_data").hide();
                $("#loading2").show();
                $("#financial_datacum").hide();
}

        
function PCtype_button(fired_button) {
                 fetchSOFData(fired_button);
                // financial_progresscum(fired_button);
}
    
                
   // alert(fired_button);
          
    function financial_progressmonthly(type_show = false){
                         
        //alert(type_show);
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        $("#loading1").show();
        $("#financial_data").hide();
         $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Dashboard/get_finnancial_progressdata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id, "type_show": type_show},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) { 
			
			Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				}); 
        
                
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Monthly Progress'   
            };   
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
    };
    
            
            var yAxis = {
               min: 0,
               title: {
                  text: 'MONTHLY PROGRESS ('+jsonData.value_sufx+')'         
               }      
            };
            var credits = {
               enabled: false
            };   
            
            var tooltip= {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    };
            var series = [
               {
                  color: '#374649',
                  name: 'Monthly Planned Value',
                  data: jsonData.planned
               }, 
               {
                  color: '#ff8b3d',
                  name: 'Monthly Earned Value',
                  data: jsonData.earned

               }, 
               {
                  color: '#01b8aa',
                  name: 'Monthly Paid Value',
                  data: jsonData.paid

               }
            ];     
      
            var json = {};   
            json.chart = chart; 
            json.title = title; 
            json.xAxis = xAxis;
            json.yAxis = yAxis; 
            json.tooltip = tooltip;
            json.credits = credits;
            json.series = series;
            $('#financial_data').highcharts(json);
            },
        complete: function (data) {
          $("#loading1").hide();
            $("#financial_data").show();
         }
        });
         
                }
                  
    function financial_progresscum(type_show = false)
            {
                
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        $("#loading2").show();
        $("#financial_datacum").hide();

                        $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/Dashboard/get_finnancial_cumulativedata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id, "type_show": type_show},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
        
             Highcharts.setOptions({
				lang: {
				  decimalPoint: '.',
				  thousandsSep: ','
				}
				});
				 
          var title = {
               text: 'Cumulative Overview'   
            };
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
            };
            var yAxis = {
               title: {
                  text: 'PROGRESS ('+jsonData.value_sufx+')'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   
            
            var tooltip= {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:,.2f} '+jsonData.value_sufx+'</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    };
        
            var series =  [{
                  color: '#374649',
                  name: 'Cum Planned Value (PV)',
                  data: jsonData.planned
               }, 
               {
                  color: '#ff8b3d',
                  name: 'Cum Earned Value (EV)',
                  data: jsonData.earned
               }, 
               {
                  color: '#01b8aa',
                  name: 'Cum Actual Paid (AC)',
                  data: jsonData.paid
               }
            ];

            var json = {};
            json.title = title;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
           // json.legend = legend;
            json.series = series;
            
            $('#financial_datacum').highcharts(json);},
        complete: function (data) {
          $("#loading2").hide();
        $("#financial_datacum").show();
         }

        });
          
          }
          
          
        /*newly added by  SUDIPTA*/


   function fetchSOFData(type_show = false)
          {
        //alert(type_show);
        if (type_show == "actual"){
            var showtyp = "Rs.";
        }
        else
        {
            var showtyp = "%";
            
        }
    
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();

    var getUrl = "<?php echo $get_url; ?>"+"?project_sector_id="+project_sector_id+"&project_group_id="+project_group_id+"&project_category_id="+project_category_id+"&project_area_id="+project_area_id+"&project_wing_id="+project_wing_id+"&project_division_id="+project_division_id+"&type_show="+type_show;
        var options = {
            

          chart:{
            renderTo:'source',
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type:'pie'
          },
          title: {
                text: ''
            },
            tooltip: {
         headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
                           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}: </td>' +
                              '<td style = "padding:0"><b>{point.y:,.2f} '+showtyp+' </b></td></tr>',
                           footerFormat: '</table>',
                           shared: true,
                           useHTML: true
    },
    accessibility: {
        point: {
            valueSuffix: showtyp
        }
    },
    plotOptions: {
        pie: {
            colors: [
     '#fd625e', 
     '#374649', 
     '#f2c80f', 
     '#01b8aa', 
     '#5f6b6d', 
     '#8ad4eb'
   ],
   
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b> {point.y:,.2f}  '+showtyp+' </br>'+
                              '<table><tr><td style = "color:{series.color};padding:0"></td>' +
                              '</tr></table>'
            }
        },
		
    series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function(event) {
                       project_summary_list('Overview Pre Construction');
                    }
                }
            }
        }
    },

          series:[{
            name: 'Fund Utilised',
          }]
        };


    $.getJSON(getUrl,function(data){
      options.series[0].data = data;
      var chart = new Highcharts.Chart(options);
    });
  
              
          }
            
   function fetchorgsummaryData()
          {     
       
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/org_project_summary",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", 
                            "project_sector_id": project_sector_id, 
                            "project_group_id": project_group_id,
                            "project_category_id": project_category_id, 
                            "project_area_id": project_area_id, 
                            "project_wing_id": project_wing_id,
                            "project_division_id": project_division_id
                    },
                        success: function (data) {                          
                        //console.log(data);
                           $('#proj_sum').html('').append(data);
                        
                          }
                        });
                         
          }
            
   function fetchproject_overview()
          {
            $("#loading4").show();
            $("#proj_overview").hide();
       
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/org_project_overview",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
                        success: function (data) {                          
                        
                           $('#proj_overview').html('').append(data);
                        
                          },
                        complete: function (data) {
                            $("#loading4").hide();
                            $("#proj_overview").show();
                         }
                        });
                        

          }         
                  
   function financial_overviewdata()
          {
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/Dashboard/get_finnancial_progressdata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                var chart = {
                           type: 'column'
                        };
                var title = {
               text: ''   
            };
            var subtitle = {
               text: ''
            };
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
            };
            var yAxis = {
                min: 0,
               title: {
                  text: 'Amount(₹)'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   
             var tooltip = {
                           headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
                           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}'+'(&#8377;)'+': </td>' +
                              '<td style = "padding:0"><b>{point.y:.2f} </b></td></tr>',
                           footerFormat: '</table>',
                           shared: true,
                           useHTML: true
                        };
            
            var plotOptions = {
               column: {
                  pointPadding: 0.2,
                  borderWidth: 0
               }
            }; 
             
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var credits = {
               enabled: false
            };
            var series =  [{
                  name: 'Invoice Claimed',
                  data: jsonData.claimed
               }, 
               {
                  name: 'Invoice Released',
                  data: jsonData.released
               }
            ];

            var json = {};
            /*json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
             json.chart = chart;*/
                        json.title = title;  
                        json.subtitle = subtitle;
                        json.tooltip = tooltip;
                        json.xAxis = xAxis;
                        json.yAxis = yAxis; 
                        json.series = series;
                        json.plotOptions = plotOptions; 
                        json.credits = credits;
            
            $('#financial_dataOLD').highcharts(json);
         
                
                }
        });
                        

          }
                  
   function financial_overviewdatacum()
          {

        
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
            type: 'POST',
            url: "<?php echo site_url();?>/Dashboard/get_finnancial_cumulativedata",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
            dataType: "json",
            //async: false,
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                var chart = {
                           type: 'column'
                        };
                var title = {
               text: ''   
            };
            var subtitle = {
               text: ''
            };
            var xAxis = {
               categories: jsonData.period,
                         crosshair: true
            };
            var yAxis = {
                min: 0,
               title: {
                  text: 'Amount(₹)'
               },
               plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
               }]
            };   
             var tooltip = {
                           headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
                           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}'+'(&#8377;)'+': </td>' +
                              '<td style = "padding:0"><b>{point.y:.2f} </b></td></tr>',
                           footerFormat: '</table>',
                           shared: true,
                           useHTML: true
                        };
            
            var plotOptions = {
               column: {
                  pointPadding: 0.2,
                  borderWidth: 0
               }
            }; 
             
            var legend = {
               layout: 'vertical',
               align: 'right',
               verticalAlign: 'middle',
               borderWidth: 0
            };
            var credits = {
               enabled: false
            };
            var series =  [{
                  name: 'Invoice Claimed',
                  data: jsonData.claimed
               }, 
               {
                  name: 'Invoice Released',
                  data: jsonData.released
               }
            ];

            var json = {};
            /*json.title = title;
            json.subtitle = subtitle;
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.tooltip = tooltip;
            json.legend = legend;
            json.series = series;
             json.chart = chart;*/
                        json.title = title;  
                        json.subtitle = subtitle;
                        json.tooltip = tooltip;
                        json.xAxis = xAxis;
                        json.yAxis = yAxis; 
                        json.series = series;
                        json.plotOptions = plotOptions; 
                        json.credits = credits;
            
            $('#financial_datacumOLD').highcharts(json);
         
                
                }
        });
                         
          }
          
   /*function vendor_overview()
          {
        
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/vendor_overview",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
                        dataType: "json",
                        success: function (data) 
                        { 
                        var chart = {
                           type: 'column'
                        };
                        var title = {
                           text: ''   
                        };
                        var subtitle = {
                           text: ''  
                        };
                        var xAxis = {
                           //categories: ['Vendor 1','Vendor 2','Vendor 3','Vendor 4','Vendor 5','Vendor 6'],
                           categories: data.vendor,
                           crosshair: true
                        };
                        var yAxis = {
                           min: 0,
                           title: {
                              text: 'Amount(₹)'         
                           }      
                        };
                        var tooltip = {
                           headerFormat: '<span style = "font-size:10px">{point.key}</span><table>',
                           pointFormat: '<tr><td style = "color:{series.color};padding:0">{series.name}'+'(&#8377;)'+': </td>' +
                              '<td style = "padding:0"><b>{point.y:.1f} </b></td></tr>',
                           footerFormat: '</table>',
                           shared: true,
                           useHTML: true
                        };
                        var plotOptions = {
                           column: {
                              pointPadding: 0.2,
                              borderWidth: 0
                           }
                        };  
                        var credits = {
                           enabled: false
                        };
                        var series= [
                           {
                              color: '#0000b3',
                              name: 'Invoice Claimed',
                              data: data.claimed
                           }, 
                           {
                              color: '#00b300',
                              name: 'Invoice Released',
                              data: data.released
                           }
                        ];
                        
                        
                        
                             
                     
                        var json = {};   
                        json.chart = chart; 
                        json.title = title;   
                        json.subtitle = subtitle; 
                        json.tooltip = tooltip;
                        json.xAxis = xAxis;
                        json.yAxis = yAxis;  
                        json.series = series;
                        json.plotOptions = plotOptions;  
                        json.credits = credits;
                        $('#vendor').highcharts(json);
  
         }
                        });
                        

          } */    
          
   function project_progress()
          {
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/project_progress",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
                        success: function (data) {                          
                        
                           $('#project_progress').html('').append(data);
                        
                          }
                        });
                         

          }


     function project_issue(){

        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/project_issue",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
                        success: function (data) {                          
                        
                           $('#project_issue').html('').append(data);
                        
                          }
                        });

     }     
          
   function destination_list()
          {
              
        var project_area_id = $('#project_area_id').val();
        //alert(project_area_id);
                         if (project_area_id > 0) {
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/area_destination",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_area_id": project_area_id},
                        success: function (data) {                          
                        
                          // $('#dest_list').html('').append(data);
                           
            $('#dest_list').html(data);
                            $('.selectpicker').selectpicker({
                style: 'btn-primary',
                size: 2
            });
                    $('.selectpicker').selectpicker('refresh'); 
                          }
                        });
                         }
                         else
                         {
                            $('#dest_list').html('').prepend('<select class="form-control show-tick" id=""><option value="0">Default All</option></select>');
                         }

          }
                  
   function wi_overviewdata()
          {
            var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        console.log(project_group_id);    
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>dashboard/get_work_item_budget_released_xhr",
            dataType: "json",
            //async: false,
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
            //contentType: "application/json; charset=utf-8",
            success: function (jsonData) {
                // console.log('jdsh');
                // console.log(jsonData);
                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Work Items Details'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: jsonData.category_ar,
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'INR'
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.2f} &#8377;</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    credits: {
                        enabled: false
                    },
                    colors: [
                        'green', 
                        'red'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                            //colorByPoint: true
                        }
                    },
                    series: [{
                        name: 'Planned',
                        data: jsonData.budget_ar

                    }, {
                        name: 'Released',
                        data: jsonData.released_ar

                    }]
                });

            }
        });
        
          }
            
   function workitem_progress()
          {
        
        var project_sector_id = $('#project_sector_id').val();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
          $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/Dashboard/wi_project_progress",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_sector_id": project_sector_id, "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
            dataType: "json",
            success: function (data) {
                //alert("Planned and Progress:"+ JSON.strinjpgy(data));
            var chart = {
               type: 'column'
            };
            var title = {
               text: 'Project Performance'   
            };    
            var xAxis = {
               categories: data.categories
            };
            var yAxis = {
               min: 0,
               title: {
                  text: 'Target/Achievement'
               },
               stackLabels: {
                  enabled: true,
                  formatter: function() {
      return [,this.total , '%'].join('');
    },
                  style: {
                     fontWeight: 'bold',
                     color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                  }
               }
            };
            var legend = {
               align: 'right',
               x: -30,
               verticalAlign: 'top',
               y: 25,
               floating: true,
               
               backgroundColor: (
                  Highcharts.theme && Highcharts.theme.background2) || 'white',
               borderColor: '#CCC',
               borderWidth: 1,
               shadow: false
            };   
            var tooltip = {
               
                            formatter: function() {
        var abcStr = data.complete;
        var datacomp = (data.complete);
        var index = this.point.index;
        var achieve = abcStr[index];
               
                // alert(abcStr[index]);
        
        var tooltip =  '<b>' + this.x + '</b><br/>';
        
        tooltip += '<br><span style="color:' + this.series.color + '">' + '<b>Target </b>' + '</span>: ';
        
            tooltip += this.point.stackTotal + '(%) <br><span style="color:'+ this.series.color + '"><br><b>Achieved:</b> '+ achieve +'(%)';                
        
        return tooltip;
      } 
               
               
               
            };
            var plotOptions = {
               column: {
                  stacking: 'normal',
                  dataLabels: {
                     enabled: true,
                     format: '{y} %',
                     color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                        || 'white',
                     style: {
                        textShadow: '0 0 3px black'
                     }
                  }
               }
            };
            var credits = {
               enabled: false
            };
            var series = [
               {
                  color: '#e60000',
                  name: 'Target',
                  data: data.left
               }, 
               {
                  color: '#006600',
                  name: 'Achieved',
                  data: data.complete
               }
            ];     
      
            var json = {};   
            json.chart = chart; 
            json.title = title;   
            json.xAxis = xAxis;
            json.yAxis = yAxis;
            json.legend = legend;
            json.tooltip = tooltip;
            json.plotOptions = plotOptions;
            json.credits = credits;
            json.series = series;
            $('#containerwi').highcharts(json);
            
            
            }

        });
                        

          }
          
          </script>
          
          <script type="text/javascript">
        function project_summary_list(type){
            
                var project_group_id = $('#project_group_id').val();
                var project_category_id = $('#project_category_id').val();
                var project_area_id = $('#project_area_id').val();
                var project_wing_id = $('#project_wing_id').val();
                var project_division_id = $('#project_division_id').val();
               
                $.redirect("<?php echo base_url('project_summary_list'); ?>", {'project_group_id': project_group_id, 'project_category_id': project_category_id, 'project_area_id': project_area_id, 'project_wing_id': project_wing_id, 'project_division_id': project_division_id, 'project_list_type': type},"POST","_blank");         
          }
          </script>
          
     <script language = "JavaScript">
    function get_pre_construction_data()
      { 
    
        
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
        
            $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>Dashboard/get_pre_contruction_activity",
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", "project_group_id": project_group_id,"project_category_id": project_category_id, "project_area_id": project_area_id, "project_wing_id": project_wing_id, "project_division_id": project_division_id},
            dataType: "json",
            success: function (datas) {


                var chart = {
                    type: 'column'
                };
                var title = {
                    text: ''
                };
                var xAxis = {
                    categories: datas.categories
                };
                var yAxis = {
                    min: 0,
                    title: {
                        text: 'Target/Achievement'
                    },
                    stackLabels: {
                        enabled: true,
                        formatter: function () {
                            return [, this.total, ''].join('');
                        },
                        style: {
                            fontWeight: 'bold',
                            color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                        }
                    }
                };
                var legend = {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,

                    backgroundColor: (
                        Highcharts.theme && Highcharts.theme.background2) || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                };


                var tooltip = {



                    formatter: function () {
                        var abcStr = datas.left;
                        var abcComp = datas.complete;
                        var datacomp = (datas.left);
                        var index = this.point.index;
                        var achieve = abcStr[index];
                        var comp = abcComp[index];

                        var tooltip = '<b>' + this.x + '</b><br/>';

                        

                        tooltip += ' <br><span style="color:' + this.series.color + '"><br><b>Pending:</b> ' + achieve + '';
                        tooltip += '<br><span style="color:' + this.series.color + '"><br><b>Completed:</b> ' + comp + '';
                        tooltip += '<br><span style="color:' + this.series.color + '">' + '<b>Total </b>' + '</span>: '+ this.point.stackTotal;

                        return tooltip;
                    }


                 };

                var plotOptions = {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true,
                            format: '{y}',
                            color: (Highcharts.theme && Highcharts.theme.dataLabelsColor)
                                || 'white',
                            style: {
                                textShadow: '0 0 3px black'
                            }
                        }
                    }
                };
                var credits = {
                    enabled: false
                };
                var series = [
                    {
                        color: '#374649',
                        name: 'Pending',
                        
                        data: datas.left,

                        tooltip: {
                            valueSuffix: ''
                        }
                    },
                    {
                        color: '#8ad4eb',
                        name: 'Completed',
                        data: datas.complete,

                        tooltip: {
                            valueSuffix: ''
                        }
                    }
                ];

                var json = {};
                json.chart = chart;
                json.title = title;
                json.xAxis = xAxis;
                json.yAxis = yAxis;
                json.legend = legend;
                json.tooltip = tooltip;
                json.plotOptions = plotOptions;
                json.credits = credits;
                json.series = series;
                $('#pre_construction').highcharts(json);

            }

        });
    }
      </script>

      <script type="text/javascript">
          function fetchprojectDelayedData()
          {     
       $("#loading3").show();
        $("#proj_delayed").hide();
        var project_group_id = $('#project_group_id').val();
        var project_category_id = $('#project_category_id').val();
        var project_area_id = $('#project_area_id').val();
        var project_wing_id = $('#project_wing_id').val();
        var project_division_id = $('#project_division_id').val();
                        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>Dashboard/fetch_project_delayed_data",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", 
                            "project_group_id": project_group_id,
                            "project_category_id": project_category_id, 
                            "project_area_id": project_area_id, 
                            "project_wing_id": project_wing_id,
                            "project_division_id": project_division_id
                    },
                        success: function (data) {                          
                        //console.log(data);
                           $('#proj_delayed').html('').append(data);
                        
                          },
                        complete: function (data) {
                          $("#loading3").hide();
                        $("#proj_delayed").show();
                         }
                        });
                         
          }
		  
		 function tenderingdashboard(){
            
        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Dashboard/tendering_chart",
            dataType: "json",       
            success: function (jsonData) {
              
                Highcharts.chart('container_tendering', {

                    chart: {
                        type: 'column'
                    },

                    title: {
                        text: 'Tender Phases by Project Count'
                    },

                    xAxis: {
                        categories: ['Bid Open','Under Technical Evaluation','Under Financial Evaluation', 'Bids Under Negotiation', 'Issue Of LoA']
                    },

                    yAxis: {
                        allowDecimals: false,
                        min: 0,
                        title: {
                            text: 'Count'
                        }
                    },

                    tooltip: {
                        formatter: function () {
                            return '<b>' + this.x + '</b><br/>' +
                                this.series.name + ': ' + this.y + '<br/>' +
                                'Total: ' + this.point.stackTotal;
                        }
                    },

                    plotOptions: {
                        column: {
                            stacking: 'normal'
                        }
                    },

                      series: [{
                        name: 'Pending',
                        color: '#374649',
                        data: jsonData.pendingcount.tenderpending
                      
                    },{
                        name: 'Completed',
                        color: '#8ad4eb',
                        data: jsonData.tendercount.tendercompleted
                       
                     }]
                });

            }
          });
        
    }  

    function financialdatafetch(){

        $.ajax({
            type: 'POST',
            url: "<?php echo base_url();?>Dashboard/yearly_financial_count",
            dataType: "json",       
            success: function (jsonData) {
              
                Highcharts.chart('container_financialdata', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Financial Progress'
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                       
                        categories: jsonData.yearcount
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Yearly Progress(Rs.)'
                        }
                    },
                    tooltip: {
                        valueSuffix: 'Rs.'
                    },
                    credits: {
                        enabled: false
                    },
                    colors: [
                        '#374649'
                        ],
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0,
                        }
                    },
                    series: [{
                         name: 'Years',
                         earnedyrs: ['110','21','67'],
                         data: jsonData.yearlyfinanicalcount,

                        plotOptions: {
        series: {
            cursor: 'pointer',
            point: {
                events: {
                    click: function () {
                        alert('hello world');
                       // alert('Category: ' + this.category + ', value: ' + this.y);
                    }
                }
            }
        }
    },


                    }]
                });

            }
          });

    } 

      </script>

      <script type="text/javascript">
   
    function divisionfunc() {
        var value = $('#project_wing_id').val();
        
         if (value != 0)
            {
            $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>Dashboard/getdivision_list",
            datatype : 'json',
            data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","circleId": value },
            
                success: function(data){
                     
                var parsed_data = JSON.parse(data);
                $("#project_division_id").empty();
                
                  $val_selec ='';
                  var listItems= "";

                      if(parsed_data.all_divisions.length > 0){
                        $("#project_division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                       for (var i = 0; i < parsed_data.all_divisions.length; i++)
                           {
                                $("#project_division_id").append(
                                    "<option  value='" + parsed_data.all_divisions[i].id  + "'>" + parsed_data.all_divisions[i]. division_name + "</option>");

                                  $val_selec ='';
                            } 
                        }

                        else
                        {
                        $("#project_division_id").append("<option  value='0'>" +'Select  Division' + "</option>");
                        
                          $val_selec =''; 
                        }

                    }
            });
            }
     }
</script>








 
    
    