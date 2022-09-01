<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>Project Closing</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body table-responsive">
                            <div class="">
                            <?php
							/*echo "<pre>";
							print_r($this->session->userdata);
							echo "</pre>";*/
							?>
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  <?php echo !empty($project_deatail) ? 'id="project_list"' : ''; ?>>
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Location</th>
                                            <th>EV (%)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                
                                                
                                                $project_id = $pro_dtl['id'];

                                                $commissioning_cnt = $CI->check_field_value_exist_or_not_in_tbl('project_completed_history','project_id',$project_id);
                                                if($commissioning_cnt > 0){
                                                    $cls = 'btn bg-green waves-effect';
                                                    $btn_str = 'Update';
                                                    $sta_tus = '<span class="label label-success">Closed</span>';
                                                }else{
                                                    $cls = 'btn bg-blue waves-effect';
                                                    $btn_str = 'Entry';
                                                    $sta_tus = '<span class="label label-warning">Achieved</span>';
                                                }

                                                $project_agreement_cost = $pro_dtl['project_agreement_cost'];
                                                $Earned_Value = $pro_dtl['Earned_Value'];

                                                $paid_percent = ($Earned_Value / $project_agreement_cost) * 100;
                                                
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                            
                                             <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']); ?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']; ?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a>
                                            </td>
                                            <td><?php echo $pro_dtl['project_type_name']; ?></td>
                                            <td><?php echo $pro_dtl['area_name']; ?></td>
                                            <td><?php echo round($paid_percent,2); ?></td>
                                            <td><?php echo $sta_tus; ?></td>
                                            <td>
                                                <div class="notification">
                                                <a href="<?php echo site_url(); ?>Commissioning/add_details?project_id=<?php echo base64_encode($pro_dtl['id']); ?>"  class="<?php echo $cls; ?>">
                                                    
                                                    <span> <?php echo $btn_str; ?> </span>
                                                </a>
                                                
                                            </div>
                                            </td>
                                        </tr>
                                      <?php  $i++;}}else{?>
                                                <tr><td colspan="7">No data found</td></tr>
                                      <?php } ?>
                                        
                                        
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
