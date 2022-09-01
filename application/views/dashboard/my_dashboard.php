<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h4>MY-DASHBOARD</h4>
        </div>

        <!-- Widgets -->
        <div class="row clearfix">

            <!-- Financial Progress -->
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>My Details</h2>
                    </div>
                    <div class="body table-responsive">
                        <table class="table table-bordered camelcase">

                            <tbody>
                            <tr>
                                <th scope="row"><i class="fa fa-user m-r-10"></i><b> Name :</b></th>
                                <td><?php echo $user_details[0]['firstname']. " ".$user_details[0]['lastname']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-cogs m-r-10"></i><b> Designation :</b></th>
                                <td><?php echo $user_details[0]['designation']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-mobile m-r-15"></i> <b>Mobile No :</b></th>
                                <td>+91 <?php echo $user_details[0]['mobile']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row"><i class="fa fa-envelope m-r-10"></i> <b>Email ID :</b></th>
                                <td><?php echo $user_details[0]['email']; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- #END# Financial Progress -->

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="card">

                    <div class="body">
                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                <div class="info-box-2 bg-teal m-b-0">
                                    <div class="icon">
                                        <i class="fa fa-user"> </i>
                                    </div>
                                    <div class="content">
                                        <div class="text m-t-15">MY PROJECT </div>
                                        <div class="number"><?php echo $total_projects; ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box-2  bg-orange m-b-0">
                                    <div class="icon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <div class="content">
                                        <div class="text m-t-15"><a href="<?php echo base_url(); ?>User/change_password">CHANGE PASSWORD</a></div>
                                        <!--                                            <div class="number">15</div>-->
                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <div class="row">
                            <?php foreach($master_module as  $data){ ?>
                            <!--
                            <div class="col-md-4">
                                <button type="button" class="btn bg-deep-purple waves-effect" onclick="window.location.href='
                                    <?php echo base_url().$data['moduleUrl']; ?>'">
                                    <i class="material-icons">settings</i>
                                    <span><?php echo $data['moduleLabel'];?></span>
                                </button>
                            </div>
                            -->

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="info-box-4 m-b-0">
                                        <?php if(!empty($data['first_child_url'])){ ?>
                                            <a href="<?php echo base_url().$data['first_child_url']; ?>" >
                                                <?php }else{ ?>
                                                <a href="<?php echo base_url().$data['moduleUrl']; ?>" >
                                                <?php  } ?>
                                            <div class="icon">
                                                <i class="fa <?php echo $data['menu_icon'];?> col-red"></i>
                                            </div>
                                            <div class="content">
                                                <div class="text"><?php echo $data['moduleLabel'];?></div>
                                                <!--<div class="number count-to" data-from="0" data-to="125" data-speed="1000" data-fresh-interval="20">125</div>-->
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php } ?>
                            <!--<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box-4 m-b-0">
                                    <a href="#" >
                                        <div class="icon">
                                            <i class="fa fa-user col-indigo"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">NEW MEMBERS</div>
                                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">257</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box-4 m-b-0">
                                    <a href="#" >
                                        <div class="icon">
                                            <i class="fa fa-check-circle col-purple"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">BOOKMARKS</div>
                                            <div class="number count-to" data-from="0" data-to="117" data-speed="1000" data-fresh-interval="20"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="info-box-4 m-b-0">
                                    <a href="#" >
                                        <div class="icon">
                                            <i class="fa fa-thumbs-up col-deep-purple"></i>
                                        </div>
                                        <div class="content">
                                            <div class="text">LIKES</div>
                                            <div class="number count-to" data-from="0" data-to="1432" data-speed="1500" data-fresh-interval="20"></div>
                                        </div>
                                    </a>
                                </div>
                            </div>-->

                        </div>

                    </div>
                </div>
            </div>

        </div>