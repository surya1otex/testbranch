<?php


$periodarr = array();
$k=0;
foreach ($period as $dt){ 
     $periodarr[] = array('monthName' => $dt->format("M Y"), 'project_financial_planning_detail_id' => $project_financial_planning_detail[$j]['id'], 'project_financial_planning_detail_target_amount' => $project_financial_planning_detail[$j]['target_amount'], 'Ammount' => '','weightage'=>'');
    
    $k++;
}

$durationperiodarr = array();
foreach($durationperiod as $duration_dt){
    $durationperiodarr[] = array('monthName' => $duration_dt->format("M Y"), 'Ammount' => round($single_budget_amt,2),'weightage'=>$single_weightage);
}



count($periodarr) > count($durationperiodarr) ? ($greater = $periodarr and $smaller = $durationperiodarr) : ($smaller = $periodarr and $greater = $durationperiodarr);

foreach ($greater as $key => &$value) {
    foreach ($smaller as $key1 => &$value1) {
        
        if ($value['monthName'] == $value1['monthName']) {
        
            if(!empty($value1['Ammount'])){
              $value['Ammount'] = $value1['Ammount'];  
          }else{
            $value['Ammount'] = $value['Ammount'];
          }

          if(!empty($value1['weightage'])){
            $value['weightage'] = $value1['weightage'];
        }else{
            $value['weightage'] = $value['weightage'];
        }
            
            
            $value['project_financial_planning_detail_id'] = $value['project_financial_planning_detail_id'];
            $value['project_financial_planning_detail_target_amount'] = $value['project_financial_planning_detail_target_amount'];
        }
    }
}
// echo '<pre>';
// print_r($greater);
// echo '</pre>';


//die();
?>
<div class="card">
             <div class="body">
               
               <div class="table-responsive">
                                
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                   <thead>
                                        <tr>
                                            <th style="padding: 10px 5px; width: 40px">Sl No</th>
                                            <th style="padding: 10px 5px; width: 350px">Months
                                            </th>
                                            <th style="padding: 10px 5px; width: 50px">Planned (%)
                                            </th>
                                            <th style="padding: 10px 5px; width: 150px">Planned Amount (<i class="fa fa-rupee-sign"></i>)
                                            </th>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                      <?php 
                                        $i=1;$j=0;

                                        foreach ($greater as $val){ 

                                      ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td>
                                                <?php echo $val['monthName'];?>
                                                <input type="hidden" class="form-control" placeholder="Cost" name="month[]" value="<?php echo $val['monthName'];?>"/>
                                                <input type="hidden" name="financial_planning_detail_id[]" value="<?php if(!empty($val['project_financial_planning_detail_id'])){echo $val['project_financial_planning_detail_id'];}else{echo "";};?>">
                                            </td>
                                            <td>
                                                <input onkeypress="return validateFloatKeyPress(this,event);" type="text" style="text-align: right; vertical-align: middle;" class="form-control weightage_key" placeholder="Weightage" name="Weightage[]" id="weightage_<?php echo $i; ?>" value="<?php if(!empty($val['weightage'])){echo round($val['weightage'],2);}else{echo "0.00";};?>" />
                                                
                                            </td>
                                            <td>
                                                <input type="text" onkeypress="return validateFloatKeyPress(this,event);" style="text-align: right; vertical-align: middle;" class="form-control amount_key" id="amount_<?php echo $i; ?>" placeholder="Amount" name="target[]" value="<?php if(!empty($val['Ammount'])){echo round($val['Ammount'],2);}else{echo "0.00";};?>" />
                                            </td>
                                        </tr>
                                       <?php 
                                          $j++;$i++;
                                          }
                                       ?>
                                       <tr>
                                           <td></td>
                                           <td style="text-align: center; vertical-align: middle;"><strong>Total</strong></td>
                                           <td style="text-align: right; vertical-align: middle;"><span id="TotalPlannedPercentData"></span></td>
                                           <td style="text-align: right; vertical-align: middle;"><span id="TotalPlannedAmtData"></span> ( <span style="color: red;" id="remainPlannedAmtData"></span>)</td>
                                       </tr>
                                    </tbody>
                                </table>
                           
                               
                                <div class="col-md-2 col-md-offset-5" style="margin-top: 5px;">
                                       <input type="submit" name="submit" value="SAVE" class="btn bg-indigo waves-effect" />
                                       <a href="javascript:window.history.back();" title="Go back to previous page"  class="btn bg-indigo waves-effect"><span> BACK </span></a>
                                </div>
                            </div>
                            
              </div>
          </div>


          <script type="text/javascript">
              $(".weightage_key").keyup(function(){
    
                var weightageKeyId = this.id;
                var weightageVal = this.value;
                var agreementCost = '<?php echo $view_agreement_cost; ?>';
                var activitiesBudget = '<?php echo $get_activities_budget_amt; ?>';
                var result = weightageKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(weightageVal){
                    calamtData = (parseFloat(weightageVal, 10) * parseFloat(agreementCost, 10)) / 100;
                    $("#amount_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });

              $(".amount_key").keyup(function(){
    
                var amountKeyId = this.id;
                var amountVal = this.value;
                //alert(amountVal);
                var agreementCost = '<?php echo $view_agreement_cost; ?>';
                var activitiesBudget = '<?php echo $get_activities_budget_amt; ?>';
                var result = amountKeyId.split('_');
                var id = result[1];
                var calamtData = '';
               if(amountVal){
                    calamtData = (parseFloat(amountVal, 10) / parseFloat(agreementCost, 10)) * 100;
                    $("#weightage_"+id).val(calamtData.toFixed(2));
                    check_total();
               } 
            });



              
          </script>

          <script type="text/javascript">
              function check_total(){
            var TotalPlannedAmtData = 0.00;
            var remainPlannedAmtData = 0.00;
            var activitiesBudget = '<?php echo $get_activities_budget_amt; ?>';
            $('#financial_month_data').find('.amount_key').each(function(index, element) {
                TotalPlannedAmtData +=parseFloat(element.value);
                //console.log(TotalPlannedAmtData);
                
                $("#TotalPlannedAmtData").html(TotalPlannedAmtData.toFixed(2));
                remainPlannedAmtData = parseFloat(activitiesBudget) - TotalPlannedAmtData;
                //console.log(activitiesBudget);
                $("#remainPlannedAmtData").html(remainPlannedAmtData.toFixed(2));
            })
            var TotalPlannedPercentData = 0.00;
            $('#financial_month_data').find('.weightage_key').each(function(index, element) {
                TotalPlannedPercentData +=parseFloat(element.value);
                //console.log(TotalPlannedPercentData);
                $("#TotalPlannedPercentData").html(TotalPlannedPercentData.toFixed(2));
            })


        }
          </script>

