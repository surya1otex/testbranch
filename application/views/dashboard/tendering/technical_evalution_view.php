<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2> Technical Evalution </h2>
        </div>

<?php 
if(!empty($technical_evalution)){


?>

    <div class="table-responsive">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Technical Evalution Date</td>
                        <td><?php 
                              if($technical_evalution[0]['approval_date']=='0000-00-00'){
                                  echo $technical_evalution[0]['approval_date']='';
                               }
                               else
                               {
                                echo $technical_evalution[0]['approval_date'];
                               }
                         ?></td>

                        <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                        <td><?php echo $technical_evalution[0]['remarks']; ?></td>
                   </tr>
                </tbody>
         </table>
    </div>

   <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Ref No/Name </th>
               <th> Technically qualified / disqualified </th>
            </thead>
            <tbody>

                <?php
                if(!empty($technical_evalution_bidder_data)){
                foreach ($technical_evalution_bidder_data as $bidder_data) {
                ?>
                <tr>
                     <td><?php echo $bidder_data['biddername']; ?></td>
                     <td>
                        <?php if($bidder_data['status']=='Y') {
                            echo $bidder_data['status']='Yes';
                        }

                        else{
                           echo $bidder_data['status']='No';
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