<?php $this->load->view('inc/header.php'); ?>
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


	<div class="property_report" id="property_report" >
		<div class="publishproperty">
			<table width="95%" border="0" cellspacing="5" cellpadding="0">
				<thead style="color:#1890d2">
					<tr>
				    	<td colspan="2">Number of pubsished properties</td>
				  	</tr>
				  </thead>
				  <tbody>
			  		<?php 
			  			$totalPropertyUserType = 0;
			  			if( count($propertyCountByUserType) > 0 ) { 
							foreach( $propertyCountByUserType as $keyUser=>$valProperty) {
								$propertyCount = count($valProperty);
								$totalPropertyUserType = intval($totalPropertyUserType + $propertyCount);
					?>
								<tr>
					  				<td width="55%;" >By <?php if( $keyUser == 3 ) { ?>Owners <?php } else if( $keyUser == 2 ) { ?>Agencies<?php } else { ?>---<?php } ?></td>
					    			<td align="left"><?php echo $propertyCount; ?></td>	
					    		</tr>	
			  		<?php 
							}
						} 
					?>
					  <tr>
					    <td  width="55%;" ><strong>Total</strong></td>
					    <td align="left"><strong><?php echo $totalPropertyUserType; ?></strong></td>
					  </tr>
				  </tbody>
			</table>
		</div>
		<div class="publishproperty">
			<table width="100%" border="0" cellspacing="5" cellpadding="0">
				<thead style="color:#1890d2">
					<tr>
				    	<td colspan="2">Saved properties</td>
				  	</tr>
			  	</thead>
				  <tbody>
					  <?php 
			  			$totalSavedPropertyUserType = 0;
			  			$totalSavedPropertyAllUserType = 0;
			  			$propertySavedAllUserCount = 0;
			  			
			  			if( count( $getSavedPropertyProperty ) > 0 ) { 
							foreach( $getSavedPropertyProperty as $keySavedProperty=>$valSavedProperty ) {
								$propertySavedCount = count( $valSavedProperty );
								$propertySavedAllUserCount = count( $getSavedProperty[$keySavedProperty] );
								$totalSavedPropertyUserType = intval( $totalSavedPropertyUserType + $propertySavedCount );
								$totalSavedPropertyAllUserType = intval( $totalSavedPropertyAllUserType + $propertySavedAllUserCount );
					?>
								<tr>
					  				<td width="55%;" >By <?php if( $keySavedProperty == 3 ) { ?>Owners <?php } else if( $keySavedProperty == 2 ) { ?>Agencies<?php } else { ?>---<?php } ?></td>
					    			<td align="left" width="200;" ><?php echo $propertySavedCount; ?>     ( total user saved : <?php echo $propertySavedAllUserCount;?> ) </td>	
					    		</tr>	
			  		<?php 
							}
						} 
					?>
					  <tr>
					    <td width="55%;"  ><strong>Total</strong></td>
					    <td align="left" ><strong><?php echo $totalSavedPropertyUserType; ?>     ( Total Saved  &nbsp;&nbsp;&nbsp;&nbsp; : <?php echo $totalSavedPropertyAllUserType;?> ) </strong></td>
					  </tr>
				  </tbody>
			</table>
		</div>
		<div class="print_btn">
			<span><a href="#" id="print_button" >Print</a></span>
		</div>
		<div class="sep_line">
			Date: <?php echo date('d/m/Y'); ?>
		</div>
		<div class="property_buyerlist">
			<table width="100%" border="0" cellspacing="0" cellpadding="5">
				<thead class="heading">
				  <tr>
				    <td>Property Name</td>
				    <td>Posted By user</td>
				    <td>Potential Buyer</td>
				  </tr>
			 	</thead>
			 	<tbody class="propertyListingReport" >
			 		<?php 
			 			if( count($propertyDetails) > 0 ) {
							foreach( $propertyDetails as $property_detail ) {
								$property_name=property_name($property_detail['property_id']);
								$st_name1=get_perticular_field_value('zc_region_master','Province_Code'," and `Province Name` LIKE '%".$property_detail['provience']."%' group by Province_Code");
								$postedByName = property_posted_by($property_detail['property_post_by']);
								$potentialBuyerCount = potential_buyer_count($property_detail['property_post_by']);
								$uid = '';
								if(isset($postedByName['user_id'])){$uid = $postedByName['user_id'];}
								
					?>
						  <tr>
						    <td style="border-right:1px solid #7d7d7d;"><a href="<?php echo base_url()."/property/view_property_details/".$property_detail['property_id'];?>"> <?php echo $property_name;?><?php echo ' in '.$property_detail['city'];?><?php echo ', '.$st_name1; ?> </a></td>
						    <td style="border-right:1px solid #7d7d7d;"><a href="<?php echo base_url()."users/edit_profile/".$uid;?>">&nbsp;<?php if(isset($postedByName['first_name']) && isset($postedByName['last_name'])){echo $postedByName['first_name']." ".$postedByName['last_name']; } ?></a></td>
						    <td style="border-right:1px solid #7d7d7d;">&nbsp;<?php echo $potentialBuyerCount['totalSaved']; ?></td>
						  </tr>
				  <?php 
								
							}
				?>
							<tr>
								<td colspan="3" >
									<div class="row pagination-inbox" >
									    <div class="col-md-12 col-md-offset-5">
									            <ul class="pagination">
									                <?php echo $pagination?>
									            </ul>
									    </div>
									</div>
								</td>
							</tr>	
				<?php 			
						} 
					?>
			  	</tbody>
			</table>
		</div>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>