<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
				<div class="block-header">
					<h4><?php echo $project_list_type.' Lists'; ?></h4>
				</div>
            </div>
            <div class="col-md-6">
				
			</div>
            <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body">
                            <div class="">
                                <table id="project_list" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>SV <span class="ntip p-l-5"> <img src="<?php echo base_url(); ?>assets/images/msg.png" alt="" width="16" height="16"> 
                                            <span class="ntiptext">Earned Value(%) - Planned Value(%)</span>
                                            </span></th>
                                            <th>SPI <span class="ntip p-l-5"> <img src="<?php echo base_url(); ?>assets/images/msg.png" alt="" width="16" height="16"> 
                                            <span class="ntiptext">Earned Value(%) / Planned Value(%)</span>
                                            </span></th>
                                            <th>CV <span class="ntip p-l-5"> <img src="<?php echo base_url(); ?>assets/images/msg.png" alt="" width="16" height="16"> 
                                            <span class="ntiptext">Earned Value(%) - Actual Cost(%)</span>
                                            </span></th>
                                            <th>CPI <span class="ntip p-l-5"> <img src="<?php echo base_url(); ?>assets/images/msg.png" alt="" width="16" height="16"> 
                                            <span class="ntiptext">Earned Value(%) / Actual Cost(%)</span>
                                            </span></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $k =1; 
                                        if(is_array($project_list)){
                                            foreach ($project_list as $project) {
                                         $Planned_Value = $project->Planned_Value;
                                         $Earned_Value = $project->Earned_Value;
                                         $Paid_Value = $project->Paid_Value;
                                         $agreement_cost = $project->agreement_cost;
                                         if(empty($Planned_Value)){
                                            $Planned_Value = 0.00;
                                         }
                                         if(empty($Earned_Value)){
                                            $Earned_Value = 0.00;
                                         }
                                         if(empty($Paid_Value)){
                                            $Paid_Value = 0.00;
                                         }
                                         if($Planned_Value > 0.00){
                                            $PV =  ($Planned_Value * 100 ) / $agreement_cost;
                                        }else{
                                            $PV = 0.00;
                                        }

                                        if($Earned_Value > 0.00){
                                            $EV =  ($Earned_Value * 100 ) / $agreement_cost;
                                        }else{
                                            $EV = 0.00;
                                        }

                                        if($Paid_Value > 0.00){
                                           $AC =  ($Paid_Value * 100 ) / $agreement_cost;
                                        }else{
                                            $AC = 0.00;
                                        }
                                         
                                         








                                         $SV = $EV - $PV;
                                         if($PV > 0.00){
                                          $SPI = $EV / $PV;    
                                      }else{
                                        $SPI = 0.00;
                                      }
                                          
                                          
                                             
                                         $CV = $EV - $AC;
                                         if($AC != 0){
                                         $CPI = $EV / $AC;

                                        }else{
                                            $CPI = 0.00;
                                        }
                                        ?>

                                        <tr>
                                            <td><?php echo $k; ?></td>
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project->id);?>">
                                            <span class="ntip"><?php echo $project->project_name;?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a>
                                        </td>
                                            <td><?php echo $project->project_type; ?></td>
                                            <td><?php echo $project->area_name; ?></td>
                                            <td><span class="label label-danger"><?php echo round($SV,2); ?></span></td>
                                            <td><?php echo round($SPI,2); ?></td>
                                            <td><?php echo round($CV,2); ?></td>
                                            <td>
                                                <?php echo round($CPI,2); ?>
                                                
                                            </td>
                                           
                                            
                                        </tr>



                                       <?php $k++; } } ?>

                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->

        </div>
    </section>



<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#project_list').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

    });

</script>

<script type="text/javascript">
    $(document).on( "click", '.view_chnge_st_btn',function(e) {

 

  var id = $(this).data('id');
    //alert(id);

    $.ajax({
  type: "POST",
  url: "<?php echo base_url(); ?>project_summary_list/change_seen_status",
  data: "project_id=" +id,
  success: function(data){
    //console.log(data);
    if(data == 'success')
    {
      return true;
    }
  }
  });
  

});
</script>