<section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4>Pre Project Initiation </h4>
            </div>
            
          <!-- Steps start -->
        <div class="card clearfix">
          <div class="col-md-12">
            <div class="row ">
                <ul class="stepper stepper-horizontal p-l-10 p-r-10 m-b-0" >
                    
                    <li class="completed">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-cog"></i></span>
                          <span class="label">Initial Project Profile</span>
                        </a>
                    </li>
                    
                    <li class="completed">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-file"></i></span>
                          <span class="label">DPR Updation</span>
                        </a>
                    </li>
                    
                    <li class="active">
                        <a href="#!">
                          <span class="circle"><i class="fas fa-check-square"></i></span>
                          <span class="label">Pre Construction Activities</span>
                        </a>
                    </li>
                    
                </ul>
               </div>
             </div>
           </div>          
            
    <!-- Steps end -->  
            
   <?php
    if(is_numeric($project_id)){
        project_info($project_id);
    }

    ?> 
                   
 <!--    Project_Information End -->  
            
            
             
 <!-- Quick Nav   -->
            
  <?php project_quick_nav($project_id);  ?>              
            
            
 <!-- Quick Nav   -->
            
            
<!-- Quick Nav end -->           
 
    
            
			<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Land Schedule </h2>
                        </div>

                        <div class="body">
                           <div class="cloneBox1 m-b-15">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <p>
                                        <b>District <span class="col-pink">* </span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i> 
                                            <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                              <select class="form-control show-tick" name="district_id" id="district">
                                        <option value="0">Please select</option>
                                            <?php
                                   foreach($districts as $district)
                                   {
                                   echo '<option value="'.$district->id.'">'.$district->district_name.'</option>';
                                   }
                                     ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Tahsil <span class="col-pink">* </span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i> 
                                            <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                                     <select class="form-control show-tick" id="tahsil">

                                    </select>
                                </div>
                                
                                <div class="col-md-4">
                                    <p>
                                        <b>Village <span class="col-pink">* </span></b>
                                        <span class="ntip"><i class="fa fa-info-circle" title=""></i> 
                                            <span class="ntiptext">text Information</span>
                                        </span>
                                    </p>
                                     <select class="form-control show-tick" data-live-search="true" multiple>
                                        <option value="0">Please select</option>
                                        <option value="1">Option #1</option>
                                        <option value="2">Option #2</option>
                                        <option value="3">Option #3</option>
                                    </select>
                                </div>
                                
                             </div>
                            </div>
                            
                            <div class="col-md-12  align-center">
                              <button class="btn bg-indigo waves-effect "  type="button">ADD</button>
                           </div>
                           <div class="clearfix"></div>
                            
                           </div>
                        </div>
                    
                        
                    <div class="card"> 
                          <div class="header">
                            <h2> Status of key milestones</h2>
                          </div>  
                         
                        <div class="body"> 
                          <div class="cloneBox1 m-b-15">
                            <div class="table-responsive">
             
                                <table class="table table-bordered table-striped table-hover">
                                    <thead>
                                        <tr class="bg-blue-grey">
                                            <th class="text-center">District</th>
                                            <th class="text-center">Tahsil</th>
                                            <th class="text-center">Village</th>
                                            <th colspan="2" class="text-center">Govt. Land(In Acres)</th>
                                            <th class="text-center">Forest Land(In Acres)</th>
                                            <th colspan="3" class="text-center">Private Land(In Acres)</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3"></th>
                                            <th class="text-center">PWD Land</th>
                                            <th class="text-center">Other Department Land</th>
                                            <th class="text-center"></th>
                                            <th class="text-center">General</th>
                                            <th class="text-center">SC</th>
                                            <th class="text-center">ST</th>
                                            <th class="text-center">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td rowspan="7" class="align-middle">Sambalpur</td>
                                            <td rowspan="4" class="align-middle">Bamra</td>
                                            <td class="align-middle">Babuniktimal</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Baunslaga</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Garposh</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jarabaga</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3" class="align-middle">Maneswar</td>
                                            <td class="align-middle">Udepuri</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jarabaga</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-middle">Jarabaga</td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> <input class="form-control" type="text"> </td>
                                            <td> 
                                                <button type="button" class="btn btn-default btn-circle waves-effect waves-circle waves-float m-r-5">
                                                  <i class="material-icons col-pink">delete</i>
                                                </button> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center align-middle"><strong>Total</strong></td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                            <td> &nbsp; </td>
                                        </tr>
                                    </tbody>
                                </table>
                             </div>
                              
                           </div>
                            
                           <div class="col-md-12  align-center">
                              <button class="btn btn-primary waves-effect "  type="button">SAVE</button>
                           </div>
                           <div class="clearfix"></div>  
                            
                         </div>
                        </div>
 
                 </div>
                

            <!-- Select -->
            </div>
        </div>
    </section>
    <!-- #Main Content -->
<script type="text/javascript">
    $(document).ready(function(){
 $('#district').change(function(){
  var district_id = $('#district').val();
  if(district_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>pre_consttruction_activity_land_schedule/fetch_tahasil",
    method:"POST",
    data:{district_id:district_id},
    success:function(data)
    {
     $('#tahsil').html(data);
 
    }
   });
  }
 });
 
});
</script>