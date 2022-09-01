<?php $CI =& get_instance();?>
<div class="card">
        <div class="header">
            <h2>Financial Evalution </h2>
        </div>
<?php 
if(!empty($financial_evalution)){


?>

    <div class="table-responsive">
         <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>
                    <tr>
                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> date_range </i> Financial Evalution Date</td>


                    <td><?php 
                          if($financial_evalution[0]['approval_date']=='0000-00-00'){
                              echo $financial_evalution[0]['approval_date']='';
                           }

                           else
                           {
                            echo $financial_evalution[0]['approval_date'];
                           }
                           


                     ?></td>

                    <td width=310px> <i class="material-icons" style="position: relative;top: 8px;"> chevron_right </i> Remarks</td>
                    <td><?php echo $financial_evalution[0]['remarks']; ?></td>
                    
                   </tr>
                </tbody>
         </table>
    </div>
   <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
            <thead>
               <th> Bidder Ref No/Name </th>
               <th> Successful Bid Value </th>
               <th> Status </th>
               <th> Final Score </th>
            </thead>
            <tbody>

                <?php
                if(!empty($financial_evalution_bidder_data)){
                foreach ($financial_evalution_bidder_data as $financial_bidder_data) {
                ?>
                <tr>
                     <td><?php echo $financial_bidder_data['biddername']; ?></td>
                     <td><?php echo $financial_bidder_data['bidvalue']; ?></td>
                     <td>
                        <?php if($financial_bidder_data['status']=='L1') {
                            echo $financial_bidder_data['status']='L1';
                        }

                        elseif ($financial_bidder_data['status']=='L2') {
                             echo $financial_bidder_data['status']='L2';
                        }
                         elseif ($financial_bidder_data['status']=='L3') {
                             echo $financial_bidder_data['status']='L3';
                        }
                        else
                        {
                           echo $financial_bidder_data['status']='Not Qualified';
                        }
                        ?>
                     </td>
                     <td><?php echo $financial_bidder_data['score']; ?></td>
                </tr>
             <?php } } ?>
            </tbody>
        </table>
     </div>
   



<?php }else {
        echo 'No data availbale!!';
    } ?>

</div>