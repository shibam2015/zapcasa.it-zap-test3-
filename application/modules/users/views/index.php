<?php $this->load->view("inc/header");?>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Users
				</div>
				<!-- /.panel-heading -->
				<div style="float:right; padding:10px 10px 10px 10px;"><button class="btn btn-primary btn-xs" type="button" onclick="javascript:window.location.href='<?php echo base_url();?>users/add'">Add User</button></div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>User ID</th>
									<th>Email</th>
									<th>Buy %</th>
									<th>Sell %</th>
									<th>Exchanges</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
					<?php
						if($users != 0){
							foreach($users as $arrUser){
					?>							
								<tr class="odd gradeX">
									<td><?php echo $arrUser->user_id;?></td>
									<td><?php echo $arrUser->email;?></td>
									<td><?php echo $arrUser->buy_per;?></td>
									<td><?php echo $arrUser->sell_per;?></td>	
									<td>
									<?php 
										if($arrUser->isCoinbase == 0){
										 echo 'Coinbase, ';
										}
										if($arrUser->isCryptsy == 0){
										 echo 'Cryptsy, ';
										}
										if($arrUser->isCEX == 0){
										 echo 'CEX, ';
										}
										if($arrUser->isVircurex == 0){
										 echo 'Vircurex ';
										}
									?>
									</td>
									<td align="center">Edit</td>
								</tr>
					<?php
							}
						}
					?>
							</tbody>
						</table>
					</div>
					<!-- /.table-responsive -->
				</div>
				<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->	
</div>
<!-- /#page-wrapper -->
<?php $this->load->view("inc/footer");?>