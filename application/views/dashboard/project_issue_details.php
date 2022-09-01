
<link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css">
<section class="content">
        <div class="container-fluid">
           <div class="col-md-12">
				<div class="block-header">
					<h4>Issue List</h4>
				</div>
            </div>

      <!--  <?php include("include/project_information.php");?>  -->
              <div class="row clearfix">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="btn-elm">
                          <?php
                             if($issues[0]->status == 'N') { ?>
                               <a onclick="project_summary_list_cnt('Open Issue');" class="btn btn-primary backbutton">Back To Open Issue</a>
                             <?php } 
                             if($issues[0]->status == 'Y') { ?>
                               <a onclick="project_summary_list_cnt('Closed Issue');" class="btn btn-primary backbutton">Back To Closed Issue</a>
                             <?php } ?>
                    </div>
                        <div class="body">
                            <div class="">
                                
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td>Project Details</td>
                                            <td><?php echo $issues[0]->projectname ?></td>
                                            
                                        </tr>

                                    </tbody>
                                </table>

<!--                                    <?php
                                   //if(is_numeric($project_id)){
                                     // project_info($project_id);
                                    //}
                                  ?> -->
                                <table id="all_project" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Issue Description</th>
                                            <th>Action Taken</th>
                                            <th>Status</th>
                                            <th>Updated By</th>
                                            <th>Updated Date</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                      
                                        $slno = 1;
                                      foreach($issues as $issue) { ?>

                                            <tr>
                                                <td><?php echo $slno; ?></td>
                                                <td><?php echo $issue->issuename ?></td>
                                                <td><?php echo $issue->actiontaken ?></td>
                                                <td><?php echo $issue->status == "Y" ? Closed : Open ?></td> 
                                                <td><?php echo $issue->createdby ?></td>


                                                <td><?php $dt = new DateTime($issue->date); echo $dt->format('jS M Y'); ?></td>
                                                
                                            </tr>
                                        <?php  $slno++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

        </div>
    </section>
<style type="text/css">
    .btn-elm {
    text-align: center;
    padding-top: 20px;
}
.btn-elm .backbutton {
    padding: 7px 20px;
    font-size: 17px !important;
    font-weight: 600;
}
</style>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url();?>assets/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.redirect.js"></script>
<script type="text/javascript">
        //datatable//
        $(function() {

        $('#all_project').DataTable({
        responsive: true,
        bLengthChange: false

        });

    })
</script>
          <script type="text/javascript">
        function project_summary_list_cnt(type){
            
                //var project_group_id = $('#project_group_id').val();
                //var project_category_id = $('#project_category_id').val();
                //var project_area_id = $('#project_area_id').val();
                //var project_wing_id = $('#project_wing_id').val();
                //var project_division_id = $('#project_division_id').val();
               
                $.redirect("<?php echo base_url('project_summary_list'); ?>", {'project_list_type': type},"POST");         
          }
          </script>