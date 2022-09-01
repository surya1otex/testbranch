<!-- Bootstrap Select Css -->
<link href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

                                           <select class="form-control show-tick" id="project_destination_id">
                                                <option value="0">Default All</option>
                                                <?php foreach ($destination_list as $key => $valD ){?>
                                                    <option value="<?php echo $valD['id']; ?>"><?php echo $valD['name']; ?></option>
                                                <?php } ?>
                                            </select>
 
<!-- Select Plugin Js -->
<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>  


<script type="text/javascript">
     $('#project_destination_id').change(function(){
      fetchorgsummaryData();
      fetchproject_overview();
      financial_overview();
      vendor_overview();
      project_progress();
      fetchSOFData();
    });
</script>                                     