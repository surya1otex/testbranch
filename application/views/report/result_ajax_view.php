<style type="text/css">
  .hr2 {
        margin-top: 4px;
    margin-bottom: 8px;
    border: 0;
     border-top: 2px solid #eee; 
    height: 0;
    -webkit-box-sizing: content-box;
    -moz-box-sizing: content-box;
    box-sizing: content-box;
    display: block;
    unicode-bidi: isolate;
    margin-block-start: 0.5em;
    margin-block-end: 0.5em;
    margin-inline-start: auto;
    margin-inline-end: auto;
    overflow: hidden;

}
</style>

<?php
$CI =& get_instance();
//echo "project_id: ".$project_id; die();
//echo "<pre>"; print_r($result); die();
?>
 <?php
    $imtype = implode(',', $type);
    $en_project_id =base64_encode($project_id);
    ?>
<div class="col-md-2 col-md-offset-9 text-center" style="margin-top: 0px;margin-bottom: 15px !important;">
  <a href="<?php echo site_url().'/Report/generate_pdf?project_id='.$en_project_id.'&type='.$imtype; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>
    <?php
    //$source_of_fund = $CI->get_source_of_fund_data($project_id);
    //$tender_history_data = $CI->get_project_retender_data($project_id);
    // print_r($type);
    // die();
    //Chcek Project Information
    if(in_array('ProjectInformetion', $type) || in_array('All', $type)){
    ?>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Project Basic Information </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project's name </td>
                                        <td colspan="3"><?php echo !empty($project_detail[0]['project_name']) ? $project_detail[0]['project_name'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Projects sector</td>
                                        <td><?php echo !empty($project_detail[0]['sector_name']) ? $project_detail[0]['sector_name'] : "NA"; ?></td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Project’s id</td>
                                        <td><?php echo !empty($project_detail[0]['project_code']) ? $project_detail[0]['project_code'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project type </td>
                                        <td><?php echo !empty($project_detail[0]['ptype_name']) ? $project_detail[0]['ptype_name'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">flag</i> Project’s in-charge (Approver)</td>
                                        <td><?php echo !empty($project_detail[0]['firstname']) ? $project_detail[0]['firstname']." ".$project_detail[0]['lastname'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Approve date </td>
                                        <td><?php 
                                        if (!empty ($project_detail[0]['aa_date'])) {
                                         $approve_date = new DateTime($project_detail[0]['aa_date']); 
                                        
                                        
                                        echo $approve_date->format('jS M Y');} else { echo "--"; } ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> Project’s group </td>
                                        <td><?php echo !empty($project_detail[0]['groupName']) ? $project_detail[0]['groupName'] : "NA"; ?></td>
                                        
            
                                    </tr>
            
                                    <tr>
                                       
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">flag</i> Project’s area </td>
            
                                                        <td> <?php echo !empty($project_detail[0]['area_name']) ? $project_detail[0]['area_name'] : "NA"; ?></td>
                                                        <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i>Project’s location</td>
                                        <td><?php echo !empty($project_detail[0]['dest_name']) ? $project_detail[0]['dest_name'] : "NA"; ?></td>
                                        
            
                                    </tr>
                                    <tr>
                                        
                                         <td><i class="material-icons" style="position: relative;top: 8px;">₹</i> Estimated project cost  (₹)</td>
                                        <td><?php echo !empty($project_detail[0]['estimate_total_cost']) ? $project_detail[0]['estimate_total_cost'] : "NA"; ?></td>
                                        
            
                                    </tr>
                                                            </tbody>
                                </table>


                </div>

              </div>

                
            </div>
          </div>
        </div>
      </div>

      <!-- End Project Details -->


      <!-- Start Project Preparation -->
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Identified Stackholders </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

               <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <!-- <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project's Name </td>
                                        <td colspan="3">Panchayat Bhawan Building development</td>
                                    </tr> -->
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Consultant id </td>
                                        <td><?php echo !empty($project_preparation[0]['consultant_id']) ? $project_preparation[0]['consultant_id'] : "NA"; ?></td>
                                        <td width="230px">  <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Consultant name </td>
                                        <td><?php echo !empty($project_preparation[0]['consultant_name']) ? $project_preparation[0]['consultant_name'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">work</i> Consultant designation</td>
                                        <td><?php echo !empty($project_preparation[0]['designation']) ? $project_preparation[0]['designation'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">flag</i> Consultant project number</td>
                                        <td><?php echo !empty($project_preparation[0]['consulant_project_no']) ? $project_preparation[0]['consulant_project_no'] : "NA"; ?></td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i> Administrative approval cost  (₹)</td>
                                        <td><?php echo !empty($project_preparation[0]['approval_cost']) ? $project_preparation[0]['approval_cost'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> File number </td>
                                        <td><?php echo !empty($project_preparation[0]['file_number']) ? $project_preparation[0]['file_number'] : "NA"; ?></td>
                                        
            
                                    </tr>
            
                                    <tr>
                                       
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> AA Date</td>
            
                                                        <td> <?php 
                                        if (!empty ($project_preparation[0]['approval_date'])) {
                                         $aa_date = new DateTime($project_preparation[0]['approval_date']); 
                                        
                                        
                                        echo $aa_date->format('jS M Y');} else { echo "--"; } ?></td>
                                                         <td colspan="2" style="text-align: center;">
                                                                            <table width="100%">
                                                <tbody><tr class="bg-blue-grey">
                                                    <td colspan="2"><i class="material-icons" style="position: relative;top: 8px;">₹</i> Source of fFund </td>
                                                </tr>
                                                  <?php 
                                       //print_r($sof_preparation);
                                         if(!empty($sof_preparation)){ 
                                               $i=1;
                                               foreach($sof_preparation as $sofdata){
                                                
                                      ?>
                                                                                    <tr>
                                                    <td><?php echo !empty($sofdata['sof_name']) ? $sofdata['sof_name'] : "--"?></td>
                                                    <td> (₹) <?php echo !empty($sofdata['amount']) ? $sofdata['amount'] : "--"?></td>
                                                </tr>
                                                
                                                <?php } } else { ?>
                                                                                    <tr>
                                                    <td colspan="2">No record Found</td>
                                                </tr>
                                                <?php } ?>
                                                                                    
                                                                                    
                                                                                </tbody></table>
                                                                    </td>
            
                                                                    
                                        
            
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">settings</i> Project approvers</td>
                                        <td><?php echo !empty($project_preparation[0]['firstname']) ? $project_preparation[0]['firstname']." ".$project_preparation[0]['lastname'] : "NA"; ?></td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">list</i> Remarks  </td>
                                        <td><?php echo !empty($project_preparation[0]['remarks']) ? $project_preparation[0]['remarks'] : "NA"; ?></td>
                                        
            
                                    </tr>
                                    
                                                            </tbody>
                                </table>
                                
                                <?php
                                
                                       if(!empty($project_userinfo_preparation)){ ?>
                                
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                     <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">all_out</i> User type </td>
                                        <td>  <i class="material-icons" style="position: relative;top: 8px;">account_box</i>User name </td>
                                    </tr>
                                      <?php 
                                      // print_r($approved_project);
                                               $i=1;
                                               foreach($project_userinfo_preparation as $pro_dtl){
                                                
                                      ?>
                                   
                                    <tr>
                                        <td><?php echo !empty($pro_dtl['designation']) ? $pro_dtl['designation'] : "NA"; ?></td>
                                        <td><?php echo !empty($pro_dtl['firstname']) ? $pro_dtl['firstname']." ".$pro_dtl['lastname'] : "NA"; ?></td>
                                    </tr>
                                    
                                      <?php $i++;} ?>
                                        
                                    
                                    
                                    
                                                            </tbody>
                                </table>
                                <?php } ?>
        
                </div>

              </div>

                
            </div>
          </div>
        </div>
      </div>

      <!-- END Project Preparation -->

      <!-- Start Pre tender -->

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Pre Tender </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

               <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                            <tr>
                                <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">chrome_reader_mode</i>  Tender call number </td>
                                <td colspan="3"><?php echo !empty($project_pre_tender[0]['tender_call_no']) ? $project_pre_tender[0]['tender_call_no'] : "NA"; ?></td>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval</td>
            
                                                    <td> <?php 
                                        if (!empty ($project_pre_tender[0]['tender_approval_date'])) {
                                         $approve_date = new DateTime($project_pre_tender[0]['tender_approval_date']); 
                                        
                                        
                                        echo $approve_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                
                                <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Tender document approved </td>
                                <td>
                                    <?php if (!empty($project_pre_tender[0]['tender_document_approved'] && $project_pre_tender[0]['tender_document_approved']=="Y")){
                                        echo $tdoc_app =  "Yes"; } else {  echo $tdoc_app =  "No";  } ?>
                                </td>
                            </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP publish date </td>
            
                                                        <td> <?php 
                                        if (!empty ($project_pre_tender[0]['rfp_publishing_date'])) {
                                         $publish_date = new DateTime($project_pre_tender[0]['rfp_publishing_date']); 
                                        
                                        
                                        echo $publish_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP closing date</td>
            
                                                        <td> <?php 
                                        if (!empty ($project_pre_tender[0]['rfp_closing_date'])) {
                                         $closing_date = new DateTime($project_pre_tender[0]['rfp_closing_date']); 
                                        
                                        
                                        echo $closing_date->format('jS M Y');} else { echo "--"; } ?>  </td>
                                                </tr>
                            <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Re-tender </td>
                                <td>
                                  <?php if (!empty($project_pre_tender[0]['re_tender_status'] && $project_pre_tender[0]['re_tender_status']=="Y")){
                                        echo $retender =  "Yes"; } else {  echo $retender =  "No";  } ?>
                                  <?php // echo !empty($project_pre_tender[0]['re_tender_status']) ? $project_pre_tender[0]['re_tender_status'] : "NA"; ?>
                                </td>
                                 <?php if (!empty($project_pre_tender[0]['re_tender_status'] && $project_pre_tender[0]['re_tender_status']=="Y")){
                                         ?>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Reason for re-tendering</td>
                                <td><?php echo !empty($project_pre_tender[0]['remarks_for_retender']) ? $project_pre_tender[0]['remarks_for_retender'] : "NA"; ?></td>
                                <?php }  ?>
                                
                            </tr>
                            <tr>
                                <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Remarks </td>
                                <td colspan="3"><?php echo !empty($project_pre_tender[0]['remarks']) ? $project_pre_tender[0]['remarks'] : "NA"; ?></td>
                                <!--<td>&nbsp</td>
                                <td>&nbsp</td>-->
                            </tr>
            
            
            
                            </tbody>
                                </table>
        
                </div>

              </div>

                
            </div>
          </div>
        </div>
      </div>

     <!--  End Pre Tender -->

     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Tender </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    
                                    <tr>
                                                                  <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final RFP publish date</td>
                                                                        <td><?php 
                                        if (!empty ($project_tender[0]['final_date_rfp_publish'])) {
                                         $rfppublish_date = new DateTime($project_tender[0]['final_date_rfp_publish']); 
                                        
                                        
                                        echo $rfppublish_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Final RFP closing date </td>
                                                                        <td> <?php 
                                        if (!empty ($project_tender[0]['final_date_rfp_publish'])) {
                                         $rfpclose_date = new DateTime($project_tender[0]['final_date_rfp_publish']); 
                                        
                                        
                                        echo $rfpclose_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                        
                                    </tr>
                                    <tr>
            
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Technical bid opening date</td>
                                                                        <td><?php 
                                        if (!empty ($project_tender[0]['tech_bid_opening_date'])) {
                                         $tbid_open_date = new DateTime($project_tender[0]['tech_bid_opening_date']); 
                                        
                                        
                                        echo $tbid_open_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                    <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Financial bid opening date</td>
            
                                                                        <td> <?php 
                                        if (!empty ($project_tender[0]['finance_bid_opening_date'])) {
                                         $fbid_open_date = new DateTime($project_tender[0]['finance_bid_opening_date']); 
                                        
                                        
                                        echo $fbid_open_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                </tr>
                                    <tr>
            
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Tender LY issue date</td>
                                                                    <td> <?php 
                                        if (!empty ($project_tender[0]['tender_ly_date'])) {
                                         $Tissue_date = new DateTime($project_tender[0]['tender_ly_date']); 
                                        
                                        
                                        echo $Tissue_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                    <td></td>
                                        <td></td>
                                    </tr>
            
            
                                    </tbody>
                                </table>


                </div>

              </div>

                
            </div>
          </div>
        </div>
      </div>

      <!-- End Project Tender -->




    <?php 
    if(!empty($tender_histroy)){
    ?>
     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Tender History</h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">
                <?php
                foreach ($tender_histroy as $key => $history) {
               
                ?>
                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <tbody>
                        <tr>
                            <td><i class="material-icons" style="position: relative;top: 8px;">chrome_reader_mode</i> Tender call number </td>
                            <td><?php echo !empty($history['tender_call_no']) ? $history['tender_call_no'] : 'NA'; ?></td>

                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval </td>
                             <?php
                            if(!empty($history['tender_document_approval_date']) && $history['tender_document_approval_date'] != '0000-00-00' ){
                            $date = date_create($history['tender_document_approval_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                        </tr>

                        <tr>
                            <td><i class="material-icons" style="position: relative;top: 8px;">local_offer</i> Project's Name  </td>
                            <td colspan="3"><?php echo $history['project_name']; ?></td>

                            
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">my_location</i> Projects sector</td>
                                                            
                            <?php $project_sector = $CI->project_sector($history['project_sector']); ?>
                            <td> <?php echo $project_sector[0]['name']; ?> </td> 
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">dashboard</i> Projects group</td>
                            <?php $project_group = $CI->project_group($history['project_group']); ?>
                            <td> <?php echo $project_group[0]['name']; ?> </td>
                        </tr>

                        <tr>
                            <td><i class="material-icons" style="position: relative;top: 8px;">flag</i> Projects area</td>
                            <?php $project_area = $CI->project_area($history['project_area']); ?>
                            <td> <?php echo $project_area[0]['name']; ?> </td>
        
                            <td><i class="material-icons" style="position: relative;top: 8px;">location_on</i> Project destination</td>
                            <?php $project_destination = $CI->project_destination($history['project_destination']); ?>
                            <td> <?php echo $project_destination[0]['name']; ?> </td>
                        </tr>
                        <tr>
                                    <td><i class="material-icons" style="position: relative;top: 8px;">code</i> Projects code </td>
                                    <td><?php echo $history['project_code']?></td>
                                                <td><i class="material-icons" style="position: relative;top: 8px;">₹</i> AA amount  (₹)</td>
                                    <td><?php echo $history['estimate_total_cost']?></td>
    
                        </tr>
                         <?php $project_type = $CI->project_type($history['project_type']); ?>
            
                        <tr>
                                                            <td><i class="material-icons" style="position: relative;top: 8px;">settings</i> Projects type</td>
                            <td><?php echo  $project_type[0]['project_type']; ?></td>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">folder</i> File number </td>
                            <td><?php echo $history['file_no']?></td>
                        </tr>
                        <tr>
                                <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  AA date</td>
                            <?php
                                if(!empty($history['aa_date']) && $history['aa_date'] != '0000-00-00' ){
                            $date = date_create($history['aa_date']); ?>
                            <td> <?php echo date_format($date,"F d Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                                                                        <td></td>
                                        <td></td>
                         </tr>

                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Date of tender approval</td>
                            <?php
                            if(!empty($tender_history->tender_document_approval_date) && $tender_history->tender_document_approval_date != '0000-00-00' ){
                                $date = date_create($tender_history->tender_document_approval_date); ?>
                                <td> <?php echo date_format($date,"d M, Y"); ?> </td>
                            <?php }else{ ?>
                                <td> <?php echo "NA"; ?> </td>
                            <?php } ?>
                            <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Tender document approved </td>
                            <td> <?php if( $tender_history->tender_document_approved == 'Y'){
                                    echo "Yes";
                                } else if( $tender_history->tender_document_approved == 'N'){
                                    echo "No";
                                }else{
                                    echo "NA";
                                } ?> </td>
                        </tr>

                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> RFP publish date </td>
                                                                                <?php
                                if(!empty($history['rfp_publishing_date']) && $history['rfp_publishing_date'] != '0000-00-00' ){
                                    $date = date_create($history['rfp_publishing_dates']); ?>
                                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
                                    <td> <?php echo "NA"; ?> </td>
                                <?php } ?>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">date_range</i>  RFP closing date</td>
                                                                               <?php
                                if(!empty($history['rfp_closing_date']) && $history['rfp_closing_date'] != '0000-00-00' ){
                                    $date = date_create($history['rfp_closing_date']); ?>
                                    <td> <?php echo date_format($date,"F d Y"); ?> </td>
                                <?php }else{ ?>
                                    <td> <?php echo "NA"; ?> </td>
                                <?php } ?>
                        </tr>

                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Re-tender </td>
                            <td>Yes</td>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">undo</i> Reason for re-tendering</td>
                            <td><?php echo $history['remarks_for_retender']; ?> </td>
                        </tr>
                        <tr>
                            <td> <i class="material-icons" style="position: relative;top: 8px;">beenhere</i> Remarks </td>
                            <td colspan="3"><?php echo $history['remarks_pre_tender']; ?></td>
                        </tr>
                        


                        </tbody>
                    </table>


                </div>
            <?php } ?>

              </div>

                
            </div>
          </div>
        </div>
      </div>

  <?php } ?>

      <!-- End Project Tender History -->


      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header">
            <h2>Agreement </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <tbody>
                                    <tr>
                                        <td width="230px"><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement date </td>
            
                                                                        <td colspan="3"> <?php 
                                        if (!empty ($project_agreement[0]['agreement_date'])) {
                                         $agreement_date = new DateTime($project_agreement[0]['agreement_date']); 
                                        
                                        
                                        echo $agreement_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                                                </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i> Agreement cost  (₹)</td>
            
                                        <td><?php echo !empty($project_agreement[0]['agreement_cost']) ? $project_agreement[0]['agreement_cost'] : "NA"; ?></td>
                                        <td width="230px"> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Agreement end date</td>
                                                                    <td><?php 
                                        if (!empty ($project_agreement[0]['agreement_end_date'])) {
                                         $agreement_end_date = new DateTime($project_agreement[0]['agreement_end_date']); 
                                        
                                        
                                        echo $agreement_end_date->format('jS M Y');} else { echo "--"; } ?> </td>
                                                                </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i>  Selected bidders name </td>
            
                                        <td> <?php echo !empty($project_agreement[0]['bidder_details']) ? $project_agreement[0]['bidder_details'] : "NA"; ?> </td>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">done_all</i> Selected bidders representative name</td>
            
                                        <td> <?php echo !empty($project_agreement[0]['representative_name']) ? $project_agreement[0]['representative_name'] : "NA"; ?> </td>
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">₹</i> BG amount  (₹)</td>
            
            
                                        <td>  <?php echo !empty($project_agreement[0]['bg_amount']) ? $project_agreement[0]['bg_amount'] : "NA"; ?>  </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> BG validity</td>
                                                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['bg_validity_date'])) {
                                         $bgvalidity_date = new DateTime($project_agreement[0]['bg_validity_date']); 
                                        
                                        
                                        echo $bgvalidity_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                        
                                    </tr>
                                    <tr>
                                        <td> <i class="material-icons" style="position: relative;top: 8px;">insert_drive_file</i> Other details of the bidder</td>
            
            
                                        <td> N/A </td>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project start date</td>
                                                                        <td> <?php 
                                        if (!empty ($project_agreement[0]['project_start_date'])) {
                                         $pstart_date = new DateTime($project_agreement[0]['project_start_date']); 
                                        
                                        
                                        echo $pstart_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                                                </tr>
                                    <tr>
                                        <td><i class="material-icons" style="position: relative;top: 8px;">date_range</i> Project end date</td>
                                                                    <td> <?php 
                                        if (!empty ($project_agreement[0]['project_end_date'])) {
                                         $pend_date = new DateTime($project_agreement[0]['project_end_date']); 
                                        
                                        
                                        echo $pend_date->format('jS M Y');} else { echo "--"; } ?>   </td>
                                                                    <td></td>
                                        <td></td>
            
            
                                    </tr>
            
                                    </tbody>
                                </table>


                </div>

              </div>

                
            </div>
          </div>
        </div>
      </div>
    <?php } ?>

    <!-- END Agreement Steps -->

    <?php
      if(in_array('ActivitySummary', $type) || in_array('All', $type)){
    // if (!empty($project_work_item_details_ar)) {
    // foreach ($project_work_item_details_ar as $key => $value) {
    //   $work_item_name = $value['work_item_name'];
      ?>

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header" style="background-color: #ccc !important;">
            <h2>  Project Milestone With Activities </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">

                <div class="table-responsive m-b-30">

                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr class="bg-blue-grey">
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Activities</th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;">Physical</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid #ddd !important;;">Completion Date</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle; border: 1px solid #ddd !important;;">Last Reported</th>
                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;">Weightage (%)</th>
                        <th style="text-align: center; vertical-align: middle;">Status</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php 
                             $i=1;
                             foreach($project_milestone as $milestone){
                               $milestone_id = $milestone['id'];
                            $milestone_activity = $CI->project_milestone_activity($milestone_id,$project_id);
                              
                      ?>
                      <tr style="text-align: center; vertical-align: middle;background-color: #cccccc52 !important;">
                        <td colspan="8"><h5><?php echo !empty($milestone['milestone']) ? $milestone['milestone'] : "NA"; ?></h5></td>
                        
                      </tr>
                      <?php
                      $c = 1;
                      if(!empty($milestone_activity)){
                        foreach ($milestone_activity as $activitydata) {

                          $activity_id = $activitydata['id'];
                     $progress_activity = $CI->project_progress_activity($milestone_id,$activity_id,$project_id); 
                         
                      ?>
                        <tr style="text-align: center; vertical-align: middle;">
                            <td><?php echo $c; ?></td>
                            <td><?php echo !empty($activitydata['particulars']) ? $activitydata['particulars'] : "NA"; ?></td>
                            <td><?php echo !empty($activitydata['weightage']) ? $activitydata['weightage'] : "NA"; ?></td>
                            <td>
                                     <?php if( $activitydata['completion_status'] == 'Y'){
                                          echo "Completed";
                                      } else if( $activitydata['completion_status'] == 'N'){
                                          echo "Pending";
                                      }else{
                                          echo "NA";
                                      } ?> 
                            </td>
                            <td> <?php 
                    if (!empty ($activitydata['end_date'])) {
                     $aa_date = new DateTime($activitydata['end_date']); 
                    
                    
                    echo $aa_date->format('jS M Y');} else { echo "--"; } ?>
                      
                    </td>
                    <td><?php 
                    if (!empty ($progress_activity[0]['reporting_date'])) {
                     $rp_date = new DateTime($progress_activity[0]['reporting_date']); 
                    
                    
                    echo $rp_date->format('jS M Y');} else { echo "--"; } ?></td>
                    </tr>

                    <?php $c++; } }else{ ?>
                      <tr style="text-align: center; vertical-align: middle;">
                       <td colspan="6">No Data Available</td>
                      </tr>

                    <?php }  ?>
                      <?php $i++; } ?>
                    </tbody>

                  </table>



                </div>
              </div>
            </div>
          </div>
        </div>
      </div>





  <?php } ?>

<!-- END ActivitySummary Steps -->


 <!-- VISITS LIST -->

      <?php
      if(in_array('VisitReportDetails', $type) || in_array('All', $type)){
      ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Mobile Visit Report Summary</h2>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-example1">
                            <thead>
                            
                            <tr class="bg-blue-grey">
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Sl No</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Dated</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Submitted By</th>
                        <th rowspan="2" style="text-align: center; vertical-align: middle;">Details</th>
                       
                        
                        <th colspan="3" style="text-align: center; vertical-align: middle;">Activities</th>
                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;">Total</th>
                        <th style="text-align: center; vertical-align: middle;">Pending</th>
                        <th style="text-align: center; vertical-align: middle;">Approved</th>
                      </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $progress_details = $CI->get_visit_report_progress_details($project_id);
                            // print_r($progress_details);
                            // die();
                            $sl = 1;
                            if(is_array($progress_details)){
                                foreach ($progress_details as $progress) {
                                    $newDateTime = date('d M, Y h:i A', strtotime($progress->timestamp));

                                    if(!empty($progress->visit_date) && $progress->visit_date != '0000-00-00'){
                                   $visitDateTime = date('d M, Y', strtotime($progress->visit_date));
                                 }else{
                                    $visitDateTime = 'NA';
                                 }


                                    if(!empty($progress->reporting_date) && $progress->reporting_date != '0000-00-00'){
                                   $reportingDateTime = date('d M, Y', strtotime($progress->reporting_date));
                                 }else{
                                    $reportingDateTime = 'NA';
                                 }
                                    
                                 
                                
                                
                                $pending_cnt = $CI->get_project_visit_pending_count($progress->project_id,$progress->id);
                                $approved_cnt = $CI->get_project_visit_approved_count($progress->project_id,$progress->id);
                                $total_cnt = $CI->get_project_visit_total_count($progress->project_id,$progress->id);

                                $project_work_item_id = $CI->getSpecificdata2_res('project_progress_update_log_details_triggering','project_id',$progress->project_id,'log_id',$progress->id,'project_work_item_id');
                                
                                $milestone = $CI->getSpecificdata_res('project_milestone', 'id', $project_work_item_id,'milestone');

                                $userDeatils = $CI->get_user_details_by_user_id($progress->user_id);
                              ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><b>Submitted on : </b><?php echo $newDateTime; ?><span class="hr2"></span><b>Visit Date : </b><?php echo $visitDateTime; ?><span class="hr2"></span><b>Reporting Date : </b> <?php echo $reportingDateTime; ?></td>
                                <td>  <?php if (!empty($user_details[0]['name'])) { echo $user_details[0]['name']; } else { echo $this->session->userdata('name'); } ?></td>
                                <td><b>Milestone : </b><?php echo $milestone; ?><span class="hr2"></span><b>Observation : </b><?php echo $progress->observation; ?><span class="hr2"></span><b>Recommendation : </b><?php echo $progress->observation; ?></td>
                                
                                <td><?php echo $total_cnt; ?> </td>
                                <td><?php echo $pending_cnt; ?> </td>
                                <td><?php echo $approved_cnt; ?> </td>
                                
                            </tr>
                        <?php $sl++;  } } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

      <?php } ?>
    <!-- #END# VISITS LIST-->






<!-- INVOICE SUMMERY -->
    <?php
      if(in_array('InvoiceCheck', $type) || in_array('All', $type)){
      ?>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>Invoice Summary</h2>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-example1">
                           
                            <thead>
                            
                              <tr class="bg-blue-grey">
                              <th style="text-align: center; vertical-align: middle;">Sl No</th>
                              <th style="text-align: center; vertical-align: middle;">Vendor Name</th>
                              <th style="text-align: center; vertical-align: middle;">Total Invoices</th>
                              <th style="text-align: center; vertical-align: middle;">Claimed (₹)</th>
                              <th style="text-align: center; vertical-align: middle;">Paid (₹)</th>
                              <th style="text-align: center; vertical-align: middle;">Due (₹)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $invoice_details = $CI->get_project_invoice_summery_details($project_id);
                            //print_r($progress_details);
                            $sl = 1;
                            if(is_array($invoice_details)){
                                foreach ($invoice_details as $inv) {
                               //$due = $CI->IND_money_format($inv->claimed_amount - $inv->paid_amount);
                               $due =$inv->claimed_amount - $inv->paid_amount;
                               $t_claim += $inv->claimed_amount;
                              $t_paid += $inv->paid_amount;
                              $t_due += $due;
                              ?>
                            <tr>
                                <td><?php echo $sl; ?></td>
                                <td><?php echo $inv->vendor_name; ?></td>
                                <td><?php echo $inv->total_invoice; ?></td>
                                <td style="text-align: right;"><?php echo $inv->claimed_amount; ?></td>
                                <td style="text-align: right;"><?php echo $inv->paid_amount; ?></td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $due) ?></td>
                                
                            </tr>
                        <?php $sl++;  } } ?>

                        <tr class="bg-blue-grey">
                              <td colspan="3" style="text-align: center; vertical-align: middle;">Total</td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $t_claim) ?></td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $t_paid) ?></td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $t_due) ?></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <!-- #END# INVOICE SUMMERY-->

    <!-- INVOICE DETAILS -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
          <div class="header" style="background-color: #ccc !important;">
            <h2> Invoice Details </h2>
          </div>
          <div class="body">
            <div class="section_clone">
              <div class="row clearfix cloneBox1">
                <?php
                $head_data = $CI->get_project_all_invoice_head_details($project_id);
                //print_r($head_data);
                  if(is_array($head_data)){
                    foreach ($head_data as $head) {
                    $invoice_id = $head->id;
                    $details_data = $CI->get_project_all_invoice_details($invoice_id);
                   
                ?>
                <div class="table-responsive m-b-30">
                  <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                    <thead>
                    <tr class="bg-blue-grey">
                        <th colspan="3" style="text-align: center; vertical-align: middle;"><?php echo $head->invoice_no; ?></th>
                        <th colspan="2" style="text-align: center; vertical-align: middle;"><?php echo date('F d Y', strtotime($head->invoice_date)); ?></th>

                      </tr>
                      <tr class="bg-blue-grey">
                        <th style="text-align: center; vertical-align: middle;">Head</th>
                        <th style="text-align: center; vertical-align: middle;">Description</th>
                        <th style="text-align: center; vertical-align: middle;">Claimed (₹)</th>
                        <th style="text-align: center; vertical-align: middle;">Paid (₹)</th>
                        <th style="text-align: center; vertical-align: middle;">Due (₹)</th>
                      </tr>
                    </thead>
                    <tbody>
                       <?php
                       if(is_array($details_data)){
                        foreach ($details_data as $dinvoice) {
                         $get_invoice_paid_amt = $CI->get_invoice_paid_amount($invoice_id,$dinvoice->major_head_id);
                         $due = $dinvoice->amount - $get_invoice_paid_amt;
                         $td_due += $due;
                         $td_paid += $get_invoice_paid_amt;
                         $td_claim += $dinvoice->amount;
                       ?>

                      <tr style="text-align: center; vertical-align: middle;">
                       <td><?php echo $dinvoice->major_head; ?></td>
                       <td><?php echo $dinvoice->details; ?></td>
                      <td style="text-align: right;"><?php echo $dinvoice->amount; ?></td>
                      <td style="text-align: right;"><?php echo $get_invoice_paid_amt; ?></td>
                      <td style="text-align: right;"><?php echo sprintf('%.2f', $due); ?></td>
                      </tr>
                    <?php } } ?>
                    <tr class="bg-blue-grey">
                              <td colspan="2" style="text-align: center; vertical-align: middle;">Total</td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $td_claim) ?></td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $td_paid) ?></td>
                                <td style="text-align: right;"><?php echo sprintf('%.2f', $td_due) ?></td>
                            </tr>

                    </tbody>

                  </table>
                    


                </div>
              <?php } } ?>


              </div>

                
            </div>
          </div>
        </div>
      </div>

    <?php } ?>
    <!-- #END# INVOICE DETAILS-->



   


    <div class="col-md-2 col-md-offset-5 text-center" style="margin-top: 0px;margin-bottom: 33px !important;">
  <a href="<?php echo base_url().'report/generate_pdf?project_id='.$en_project_id.'&type='.$imtype; ?>"  class="btn bg-red waves-effect"><i class="material-icons">print</i><span> DOWNLOAD </span></a>
</div>