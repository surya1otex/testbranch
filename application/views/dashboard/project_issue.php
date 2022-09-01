<?php $CI =& get_instance();?>

<div class="row clearfix">
                    <!-- Task Info -->
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="card">
                            <div class="header">
                                <h2>Project Issue Status </h2>
                            </div>
                            <div class="body table-responsive">
                                <div class="">
                                <?php
                                
                                
                                ?>
                                    <table <?php echo !empty($project_details_ar) ? 'id="projectissue"' : ''; ?>  class="table table-hover dashboard-task-infos" id="prog">
                                        <thead>
                                                <tr>
                                                <th width="200">Project Name</th>
                                                <th width="180">Category</th>
                                                <th width="180">Start Date</th>
                                                <th width="180">End Date</th>
                                                <th width="180">Closed Issues</th>
                                                <th width="180">Open Issues</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(!empty($project_details_ar)){
                                                
                                                
                                                foreach ($project_details_ar as $key => $value) {
                                                    $project_id = $value['project_id'];
                                                    $id = $value['id'];
                                                    $project_name = $value['project_name'];
                                                    $issueopen = $value['closeissue'];
                                                    $openissue = $value['openissue'];
                                                    $category = $value['category'];
                                                    $start_date = date_create($value['start_date']);
                                                    $start_date = date_format($start_date,"F d Y");
                                                    $end_date = date_create($value['end_date']);
                                                    $end_date = date_format($end_date,"F d Y");
                                                                                                                                         
                                          ?>
                                                    <tr>
                                                        <td>
                                                           
                                                             <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($project_id); ?>">
                                                                <span class="ntip"> <?php echo $project_name; ?><span class="ntiptext">Click to view the project dashboard</span>
                                                            </span></a>
                                                        </td>

                                                       <!-- <td><?php echo $issueopen; ?></td> -->
                                                        <td><?php echo $category; ?></td>

                                                        <td><?php echo $start_date; ?></td>
                                                        <td><?php echo $end_date; ?></td>
                                                         <td>
                                                            <a href="<?php echo base_url();?>Projectdashboard/issue_details?project_id=<?php echo base64_encode($id);?>">
                                                            <span class="ntip"><?php echo $issueopen; ?>
                                                            
                                                            </span>
                                                            </a>
                                                          </td> 
                                                        <td>
                                                            <a href="<?php echo base_url();?>Projectdashboard/issue_details_open?project_id=<?php echo base64_encode($id);?>">
                                                            <span class="ntip"><?php echo $openissue; ?>
                                                            
                                                            </span>
                                                            </a>
                                                          </td> 
                                                       
                                                       
                                                       
                                                        
                                                        
                                                       
                                                       
                                                    </tr>
                                                      <?php
                                                            }
                                                        } else {
                                                    ?>
                                                    <tr> <td colspan="5">No Record Found!</td></tr>
                                                    <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- #END# Task Info -->
                </div>
                
<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#projectissue').DataTable({
            responsive: true
            });
         
        })
</script>