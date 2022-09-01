<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>Project List</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>

            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body table-responsive">
                            <div class="">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable"  <?php echo !empty($project_deatail) ? 'id="project_list"' : ''; ?>>
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th>Project Name</th>
                                            <th>Category </th>
                                            <th>Area</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                                $project_area= $CI->project_area($pro_dtl['project_area']);
                                                $project_type= $CI->project_type($pro_dtl['project_type']);
                                                $project_id = $pro_dtl['id'];
                                                $pending_cnt = $CI->project_summary_count_data($project_id);
                                                $approved_cnt = $CI->project_count_data($project_id,'status','Y');
                                                $reject_cnt = $CI->project_count_data($project_id,'status','N');
                                            if($pending_cnt > 0 || $approved_cnt > 0 || $reject_cnt > 0){
                                                
                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            
                                            <td><a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?><span class="ntiptext">Click to view the project reports</span>
                                        </span></a></td>
                                            <td><?php echo $project_type[0]['project_type']?></td>
                                            <td><?php echo $project_area[0]['name']?></td>
                                            <td>
                                                <div class="notification">
                                                <a href="<?php echo base_url(); ?>projectVisitReport/visit_report?project_id=<?php echo base64_encode($pro_dtl['id']); ?>"  class="btn bg-blue waves-effect">
                                                    <i class="material-icons col-black">visibility</i>
                                                    <span> View Visit Report </span>
                                                </a>
                                                <?php if($pending_cnt > 0){ ?>
                                                <span class="label-count2 bg-orange"><?php echo $pending_cnt; ?></span>
                                            <?php } ?>
                                            </div>
                                            <?php if($approved_cnt > 0){ ?>
                                            <span class="label label-success"><?php echo $approved_cnt; ?></span>
                                        <?php } 
                                        if($reject_cnt > 0){ ?>
                                            <span class="label label-danger"><?php echo $reject_cnt; ?></span>
                                        <?php } ?>
                                            </td>
                                        </tr>
                                      <?php  $i++; } }}else{?>
                                                <tr><td colspan="5">No data found</td></tr>
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
