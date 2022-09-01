<?php
$CI =& get_instance();
//echo "<pre>"; print_r($tehsil_detail_edit);  die;
?>
<section class="content">
    <div class="container-fluid">
        <div class="col-md-6">
            <div class="block-header">
                <?php $this->session->flashdata('message'); ?>
                <h4>Tehsil Master Management</h4>
                <div style=" color: red;"><?php echo $this->session->flashdata('message'); ?></div>
            </div>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <div class="card">
                    <div class="header">
                        <h2>Add a Tehsil</h2>
                    </div>
                    <div class="body">
                        <?php echo form_open('Master/add_tehsil',array('name'=> 'add_tehsil','id'=>'add_tehsil')); ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                <tr>
                                    <!-- <th>AOC Component Name </th>-->
                                    <th>Tehsil Name<span style="color: red;">*</span> </th>
                                    <th>District Name<span style="color: red;">*</span> </th>
                                    <th>Division Name<span style="color: red;">*</span> </th>
                                    <th>Status<span style="color: red;">*</span> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                <?php //<pre>"; print_r($division_detail_edit);  ?>
                                    <td>
                                        <input type="hidden" name="tehsil_id" value="<?php echo base64_encode($tehsil_id); ?>">

                                        <input type="text" class="form-control" placeholder="Name" required="" name="tahsil_name" value="<?php if(!empty($tehsil_detail_edit[0]['tahsil_name'])){echo $tehsil_detail_edit[0]['tahsil_name'];}else{echo "";}?>"/>
                                    </td>

                                    <td class="focused">
                                        <select class="form-control show-tick" id="district_id" name="district_id" required="">
                                            <option value="">Choose an District</option>
                                            <?php foreach ($ar_dist_details as $dist){ ?>
                                                <option value="<?php echo $dist['id']; ?>"
                                                    <?php if(!empty($tehsil_detail_edit) &&($tehsil_detail_edit[0]['district_id']==$dist['id'])){echo "selected";}?>><?php echo $dist['district_name']; ?></option>

                                            <?php }?>

                                        </select>

                                    </td>
                                    <td class="focused">
                                        <select class="form-control show-tick" name="division_id" id="division_id"required="">
                                          

                                        </select>

                                    </td>
                                    <td>
                                        <select class="form-control show-tick" name="status" required="">
                                            <option value="Y" <?php if(!empty($tehsil_detail_edit) &&($tehsil_detail_edit[0]['status']=="Y")){echo "selected";}?>>Active</option>
                                            <option value="N" <?php if(!empty($tehsil_detail_edit) &&($tehsil_detail_edit[0]['status']=="N")){echo "selected";}?>>Inactive</option>
                                        </select>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">

                                <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="card">
                    <div class="body">
                        <div class="table-responsive" style="overflow-x: hidden;">
                            <table class="table table-bordered table-striped table-hover js-basic-example-unit-master dataTable">
                                <thead>
                                <tr>
                                    <th style="text-align: center; vertical-align: middle;">Sl No</th>
                                    <th style="text-align: center; vertical-align: middle;">Tehsil Name</th>
                                    <th style="text-align: center; vertical-align: middle;">District Name</th>
                                    <th style="text-align: center; vertical-align: middle;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if(!empty($ar_dist_details)){
                                    $i=1;
                                    foreach($ar_destination_details as $unit_details){
                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $unit_details['tahsil_name'];?></td>
                                            <td><?php echo $unit_details['district_name'];?></td>
                                            <td style="text-align: center; vertical-align: middle;">
                                                <a href="<?php echo site_url(); ?>/Master/tehsil?tehsil_id=<?php echo base64_encode($unit_details['id']); ?>" class="m-r-10 col-black"> <i title="Edit Item" class="fas fa-edit"></i> </a>

                                                &nbsp;&nbsp;&nbsp;
                                                <?php if($unit_details['status']=='Y'){?>
                                                    <i title="Current Status: Active" class="fas fa-check col-green"></i>
                                                <?php }else{ ?>
                                                    <i title="Current Status: Inactive" class="fas fa-times col-red"></i>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                    ?>

                                <?php }else{?>
                                    <tr>
                                        <td colspan="3">No Record Available</td>
                                    </tr>
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
<script>
$(document).ready(function(){

	var distID = $('#district_id').val();
	var tehsilDIVId = ("<?php if(!empty($tehsil_detail_edit[0]['division_id'])){ echo $tehsil_detail_edit[0]['division_id'];} ?>");
	//alert(collegeStateId);
	view_division(distID,tehsilDIVId);
	
		
	
	
});


	
	$("#district_id").change(function(){
		//alert($(this).val());
		var value = $(this).val();
		if (value != "")
		{
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>Master/getdivisionList",
		datatype : 'json',
		data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","district_id": $(this).val() },
		
		success: function(data){
			
			
			
														var parsed_data = JSON.parse(data);
														//alert(parsed_data);
														$("#division_id").empty();
														
													    $val_selec ='';
														var listItems= "";
										//alert(parsed_data.all_div.length);
										if(parsed_data.all_div.length > 0)
										{
										//$("#StateID").append("<option  value=''>All</option>");
															 for (var i = 0; i < parsed_data.all_div.length; i++)
                                      {
                                     
										$("#division_id").append("<option  value='" + parsed_data.all_div[i].id  + "'>" + parsed_data.all_div[i].	division_name + "</option>");
										
										  $val_selec ='';
                                      }	
										}
										else
										{
										$("#division_id").append("<option  value=''>" +'Select District' + "</option>");
										
										  $val_selec ='';	
										}
															
														
			}
		});
		}
		else
		{
			
			$('#division_id option').prependTo('<option value=""> Select District</option>');
		}
	});

		function view_division(dist_id,div_ID){
		//alert(div_ID);
		
		var value = dist_id;
		if (value != "")
		{
		$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>Master/getdivisionList",
		datatype : 'json',
		//data:'lodgeDesID='+$(this).val(),
		data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>","district_id": dist_id },
		
		success: function(data){
			
			
			
														var parsed_data = JSON.parse(data);
														//alert(parsed_data);
														$("#division_id").empty();
														
													    $val_selec ='';
														var listItems= "";
										//alert(parsed_data.all_data.length);
										if(parsed_data.all_div.length > 0)
										{
										//$("#StateID").append("<option  value=''>All</option>");
										
															 for (var i = 0; i < parsed_data.all_div.length; i++)
                                      {
										  $Sval = parsed_data.all_div[i].id;
										  $STval = div_ID;
										 // alert($Sval);
										  //alert($STval);
										  var val_selected="";
										  if ($Sval == $STval){
											 val_selected =  "selected" ;  
										   //alert("1");
										  }
										  
										  <?php 
										  //$val_selected = '';
										  /*if ($Sval == $STval) {
										   $val_selected =  'selected';
										    }*/ ?>
										  
                                     
										$("#division_id").append("<option  "+ val_selected +" value='" + parsed_data.all_div[i].id  + "'  >" + parsed_data.all_div[i].	division_name + "</option>");
										
										  $val_selec ='';
                                      }	
										}
										else
										{
										$("#division_id").append("<option  value=''>" +'Select District' + "</option>");
										
										  $val_selec ='';	
										}
															
														
			}
		});
		}
		else
		{
			
			$('#division_id option').prependTo('<option value=""> Select District</option>');
		}
		
	}

</script>