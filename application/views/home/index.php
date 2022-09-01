<body class="login-page2">
    <div class="login-page2_bg">
        <div class="col-md-12 p-0">
            <div class="col-md-6 p-0">
              <div class="img_bg">
                  <div class="heading">
                     Project Management and Monitoring Solution
                      <p>Project Management and Monitoring Solution (PMMS) is a web-based portal with mobility support; useful for monitoring the status and advancement of various infrastructural development projects including physical and financial progress.</p>
                  </div>
                  <div><img  src="<?php echo base_url();?>assets/images/login_img2.png"/ class="img-responsive"></div>
              </div>
            </div>
           <div class="col-md-6">
            <div class="col-md-10 col-md-offset-1">
             <div class="login-box2">
                <div class="logo">
                   <a href=""><img src="<?php echo base_url();?>assets/images/obcc_logo.png"/>
                   </br>
                   <span>Odisha Bridge & Construction Corporation Limited</span>
               </a>
                </div>
              
                   <div class="body">
                <?php echo form_open('Home/user_login_process',array('name'=> 'Home')); ?>
                            <div class="msg">
                            <div class="error" style="color:#FF0000;margin-top:0px">
                       <?php echo $this->session->flashdata('message'); ?>
                    </div>
                         Sign in to start your session
                    </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-user"></i>
                                </span>
                                <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <div class="form-line"> 
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <button class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                                </div>
                            </div>
                                     </form>
                   </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
