<?php $this->load->view("inc/header");?>
<div id="page-wrapper">
	<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            New User
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input class="form-control" name="first_name" id="first_name">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input class="form-control" name="last_name" id="last_name">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input class="form-control" name="email" id="email">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
										<div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" name="password" id="password">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
										<div class="form-group">
                                            <label>Buy %</label>
                                            <input class="form-control" name="buy_per" id="buy_per">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
										<div class="form-group">
                                            <label>Sell %</label>
                                            <input class="form-control" name="sell_per" id="sell_per">
                                            <p class="help-block">&nbsp;</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Exchanges</label>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="exchange[]" value="1">Coinbase
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="exchange[]" value="2">Cryptsy
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="exchange[]" value="3">CEX
                                                </label>
                                            </div>
											<div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="exchange[]" value="4">Vircurex
                                                </label>
                                            </div>
                                        </div>
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