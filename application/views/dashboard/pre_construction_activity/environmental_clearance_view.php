

    <div class="card">
        <div class="header">
            <h2> Environmental Clearance </h2>
        </div>
                <?php
if(!empty($environmental_clearance_data)){
    ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                <tbody>

                <tr> 
                    <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">date_range</i> Target end date</td>
                    <td><?php echo $environmental_clearance_data[0]['target_end_date']; ?></td>
                    <td width=310px;> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> EIA and TORS prepared ?  </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_EIA']; ?></td>
                </tr>

                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Online application submitted ?</td>
                    <td> <?php echo $environmental_clearance_data[0]['status_online_application']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> OSCPCB scrutiny completed  ?</td>
                    <td> <?php echo $environmental_clearance_data[0]['status_OSCPCB_scrunity']; ?></td>
                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> EC Received ?  </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_ec_received']; ?> </td>
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Fund for EC Deposite ? </td>
                    <td> <?php echo $environmental_clearance_data[0]['status_fund_for_ec']; ?></td>
                </tr>
                <tr> 
                    <td> <i class="material-icons" style="position: relative;top: 8px;">chevron_right</i> Remarks   </td>
                    <td> <?php echo $environmental_clearance_data[0]['remarks']; ?></td>
                    <td>  &nbsp;   </td>
                    <td> &nbsp;</td>
                </tr>

                </tbody>
            </table>
        </div>

         <?php 
}else{
echo 'No data availbale!!';
    
}
?>
    </div>
