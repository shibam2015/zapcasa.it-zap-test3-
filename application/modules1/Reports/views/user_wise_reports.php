<?php $this->load->view('inc/header.php'); ?>
<style>
	.heading{color:#5d82ea;font-size: 16px;}
</style>
<div class="main-content">		
<script type="text/javascript">
    $(function() {
        // Hook up the print link.
        $("#print_button").attr("href", "javascript:void(0)").click(function() {
            // Print the DIV.
           var prtContent = document.getElementById("property_report");
			var WinPrint = window.open();
			WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();
			WinPrint.close();
            return(false);
        });
    });
</script>
<h3><?php
		if( isset( $title_en) )
		{
			print $title_en;
		}else{
			print "	ZAPCASA | Dashboard";
		}
	?></h3>
<hr />
<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>
	<div class="property_report" >
		<div class="print_btn">
			<span><a href="#" id="print_button" >Print</a></span>
		</div>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="property_report" >
		  <tr>
		    <td>
		    	<table width="100%" border="0" cellspacing="5" cellpadding="0" class="heading">
		          <tr>
		            <td><strong>Number of Uses</strong></td>
		            <td><strong>New users</strong>
		            <?php 
		            	$todayDate = date('d-m-Y');
		            	$toDateArr = strtotime(date("Y-m-d", strtotime($todayDate)) . " -7 days");
		            	$toDate = date('d-m-Y' ,$toDateArr);
		            ?>
		             from <?php echo $toDate;?> - to <?php echo $todayDate; ?></td>
		          </tr>
				</table>
		    </td>
		  </tr>
		  <tr>
		    <td>
		    	<table width="40%" border="0" cellspacing="5" cellpadding="0">
		    		<?php if( count( $resultForUserWise ) > 0 ) { ?>
		    		<?php 
		    			$totalPropertyUserType = 0;
		    			$totalnewUserInDateInterval = 0;
		    			foreach( $resultForUserWise as $keyUser=>$valProperty) {
		    				$propertyCount = count($valProperty);
		    				$totalPropertyUserType = intval($totalPropertyUserType + $propertyCount);
		    				
		    				if( isset($resultForJoiningDate[$keyUser]) && ($resultForJoiningDate[$keyUser] != '' ) ) {
		    					$newUserInDateInterval = count( $resultForJoiningDate[$keyUser] );
							} else {
								$newUserInDateInterval = 0;
							}
							$totalnewUserInDateInterval = intval($totalnewUserInDateInterval + $newUserInDateInterval);
								    				
		    		?>
		    				<tr>
					            <td width="100" ><?php if( $keyUser == 1 ){ echo "Individual"; } elseif ( $keyUser == 2 ){ echo "Owners"; } elseif ( $keyUser == 3 ){ echo "Agencies"; } else { echo "---"; } ?></td>
					            <td align="left"><?php echo $propertyCount; ?></td>
					            <td align="center"><?php echo $newUserInDateInterval; ?></td>
					        </tr>
		    		<?php		
		    			}	
		    		?>
			          <tr>
			            <td width="100" ><strong>Total</strong></td>
			            <td align="left"><strong><?php echo $totalPropertyUserType;?></strong></td>
			            <td align="center"><strong><?php echo $totalnewUserInDateInterval;?></strong></td>
			          </tr>
		          
		          <?php } else { ?>
		          		<tr>
				            <td>Individual</td>
				            <td align="right">0</td>
				            <td align="right">0</td>
				          </tr>
				          <tr>
				            <td>Owners</td>
				            <td align="right">0</td>
				            <td align="right">0</td>
				          </tr>
				          <tr>
				            <td>Agencies</td>
				            <td align="right">0</td>
				            <td align="right">0</td>
				          </tr>
				          <tr>
				            <td><strong>Total</strong></td>
				            <td align="right"><strong>0</strong></td>
				            <td align="right"><strong>0</strong></td>
				          </tr>
		          <?php } ?>
		        </table>
		    </td>
		  </tr>
		</table>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>