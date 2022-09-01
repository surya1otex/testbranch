<style>
       img{ max-width:100%;}
       .inbox_people {
          background: #f8f8f8 none repeat scroll 0 0;
          float: left;
          overflow: hidden;
          width: 40%; border-right:1px solid #c4c4c4;
        }
        .inbox_msg {
          border: 1px solid #c4c4c4;
          background: #eee;
          clear: both;
          overflow: hidden;
        }
        .top_spac{ margin: 20px 0 0;}

        .recent_heading {float: left; width:40%;}
        .srch_bar {
          display: inline-block;
          text-align: right;
          width: 60%;
        }
        .headind_srch{ padding:10px 29px 10px 20px; overflow:hidden; border-bottom:1px solid #c4c4c4;}

        .recent_heading h4 {
          color: #05728f;
          font-size: 21px;
          margin: auto;
        }
        .srch_bar input{ border:1px solid #cdcdcd; border-width:0 0 1px 0; width:80%; padding:2px 0 4px 6px; background:none;}
        .srch_bar .input-group-addon button {
          background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
          border: medium none;
          padding: 0;
          color: #707070;
          font-size: 18px;
        }
        .srch_bar .input-group-addon { margin: 0 0 0 -27px;}

        .chat_ib h5{ font-size:15px; color:#464646; margin:0 0 8px 0;}
        .chat_ib h5 span{ font-size:13px; float:right;}
        .chat_ib p{ font-size:14px; color:#989898; margin:auto}
        .chat_img {
          float: left;
          width: 11%;
        }
        .chat_ib {
          float: left;
          padding: 0 0 0 15px;
          width: 88%;
        }

        .chat_people{ overflow:hidden; clear:both;}
        .chat_list {
          border-bottom: 1px solid #c4c4c4;
          margin: 0;
          padding: 18px 16px 10px;
        }
        .inbox_chat { height: 550px; overflow-y: scroll;}

        .active_chat{ background:#ebebeb;}

        .incoming_msg{
           overflow: hidden;
           margin: 35px 0;
         }


        .incoming_msg_img {
          display: inline-block;
          width: 6%;
          margin-top: 24px;
        }
        .received_msg {
          display: inline-block;
          padding: 0 0 0 10px;
          vertical-align: top;
          width: 92%;
         }
         .received_withd_msg p {
          background: #c7ccd5 none repeat scroll 0 0;
          border-radius: 6px;
          color: #000;
          font-size: 14px;
          margin: 0;
          padding: 15px;
          width: 100%;
        }
       .send_by {
          color: #747474;
          display: block;
          font-size: 12px;
          margin: 0 0 8px 0;
        }
       .send_to {
          color: #747474;
          display: block;
          font-size: 12px;
          margin: 0 0 8px 0;
          text-align: right;
        }
       
       .time_date {
          color: #747474;
          display: block;
          font-size: 12px;
          margin: 8px 0 0;
        }
        .received_withd_msg { 
            width: 85%;
        }
       
        .mesgs {
          float: left;
          padding: 30px 15px 30px 25px;
          width: 100%;
        }

         .sent_msg p {
          background: #476b91 none repeat scroll 0 0;
          border-radius: 6px;
          font-size: 14px;
          margin: 0; color:#fff;
          padding: 15px;
          width:100%;
        }
       
        .outgoing_msg{ 
            overflow:hidden;
            margin:35px 0;
        }
       
       .outgoing_msg_img {
          display: inline-block;
          width: 6%;
          margin-top: 24px;
          float: right;
        }

        .sent_msg {
          padding: 0 10px 0 0;
          float: right;
          width: 80%;
        }
        .input_msg_write input {
          background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
          border: medium none;
          color: #4c4c4c;
          font-size: 15px;
          min-height: 48px;
          width: 100%;
        }

        .messaging { padding: 0 0 5px 0;}
        .msg_history {
          height: 420px;
          overflow-y: auto;
        }
       
       
       @media only screen and (max-width: 600px) {
        .send_to {
          text-align: left;
        }
        .received_withd_msg p{
               margin-top: 0px;
           }
        .sent_msg p {
            margin-top: 0px;
           }
       }
   </style>
<!-- JQuery DataTable Css -->
<link href="<?php echo base_url();?>assets/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<?php $CI =& get_instance();?>
<section class="content">
        <div class="container-fluid">
           <div class="col-md-12">
				<div class="block-header">
					<h4>Project Delayed Summary -  <?php echo $project_deatail[0]['project_name'];?></h4>
				</div>
            </div>
            
            <div class="row">
                    <div class="col-md-7 col-md-offset-2">
                <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                    </div>
                    <?php } if($this->session->flashdata('danger')){ ?>
                    <div class="alert alert-danger alert-dismissible text-center fade-message">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> <?php echo $this->session->flashdata('danger'); ?>
                      </div>
                  <?php } ?>
                    </div>        
                    
                </div>
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <?php
                        $comp_percent = ($project_deatail[0]['Earned_Value'] * 100) / $project_deatail[0]['Planned_Value'];
                        $diff_percent = round(100 - $comp_percent,2);
                        $diff = round( ($project_deatail[0]['Planned_Value'] - $project_deatail[0]['Earned_Value']),2);
                        ?>
                        
                 
                  <div class="body">
                    <div class="table-responsive">
                                <div class="body table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">Project Name :</th>
                                        <td><?php echo $project_deatail[0]['project_name']; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Area:</th>
                                        <td><?php echo !empty($project_deatail[0]['area_name']) ? $project_deatail[0]['area_name']: "--"?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Category:</th>
                                        <td><?php echo !empty($project_deatail[0]['project_type']) ? $project_deatail[0]['project_type'] : "--"?></td>
                                    </tr>
                                    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                  </div>
              </div>
               <div class="card">
                <div class="header">
                    <h2>Delayed Activity List </h2>
                </div>
                  <div class="body">
                            <div class="">
                                <table id="project_delayed_details_tbl" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="text-align:center;">Stage</th>
                                            <th rowspan="2" style="text-align:center;">Activity</th>
                                            <th colspan="3" style="text-align:center;">Till Date</th>
                                          </tr>
                                          <tr>
                                            <th style="text-align:center;">Planned Value <i class="fa fa-rupee-sign"></i></th>
                                            <th style="text-align:center;">Earned Value <i class="fa fa-rupee-sign"></i></th>
                                            <th style="text-align:center;">Performance Variance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(is_array($project_delayed_deatail)){
                                            foreach($project_delayed_deatail as $delayed){
                                        $Variance = round((100 - (($delayed->Earned_Value * 100 ) / $delayed->Planned_Value)),2);
                                        ?>
                                        <tr>
                                            <td><?php echo $delayed->work_item_name; ?></td>
                                            <td><?php echo $delayed->activities_name; ?></td>
                                            <td style="text-align:right;"><?php echo number_format($delayed->Planned_Value,2); ?></td>
                                            <td style="text-align:right;"><?php echo number_format($delayed->Earned_Value,2); ?>
                                            <td style="text-align:center;"><?php echo $Variance; ?>%</td>
                                            
                                        </tr>
                                    <?php } } ?>
                                        
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="row clearfix"> 
         <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Notification</h2>
                </div>
                
               <div class="row clearfix">
                   
                 <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                   <div class="body">
                    <div class="alert alert-success alert-dismissible text-center fade-message" id="asmsg" style="display:none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Message Sent Successfully
                    </div>
                    <div class="alert alert-danger alert-dismissible text-center fade-message" id="anmsg" style="display:none;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Something Error. Please try again !!
                    </div>
                    <form action="<?php echo base_url().'project_delay_list/send_communication_data'; ?>" id="communication_frm" method="POST">
                        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                     
                      <div class="col-md-12 p-t-15">
                        <p><b>Message <span class="col-pink">* </span></b></p>
                        <textarea class="form-control no-resize" rows="5" placeholder="Please type what you want..." name="remarks" id="remarks"></textarea>
                      </div>
                     
                       <div class="col-md-12 align-right">
                        <a href="<?php echo  base_url().'project_delay_list'; ?>" class="btn btn-warning waves-effect">Cancel</a>
                        <button class="btn btn-primary waves-effect" id="communication_submit_btn" type="submit">SEND</button>
                         <div class="clearfix"></div>
                      </div>
                  </form>
                     
                     </div>
                  </div>
                  
                 <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="body" id="communication_area">
                      
                </div>
            </div>
                </div>
            </div>
          </div>
       </div>
                
            <!-- #END# Basic Examples -->

        </div>
    </section>



    <!-- DataTables -->

<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script type="text/javascript">
       
            $(function() {
            
            $('#project_delayed_details_tbl').DataTable({
            responsive: true
            });
         
        })
    </script>

    <script type="text/javascript">
    $(document).ready(function() {

        $('.fade-message').delay(5000).fadeOut(5000);

        get_communication_area();

    });

</script>



<!---Custom Javascript-->
<script type="text/javascript">

/*Contact From*/
$('#communication_frm').submit( function(e) {
  e.preventDefault();
  var me = $(this);
$("#communication_submit_btn").prop("disabled", true);
  //alert('ok');

  $.ajax({
    url: me.attr('action'),
    type: 'POST',
    data: me.serialize(),
    dataType: 'json',
    success: function(response){
      //console.log(response);
      if(response.success == true)
      {
          
          $("#asmsg").show();
          setTimeout(function() { $("#asmsg").hide(); }, 3000);
          $('.text-danger').remove();
          document.getElementById("communication_frm").reset();
          get_communication_area();
          $("#communication_submit_btn").prop("disabled", false);

      }

      else if(response.success == 'no')
      {
          $("#anmsg").show();
          setTimeout(function() { $("#anmsg").hide(); }, 1000);
          $('.text-danger').remove();
      }
      else
      { 
        $('.text-danger').remove();
        //alert(response);
        $.each(response.messages, function(key, value){
          var element = $('#' + key);
          element.closest('div.addr-group')
          //.find('.text-danger').remove();
          element.after(value);
          $("#communication_submit_btn").prop("disabled", false);

        });

      }
    }
  })

});

</script>
<script type="text/javascript">
    function get_communication_area(){
        var project_id = '<?php echo $project_id; ?>';
        var user_id = '<?php echo $user_id; ?>';
        $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>project_delay_list/get_stakeholder_communication_area",
                        data: {"<?php echo $this->security->get_csrf_token_name(); ?>":"<?php echo $this->security->get_csrf_hash(); ?>", 
                            "project_id": project_id,
                            "user_id": user_id
                    },
                        success: function (data) {                          
                        //console.log(data);
                           $('#communication_area').html('').append(data);
                        
                          }
                        });
    }
</script>



