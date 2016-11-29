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

				    	<td colspan="2">Number of published properties</td>

				  	</tr>

				  </thead>

				  <tbody>
				  	<tr>
						<td width="50%;" >By Owners </td>
						<td align="left"><?php echo $owner_publish_properties; ?></td>	
					</tr>
<tr>
						<td width="50%;" >By Agencies</td>
						<td align="left"><?php echo $agencise_publish_properties; ?></td>	
					</tr>
					<tr>

					    <td  width="50%;" ><strong>Total</strong></td>

					    <td align="left"><strong><?php echo ($owner_publish_properties+$agencise_publish_properties); ?></strong></td>

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

					  				<td width="50%;" >By <?php if( $keySavedProperty == 3 ) { ?>Owners <?php } else if( $keySavedProperty == 2 ) { ?>Agencies<?php } else { ?>---<?php } ?></td>

					    			<td align="left" width="50%;" ><?php echo $propertySavedCount; ?>     ( total user saved : <?php echo $propertySavedAllUserCount;?> ) </td>	

					    		</tr>	

			  		<?php 

							}

						} 

					?>

					  <tr>

					    <td width="50%;"  ><strong>Total</strong></td>

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
										
								$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_detail['contract_id']."'");
								$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' AND typology_id='".$property_detail['typology']."'");
								$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_detail['city']."'");
								$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");

								$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
								
								
								
								
								
								$postedByName = property_posted_by($property_detail['property_post_by']);

								$potentialBuyerCount = potential_buyer_count($property_detail['property_post_by']);

								$uid = '';

								if(isset($postedByName['user_id'])){$uid = $postedByName['user_id'];}

								

					?>

						  <tr>

						    <td style="border-right:1px solid #7d7d7d;">
								<a href="<?php echo base_url()."property/edit_property_details/".$property_detail['property_id'];?>">
									<?php echo stripslashes($proptitle); ?>
								</a>
							</td>

						    <td style="border-right:1px solid #7d7d7d;"><a href="<?php echo base_url()."user/edit_profile/".$uid;?>">&nbsp;<?php if(isset($postedByName['first_name']) && isset($postedByName['last_name'])){echo $postedByName['first_name']." ".$postedByName['last_name']; } ?></a></td>

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

									                <?php echo $pagination; ?>

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