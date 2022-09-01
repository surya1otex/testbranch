<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-6">
                <div class="block-header">
                    <h4>PROJECT APPROVAL LIST</h4>
                    <span style=" color: red;"><?php echo $this->session->flashdata('message'); ?></span>
                </div>
            </div>
            <div class="col-md-6">

            </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        
                        <div class="body table-responsive">
                            <div class="">
                                <table <?php  echo (!empty($project_deatail)) ?  'id="project_approval"' : '';  ?> class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sl No</th>
                                            <th> Project Name </th>
                                            <th> Category </th>
                                            <th>Area</th>
                                            <!--<th>Requester Name</th>-->
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php if(!empty($project_deatail)){
                                               $i=1;
                                               foreach($project_deatail as $pro_dtl){
                                            $project_type= $CI->project_type($pro_dtl['project_type']);
                                            $project_area= $CI->project_area($pro_dtl['project_area']);

                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                            <a href="<?php echo base_url();?>Projectdashboard/project_dashboard?project_id=<?php echo base64_encode($pro_dtl['id']);?>">
                                            <span class="ntip"><?php echo $pro_dtl['project_name']?>
                                            <span class="ntiptext">Click to view the project reports</span>
                                            </span>
                                            </a>
                                            
                                            </td>
                                            <td><?php echo !empty($pro_dtl['project_type']) ? $project_type[0]['project_type'] : "--"?></td>
                                            <td><?php echo !empty($pro_dtl['project_area']) ? $project_area[0]['name']: "--"?></td>
                                            
                                           <td>
                                               <?php if( $pro_dtl['approval_status'] == 'N' ||  $pro_dtl['approval_status'] == 'P'  ){?>
                                                <a href="<?php echo site_url(); ?>/Project/project_initiation?project_id=<?php echo base64_encode($pro_dtl['id']); ?>" class="m-r-10 col-black"> <i class="fas fa-edit"></i> </a>
                                               <?php } ?>
                                               <?php if( $pro_dtl['approval_status'] == 'P'){ ?>
                                                <a href="<?php echo site_url();?>/Project/project_approval?request_id==<?php echo base64_encode($pro_dtl['PA_id']);?>" class="btn btn-success waves-effect approveSt" title="Approve"><i class="fa fa-check" aria-hidden="true"></i>Approve</a>
                                                <a href="<?php echo site_url();?>/Project/project_reject?request_id=<?php echo base64_encode($pro_dtl['PA_id']);?>" class="btn btn-danger waves-effect rejectSt" title="Reject"><i class="fa fa-times" aria-hidden="true"></i>Reject</a>
                                               <?php }else if( $pro_dtl['approval_status'] == 'Y' ){ ?>
                                                   <span class="label label-success">Approved</span>
                                               <?php } else if( $pro_dtl['approval_status'] == 'N') {?>
                                                   <span class="label label-warning">Rejected</span>
                                               <?php } ?>

                                           </td>
                                            <td>
                                                <button type="button" class="btn bg-light-green waves-effect" data-toggle="modal" data-target="#exampleModal" onclick="get_reject_history_details('<?php echo $pro_dtl['id']; ?>')">
                                                    <i class="material-icons">chat</i>
                                                </button>
                                            </td>
                                        </tr>
                                      <?php $i++;}}else{?>
                                                <tr><td colspan="6">No data found</td></tr>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="max-height: 400px; overflow: auto;"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
    function get_reject_history_details( project_id ){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url();?>/project/get_project_history",
            data: {project_id: project_id},
            success: function(data) {
                $('.modal-body').html(data);
            }
        });
    }
            //datatable//
            $(function() {
			
            $('#project_approval').DataTable({
			responsive: true
			});
         
        })
        </script>