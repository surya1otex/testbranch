<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2>Negotiation </h2>
        </div>

<?php 
if(!empty($negotiation)){


?>

    <div class="table-responsive">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Negotiation Date</td>
                        <td>
                            <?php 
                              if($negotiation[0]['approval_date']=='0000-00-00'){
                                  echo $negotiation[0]['approval_date']='';
                               }

                               else
                               {
                                echo $negotiation[0]['approval_date'];
                               }       
                            ?>    
                         </td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                        <td><?php echo $negotiation[0]['remarks']; ?></td>
                   </tr>
                </tbody>
         </table>
    </div>



    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Ref No/Name </th>
               <th> Negotiation Meeting date</th>
               <th> Negotiated Bid Value</th>
               <th> Successful Bidder’s Response</th>
               <th> Status</th>
            </thead>
            <tbody>

                <?php
                if(!empty($negotiation_bidder_data)){
                foreach ($negotiation_bidder_data as $bidder_negotiation_data) {
                ?>
                <tr>
                     <td><?php echo $bidder_negotiation_data['biddername']; ?></td>
                     <td><?php echo $bidder_negotiation_data['meetingdate']; ?></td>
                     <td><?php echo $bidder_negotiation_data['bidvalue']; ?></td>

                     <td><a href="<?php echo base_url();?>uploads/files/negotiation/<?php echo $bidder_negotiation_data['document']; ?>" title="Download" download class="btn btn-primary waves-effect"><i class="fa fa-download"></i> Download</a></td>

                     <td>
                        <?php if($bidder_negotiation_data['status']=='Y') {
                            echo $bidder_negotiation_data['status']='Yes';
                        }

                        else{
                           echo $bidder_negotiation_data['status']='No';
                        }

                         ?>
                     </td>
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>

   



<?php }else {
        echo 'No data availbale!!';
    } ?>
</div>