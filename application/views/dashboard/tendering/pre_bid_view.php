<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Pre Bid </h2>
        </div>
<?php 
if(!empty($pre_bid)){
?>
    <div class="table-responsive m-b-30">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                    
                      <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Prebid Meeting date</td>
                      <td><?php 
                          if($pre_bid[0]['approval_date']=='0000-00-00'){
                              echo $pre_bid[0]['approval_date']='';
                           }
                         else{
                            echo $pre_bid[0]['approval_date'];
                           }

                     ?></td>
                      <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                      <td><?php echo $pre_bid[0]['remarks']; ?></td>
                   </tr>

                   <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i>Corrigendum / Addendum Issuance Date</td>
                        <td><?php 
                              if($pre_bid[0]['corrigendum_issuance_date']=='0000-00-00'){
                                  echo $pre_bid[0]['corrigendum_issuance_date']='';
                               }
                               else{
                                echo $pre_bid[0]['corrigendum_issuance_date'];
                               }
                               
                         ?></td> 
                          <td>&nbsp;   </td>
                          <td>&nbsp;   </td>
                   </tr>

                </tbody>
         </table>
    </div>
   


    <div class="table-responsive m-b-30 col-md-10">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable camelcase">
            <thead>
               <th> Bidder Name  </th>
               <th> First Name </th>
               <th> Middle Name </th>
               <th> Last Name </th>
               <th> Mobile Number </th>
               <th> Email Address </th>

            </thead>
            <tbody>

                <?php
                if(!empty($pre_bid_bidder_data)){
                foreach ($pre_bid_bidder_data as $prebid_bidder_data) {
                ?>
                <tr>
                     <td><?php echo $prebid_bidder_data['bidder_name']; ?></td>
                     <td><?php echo $prebid_bidder_data['first_name']; ?></td>
                     <td><?php echo $prebid_bidder_data['middle_name']; ?></td>
                     <td><?php echo $prebid_bidder_data['last_name']; ?></td>
                     <td><?php echo $prebid_bidder_data['mobile_no']; ?></td>
                     <td><?php echo $prebid_bidder_data['email_id']; ?></td>
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>


     <div class="table-responsive m-b-30  col-md-10">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Upload Pre-bid Clarifications </th>
            </thead>
            <tbody>

                <?php
                if(!empty($pre_bid_bidder_data_document)){
                foreach ($pre_bid_bidder_data_document as $prebid_bidder_data_document) {
                ?>
                <tr>
                      <td><a href="<?php echo base_url();?>uploads/files/prebid/<?php echo $prebid_bidder_data_document['document_name']; ?>" title="Download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a></td>
                     
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>
   
<div style='clear:both'></div>


<?php }else {
        echo 'No data availbale!!';
    } ?>

</div>