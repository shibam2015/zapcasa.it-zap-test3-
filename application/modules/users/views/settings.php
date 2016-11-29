<?php $this->load->view("inc/header");?>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<div class="col-md-3 left_col">
			<?php $this->load->view("inc/left_nav");?>	
            <!-- top navigation -->
            <?php $this->load->view("inc/top_nav");?>
            <!-- /top navigation -->


            <!-- page content -->
            <div class="right_col" role="main">

                <!-- top tiles -->
                <div class="">


		<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_title">
			<h2>Settings <small>User</small></h2>
			<ul class="nav navbar-right panel_toolbox">
				<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
				</li>
				<li><a class="close-link"><i class="fa fa-close"></i></a>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" id="first_name" value="<?php echo $user->first_name;?>">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" id="last_name" value="<?php echo $user->last_name;?>">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Profit %</label>
                                            <input class="form-control" name="sell_per" id="sell_per" value="<?php echo $user->sell_per;?>">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Exchanges</label>
                                            <div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isCoinbase == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="1" type="checkbox" <?php echo ($user->isCoinbase == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;Coinbase
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isCryptsy == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="2" type="checkbox" <?php echo ($user->isCryptsy == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;Cryptsy
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isCEX == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="3" type="checkbox" <?php echo ($user->isCEX == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;CEX
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isVircurex == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="4" type="checkbox" <?php echo ($user->isVircurex == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;Vircurex
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isBtce == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="5" type="checkbox" <?php echo ($user->isBtce == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;BTC-E
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isBitstamp == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="6" type="checkbox" <?php echo ($user->isBitstamp == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;Bitstamp
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isItBit == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="7" type="checkbox" <?php echo ($user->isItBit == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;itBit
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isHitBTC == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="8" type="checkbox" <?php echo ($user->isHitBTC == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;HitBTC
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isLakeBTC == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="9" type="checkbox" <?php echo ($user->isLakeBTC == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;LakeBTC
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isKraken == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="10" type="checkbox" <?php echo ($user->isKraken == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;Kraken
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <div class="icheckbox_flat-green <?php echo ($user->isBitFinex == 0) ? 'checked' : '';?>" style="position: relative;">
														<input name="exchange[]" value="11" type="checkbox" <?php echo ($user->isBitFinex == 0) ? 'checked="checked"' : '';?> class="flat" style="position: absolute; opacity: 0;">
														<ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> &nbsp;BitFinex
                                                </label>
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label>Robot</label>
											<div class="radio">
												<label class="">
													<div class="iradio_flat-green <?php echo ($user->isRobot == 0) ? 'checked' : '';?>" style="position: relative;">
														<input type="radio" name="isRobot" value="1" <?php echo ($user->isRobot == 1) ? 'checked=""' : '';?> class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> On
												</label>
											</div>
											<div class="radio">
												<label class="">
													<div class="iradio_flat-green <?php echo ($user->isRobot == 0) ? 'checked' : '';?>" style="position: relative;">
														<input type="radio" name="isRobot" value="0" <?php echo ($user->isRobot == 0) ? 'checked' : '';?> class="flat" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255) none repeat scroll 0% 0%; border: 0px none; opacity: 0;"></ins>
													</div> Off
												</label>
											</div>
										</div>
										<input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $this->session->userdata("sess_user_id");?>" />
                                        <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("inc/footer");?>