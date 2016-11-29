<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places"></script>
<script type="text/javascript">

$(document).ready(function()
{
	var search_title='<?php echo $search_title;?>';
	//alert(search_title);
	typology_adjustment(search_title);
	
	
	$('#login-trigger').click(function(){
    $(this).next('#login-content').slideDown(350);
	//$(this).next('#login-content2').slideToggle();
	$('#login-content2').hide();
	$('#login-content3').hide();
	$('#login-content4').hide();
	$('#login-content5').hide();
	
	
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
      //else $(this).find('span').html('&#x25BC;')
    })
	$('#login-trigger2').click(function(){
    $(this).next('#login-content2').slideToggle();
	$('#login-content').hide();
	$('#login-content1').hide();
	$('#login-content3').hide();
	$('#login-content4').hide();
	$('#login-content5').hide();
	//$(this).next('#login-content2').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
     // else $(this).find('span').html('&#x25BC;')
    })
	$('#login-trigger3').click(function(){
    $(this).next('#login-content3').slideToggle();
	$('#login-content').hide();
	$('#login-content1').hide();
	$('#login-content2').hide();
	$('#login-content4').hide();
	$('#login-content5').hide();
	//$(this).next('#login-content2').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
      //else $(this).find('span').html('&#x25BC;')
    })
	$('#login-trigger4').click(function(){
	$('#login-content').hide();
	$('#login-content1').hide();
	$('#login-content2').hide();
	$('#login-content3').hide();
	$('#login-content5').hide();
    $(this).next('#login-content4').slideToggle();
	//$(this).next('#login-content2').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
     // else $(this).find('span').html('&#x25BC;')
    })
	$('#login-trigger5').click(function(){
		$('#login-content').hide();
		$('#login-content1').hide();
	$('#login-content2').hide();
	$('#login-content3').hide();
	$('#login-content4').hide();
    $(this).next('#login-content5').slideToggle();
	//$(this).next('#login-content2').slideToggle();
    $(this).toggleClass('active');          
    
    if ($(this).hasClass('active')) $(this).find('span').html('&#x25BC;')
      //else $(this).find('span').html('&#x25BC;')
    })
	
	/*$('body').click(function(){
    	$('#login-content').hide();
	});*/
	
	 $(document).mouseup(function(e) {
		var closediv = $("#login-content");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			
			$("#login-trigger").removeClass('active');
			
			
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content2");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			
			$("#login-trigger2").removeClass('active');
			
			
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		
		var closediv = $("#login-content3");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			
			$("#login-trigger3").removeClass('active');
			
			
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content4");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			
			$("#login-trigger4").removeClass('active');
			
			
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		var closediv = $("#login-content5");
		if (closediv.has(e.target).length == 0) {
			closediv.hide();
			
			$("#login-trigger5").removeClass('active');
			
			
			//$("#login-trigger").find('span').html('&#x25BC;')
		}
		
		
	});
	
	/*$('.dp-content').mouseout(function(e){
		//alert(e.relatedTarget.nodeName);
		if(e.relatedTarget.nodeName != 'TD'){
		$(this).slideUp();
		}
	});*/

});
function typology_adjustment(str){
	//alert(str);
		//document.getElementById('typology').selectedIndex = 0;
		var selected_typology = $("#selected_typology").val();
 		if((str!=0)&&(str!="Business") && (str!="Luxury")){
 			$.post("<?php echo base_url(); ?>property_search/getTypology", { category : str , selected_typology : selected_typology},
 			function(result){
 				 // $("#typology").html(result);
				 $("#typologys").html(result);
 			});
 		}
	}
$(document).ready( function() {
	<?php if( isset( $_GET['for_luxury'] ) &&( $_GET['for_luxury'] != "" ) ) { ?>
		typology_adjustment('<?php echo $_GET['for_luxury']; ?>');
	<?php } ?>
});	

	
function initialize() {
	var input = document.getElementById('add_neighbour_zip');
	//var options = {componentRestrictions: {country: 'ind'}};            
	//new google.maps.places.Autocomplete(input);
}
google.maps.event.addDomListener(window, 'load', initialize);

</script>
<?php //echo $search_title;?>
               <?php
  		 $attributes = array('class' => 'form', 'id' => 'form_order','method' => 'GET' );
		echo form_open_multipart('property_search/serach_filter', $attributes);
?>
  <div class="searchbig">
         <input type="text" name="add_neighbour_zip" id="add_neighbour_zip" placeholder='<?php echo $this->lang->line('search_header_location_field');?>' value="<?php echo isset( $_GET['add_neighbour_zip'] ) ? $_GET['add_neighbour_zip'] : ''; ?>"  >
            
  </div>
<div class="multiplesearch">
<?php 		$segs = $this->uri->segment_array();
			$property_cat_code='ALL';
			$categoryCode = 'All';	

			if ( isset($segs) && ( count($segs) == 1 ) ) {
				foreach ($segs as $segment) {
					if($segment=='Residential') {
						$cat_code='Residential';
					}
					if($segment=='Business') {
						$cat_code='Business';
					}
					if($segment=='Rooms') {
						$cat_code='Rooms';
					}
					if($segment=='Land') {
						$cat_code='Land';
					}
					if($segment=='Vacations') {
						$cat_code='Vacations';
					}
					if($segment=='Property') {
						$cat_code='Property';
					}
					if($segment=='Luxury'){
						$cat_code='Luxury';
					}
					$this->session->set_userdata('category_code', $cat_code);
				}
			} else if ( isset($segs) && ( count($segs) == 2 ) && ( $segs[1] != "property_search") ) {
					$cat_code = $segs[1];
					$this->session->set_userdata('category_code', $cat_code);
			} else if ( isset($segs) && ( count($segs) > 1 ) && ( $segs[1] == "property_search") ) {
					if( isset( $_GET['property_cat'] ) ) {
						$cat_code=$_GET['property_cat'];
					} else {
						$cat_code = "All";
						if( isset($_GET['category_id']) ) {
							$category_id = $_GET['category_id'];
							if($category_id =='2') {
								$cat_code='Business';	
							} if($category_id=='1') {
								$cat_code='Residential';
							} if($category_id=='4') {
								$cat_code='Land';
							} if($category_id=='10') {
								$cat_code='Luxury';
							}
						}
					}
					$this->session->set_userdata('category_code', $cat_code);
			} else {
				$property_cat_code = $this->session->userdata("category_code");
				$this->session->set_userdata('category_code', $property_cat_code);
			}	
?>
				<input type="hidden" name="property_cat" value="<?php echo $this->session->userdata("category_code");?>" >
                <input type="hidden" name="save_search_id" id="save_search_id" value="<?php echo isset( $_GET['save_search_id'] ) ? $_GET['save_search_id'] : 0; ?>" >
                 <div class="customsearch">
                 <!--	<div class="filter_name">Basic Filters</div>-->
                    <!--<select name="">
                        <option value="0">Listing Type</option>
                        <option value="0">Listing Type</option>
                        <option value="0">Listing Type</option>
                        <option value="0">Listing Type</option>
                        <option value="0">Listing Type</option>
                    </select>-->
                    <?php
                    $rs_counts = array();
                    $rs_counts = get_all_basic_search_value('zc_property_details',$this->session->userdata("category_code"));
                    $for_sale = 0;
                    $for_rent = 0;
                    $by_agency = 0;
                    $by_owner = 0;
                    $to_be_renovated = 0;
                    $good = 0;
                    $renovated = 0;
                    $new_under_construction = 0;
                    
                    if( count( $rs_counts ) > 0 ){
						foreach ( $rs_counts as $key_property=>$val_property) {
							if( $val_property['contract_id'] == 1  ) {
								$for_rent++;
							} if( $val_property['contract_id'] == 2  ) {
								$for_sale++;
							} if( $val_property['property_post_by_type'] == 2  ) {
								$by_owner++;
							} if( $val_property['property_post_by_type'] == 3  ) {
								$by_agency++;
							} if( $val_property['status'] == 1  ) {
								$to_be_renovated++;
							} if( $val_property['status'] == 2  ) {
								$good++;
							} if( $val_property['status'] == 3  ) {
								$renovated++;
							} if( $val_property['status'] == 4  ) {
								$new_under_construction++;
							}
						}	
					}
					
					if( isset ( $_GET['typology'] ) ) {
						$selected_typology = 0;
						$cnt = 0;
						for($i=0 ;$i< count( $_GET['typology'] ); $i++) {
							if( $cnt == 0 ) {
								$selected_typology = $_GET['typology'][$i];
								$cnt++;
							} else {
								$selected_typology = $selected_typology.",".$_GET['typology'][$i];
							}
						}
					}
					
                    ?>
                    <div class="filter_id">
                    <input type="hidden" id="selected_typology" value="<?php echo isset( $selected_typology ) ? $selected_typology : 0; ?>" >
                      <ul>
                        <li id="login">
                          <a id="login-trigger" href="#">
                            <?php echo $this->lang->line('search_header_basic_filter');?><span style="font-size:10px; padding-left:5px;"><?php echo '&#x25BC;';?></span>
                          </a>
                          <div id="login-content" class="dp-content">
                            
                              <div class="basic_div_part">
                              		<table width="100%">
                                      <?php
                                      $for_sale_val = 0;
                                      $for_rent_val = 0;
                                      $by_agency_val = 0;
                                      $by_owner_val = 0;
                                      $to_be_renovated_val = 0;
                                      $good_val = 0;
                                      $renovated_val = 0;
                                      $new_under_construction_val = 0;
                                      
                                      if( isset ( $_GET['contract_type'] ) ) {
                                      	$contract_type = $_GET['contract_type'];
                                      	
                                      	if( count($contract_type) > 0 ) {
											if( count($contract_type) == 1 ) {
												if( $contract_type[0] == 1 ) {
													$for_rent_val = $contract_type[0];
												} if( $contract_type[0] == 2 ) {
													$for_sale_val = $contract_type[0];
												}
											} else {
		                                      	$for_sale_val = isset( $contract_type[0] ) ? $contract_type[0] : 0;
												$for_rent_val = isset( $contract_type[1] ) ? $contract_type[1] : 0;	
											}
										}	
                                      } if( isset ( $_GET['posted_by'] ) ) {
                                      	$posted_by = $_GET['posted_by'];
                                      	if( count($posted_by) > 0 ) {
											if( count($posted_by) == 1 ) {
												if( $posted_by[0] == 3 ) {
													$by_agency_val = $posted_by[0];
												} if( $posted_by[0] == 2 ) {
													$by_owner_val = $posted_by[0];
												}
											} else {
												$by_agency_val = isset( $posted_by[0] ) ? $posted_by[0] : 0;
												$by_owner_val = isset( $posted_by[1] ) ? $posted_by[1] : 0;
											}
                                      	}
                                      	
                                      } if( isset ( $_GET['status'] ) ) {
                                      	$status = $_GET['status'];
                                      	if( count($status) > 0 ) {
											if( count($status) == 1 ) {
												if( $status[0] == 1 ) {
													$to_be_renovated_val = $status[0];
												} if( $status[0] == 2 ) {
													$good_val = $status[0];
												} if( $status[0] == 3 ) {
													$renovated_val = $status[0];
												} if( $status[0] == 4 ) {
													$new_under_construction_val = $status[0];
												}
											} else {
	                                      		$to_be_renovated_val = isset( $status[0] ) ? $status[0] : 0;
	                                      		$good_val = isset( $status[1] ) ? $status[1] : 0;
	                                      		$renovated_val = isset( $status[2] ) ? $status[2] : 0;
	                                      		$new_under_construction_val = isset( $status[3] ) ? $status[3] : 0;
                                      		}
                                      	}	
                                    } 
                                    if($search_title!='Rooms')
									  {
									?>
                                    	<tbody>
                                        	<td>
                                                <span><input type="checkbox" id="contract" name="contract_type[]" value="2" <?php if( $for_sale_val != 0 ) { echo "checked"; } ?>/></span> 
                                                <span><img src="<?php echo base_url();?>assets/images/orenge_mark.png" alt="" /></span>
                                                <span> <?php echo $this->lang->line('search_header_for_sale');?></span>
                                            </td>
                                            <td class="basic_imount">( <?php echo $for_sale; ?> )</td>
                                        </tbody>
                                         <?php
									  }
									  if($search_title=='Rooms')
									  {
										  $style="style='display:none';";
										  $check="checked='checked'";
									  }
									  else
									  {
										 $style="";
										  $check=""; 
									  }
									?>  
                                        <tbody <?php echo $style;?>>
                                     
                                        	<td>
                                                <span><input type="checkbox" id="contract" name="contract_type[]" value="1" onclick="return check_param();" <?php echo $check;?> <?php if( $for_rent_val != 0 ) { echo "checked"; } ?>/></span> 
                                                <span><img src="<?php echo base_url();?>assets/images/blue_mark.png" alt="" /></span>
                                                <span><?php echo $this->lang->line('search_header_for_rent');?></span>
                                            </td>
                                            <td class="basic_imount">( <?php echo $for_rent; ?> )</td>
                                        </tbody>
                                        <tbody>
                                        	<td>
                                                <span><input type="checkbox" name="posted_by[]" value="3" <?php if( $by_agency_val != 0 ) { echo "checked"; } ?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_by_agency');?></span>
                                            </td>
                                            <td class="basic_imount">( <?php echo $by_agency; ?> )</td>
                                        </tbody>
                                        
                                        <tbody>
                                        	<td>
                                                <span><input type="checkbox" name="posted_by[]" value="2" <?php if( $by_owner_val != 0 ) { echo "checked"; } ?>/></span> 
                                                <span><?php echo $this->lang->line('search_header_by_owner');?></span>
                                            </td>
                                            <td class="basic_imount">( <?php echo $by_owner; ?> )</td>
                                        </tbody>
                                     
                                     <?php 
									  if($search_title=='Residential' || $search_title=='Vacations' )
									  {
										  $rs_statuses=get_all_value('zc_status_of_property');
										 
									 ?>   
                                     	<tbody>
                                        	<td colspan="2">
                                               <hr>
                                            </td>
                                            
                                        </tbody>
                                    <?php
                                     foreach($rs_statuses as $rs_status)
									 {
									?>
                                    <tbody>
                                        	<td>
                                                <span><input type="checkbox" name="status[]" value="<?php echo $rs_status['id'];?>"
                                                <?php 
									 				if( $rs_status['id'] == 1 ) {
														if( $to_be_renovated_val != 0 ) { echo "checked"; }
													} if( $rs_status['id'] == 2 ) {
														if( $good_val != 0 ) { echo "checked"; }
													} if( $rs_status['id'] == 3 ) {
														if( $renovated_val != 0 ) { echo "checked"; }
													} if( $rs_status['id'] == 4 ) {
														if( $new_under_construction_val != 0 ) { echo "checked"; }
													}
                                                ?>
                                                /></span> 
                                                <span><?php echo $rs_status['name'];?></span>
                                            </td>
                                            <td class="basic_imount">
                                            	( <?php 
                                            		if( $rs_status['id'] == 1 ) {
														echo $to_be_renovated;
													} if( $rs_status['id'] == 2 ) {
														echo $good;
													} if( $rs_status['id'] == 3 ) {
														echo $renovated;
													} if( $rs_status['id'] == 4 ) {
														echo $new_under_construction;
													}
                                            	?> )
                                            </td>
                                        </tbody>
                                        <?php
									 }
									  }
										?>
                                        <?php
                                          if($search_title=='Business')
										  {
										?>
                                        <!--<tbody>
                                        	<td colspan="2">
                                               <hr>
                                            </td>
                                            
                                        </tbody>
                                         <tbody>
                                        	<td>
                                                <span><input type="radio" name="category" value="PRO" onclick="return typology_adjustment(this.value);"></span> 
                                                <span>Property For Business</span>
                                            </td>
                                            <td class="basic_imount">(86k)</td>
                                        </tbody>
                                         <tbody>
                                        	<td>
                                                <span><input type="radio" name="category" value="BLI" onclick="return typology_adjustment(this.value);" ></span> 
                                                <span>Business License</span>
                                            </td>
                                            <td class="basic_imount">(86k)</td>
                                        </tbody>-->
                                        <?php
										  }
										?>
                                    </table>
                              </div>
                           
                          </div>                     
                        </li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                </div>
                <div class="customsearch">
                    <!--<select name="">
                        <option value="0">Any Price</option>
                        <option value="0">For Rent</option>
                        <option value="0">For Rent</option>
                        <option value="0">For Rent</option>
                        <option value="0">For Rent</option>
                    </select>-->
                    
                    <div class="filter_id">
                      <ul>
                        <li id="login">
                          <a id="login-trigger2" href="#">
                            <?php echo $this->lang->line('search_header_any_price');?><span style="font-size:10px; padding-left:5px;">▼</span>
                          </a>
                          <div id="login-content2" class="dp-content">
                           
                              <div class="basic_div_part">
                              		<fieldset id="inputs">
                                        <input type="text" placeholder="<?php echo $this->lang->line('search_header_any_price_min');?>" name="min_price" id="min_price" value="<?php echo isset( $_GET['min_price'] ) ? $_GET['min_price'] : ''; ?>" >
                                        <input type="text" placeholder="<?php echo $this->lang->line('search_header_any_price_max');?>" name="max_price" id="max_price" value="<?php echo isset( $_GET['max_price'] ) ? $_GET['max_price'] : ''; ?>">
                                    </fieldset>
                              </div>
                           
                          </div>                     
                        </li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                </div>
                <?php
                  if($search_title!='Rooms' && $search_title!='Land' )
									  {
				?>
                <div class="customsearch">
                    <!--<select name="">
                        <option value="0">0+ Beds</option>
                        <option value="0">1+ Beds</option>
                        <option value="0">2+ Beds</option>
                        <option value="0">3+ Beds</option>
                        <option value="0">4+ Beds</option>
                    </select>-->
                    <div class="filter_id">
                      <ul>
                        <li id="login">
                          <a id="login-trigger3" href="#">
                            <?php echo $this->lang->line('search_header_rooms_number');?><span style="font-size:10px; padding-left:5px;">▼</span>
                          </a>
                          <div id="login-content3" class="dp-content">
                            
                              <div class="basic_div_part">
                              		<fieldset id="inputs">
                                        <input type="text" placeholder="<?php echo $this->lang->line('search_header_rooms_number_min');?>" name="min_room" id="min_room" value="<?php echo isset( $_GET['min_room'] ) ? $_GET['min_room'] : ''; ?>" >
                                        <input type="text" placeholder="<?php echo $this->lang->line('search_header_rooms_number_max');?>" name="max_room" id="max_room" value="<?php echo isset( $_GET['max_room'] ) ? $_GET['max_room'] : ''; ?>" >
                                    </fieldset>
                              </div>
                            
                          </div>                     
                        </li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                </div>
                <?php
									  }
				?>
                <div class="customsearch">
                    <!--<select name="">
                        <option value="0">Home Type</option>
                        <option value="0">Houses</option>
                        <option value="0">Apartments</option>
                        <option value="0">Condos/co-ops</option>
                        <option value="0">Townhomes</option>
                    </select>-->
                    <div class="filter_id">
                   		<?php 
                   			$selected_typology = 0;
                   			if( isset( $_GET['typology'] ) ) {
								$cnt = 0;
								for( $i=0 ; $i < count( $_GET['typology'] );$i++ ) {	
									if( $cnt == 0) {
										
									}
								}	
							}
                   		?>
                      <ul>
                        <li id="login">
                          <a id="login-trigger4" href="#">
                            <?php echo $this->lang->line('search_header_typology');?><span style="font-size:10px; padding-left:5px;">▼</span>
                          </a>
                          <div id="login-content4" class="dp-content">
                           
                              <div class="basic_div_part" style="overflow-y: scroll; height:200px;">
                              		<div id="typology">
													 <?php
                                          if($search_title=='Business')
										  {
										?>
                                        <fieldset id="inputs">
                                            <select name="for_luxury" onchange="return typology_adjustment(this.value);" style="width:223px;">
                                            	<option value=""><?php echo $this->lang->line('search_header_typology_business_select');?></option>
                                                <option value="PRO" <?php if( isset( $_GET['for_luxury'] ) &&( "PRO" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_property_for_business');?></option>
                                                <option value="BLI" <?php if( isset( $_GET['for_luxury'] ) &&( "BLI" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_business_license');?></option>
                                            </select>
                                        </fieldset>
                                        <?php
										  }
										  if($search_title=='Luxury')
										  {
										?>
                                        <fieldset id="inputs">
                                            <select name="for_luxury" onchange="return typology_adjustment(this.value);" style="width:223px;">
                                            <option value=""><?php echo $this->lang->line('search_header_typology_luxury_select');?></option>
                                           		 <option value="Residential" <?php if( isset( $_GET['for_luxury'] ) &&( "Residential" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_residential');?></option>
                                                <option value="PRO" <?php if( isset( $_GET['for_luxury'] ) &&( "PRO" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_property_for_business');?></option>
                                                <option value="BLI" <?php if( isset( $_GET['for_luxury'] ) &&( "BLI" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_business_license');?></option>
                                                <option value="Vacations" <?php if( isset( $_GET['for_luxury'] ) &&( "Vacations" == $_GET['for_luxury'] ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_typology_luxury_vacations');?></option>
                                            </select>
                                        </fieldset>
                                        <?php
										  }
										?>
                                    
                                        
                                     </div>  
                                     <div id="typologys"></div> 
                              </div>
                           
                          </div>                     
                        </li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                </div>
                <div class="customsearch">
                    <!--<select name="">
                        <option value="0">More</option>
                        <option value="0">More</option>
                        <option value="0">More</option>
                        <option value="0">More</option>
                        <option value="0">More</option>
                    </select>-->
                    <div class="filter_id">
                      <ul>
                        <li id="login">
                          <a id="login-trigger5" href="#">
                            <?php echo $this->lang->line('search_header_more');?><span style="font-size:10px; padding-left:5px;">▼</span>
                          </a>
                          <div id="login-content5" class="dp-content">
                            
                              <div class="basic_div_part">
                              
                              		<table width="100%">
                                    <?php
                                         if($search_title!='Rooms' && $search_title!='Business' && $search_title!='Land' )
									  {
										
										?>
                                        	<tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_bathrooms');?> 
                                               </td>
                                               <td>
                                               <?php $bathroomArray = array('all'=>'All','No'=>'No','1'=>'1','2'=>'2','3'=>'3','>3'=>'>3'); ?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="bathrooms_no">
                                                         <?php foreach( $bathroomArray as $key=>$val) {?>
                                                               <option value="<?php echo $key; ?>" <?php if( isset( $_GET['bathrooms_no'] ) &&( $key == $_GET['bathrooms_no'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                         <?php } ?>
                                                            
                                                       </select>
                                                   </fieldset>     
                                               </td>
                                            </tr>
                                    	
                                        <?php
									  }
										?>
                                     <?php
                                         if($search_title!='Rooms' )
									  {
										?>
                                        	<tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_square_meters');?>
                                               </td>
                                               <td>
                                                <fieldset id="inputs">
                                                   <input type="text"  placeholder="Min" name="min_surface_area" id="min_surface_area"  style="width:50px;" value="<?php echo isset( $_GET['min_surface_area'] ) ? $_GET['min_surface_area'] : '';?>" >
                                                       -
                                                       <input type="text"  placeholder="Max" name="max_surface_area" id="max_surface_area" style="width:50px;" value="<?php echo isset( $_GET['max_surface_area'] ) ? $_GET['max_surface_area'] : '';?>" >
                                                   </fieldset>    
                                               </td>
                                            </tr>
                                        <?php
                                       								  }
										?>  <?php
                                         if($search_title=='Vacations' )
									  {
										?>
                                        	<tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_bed_no');?> 
                                               </td>
                                               <td>
                                                <fieldset id="inputs">
                                                   <input type="text" placeholder="Min" name="min_beds_no" id="min_beds_no" style="width:50px;" value="<?php echo isset( $_GET['min_beds_no'] ) ? $_GET['min_beds_no'] : '';?>" >
                                                       -
                                                       <input type="text" placeholder="Max" name="max_beds_no" id="max_beds_no"  style="width:50px;" value="<?php echo isset( $_GET['max_beds_no'] ) ? $_GET['max_beds_no'] : '';?>" >
                                                   </fieldset>    
                                               </td>
                                            </tr>
                                        <?php
									  }
									  ?>
                                        <?php
                                         if($search_title!='Rooms' )
									  {
										?> 
                                           <tr>
                                                <td>
                                                      <?php echo $this->lang->line('search_header_kind_of_property');?>
                                                  </td>
                                                  <td>
                                                  <?php $kind_of_propertys=get_all_value('zc_kind_of_property');?>
                                                   <fieldset id="inputs">
                                                         <select style="width:137px;" name="kind">
                                                          <option value="all" <?php if( isset( $_GET['kind'] ) &&( $_GET['kind'] == "all" ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_kind_of_property_all');?></option>
                                                           <?php
                                                            foreach($kind_of_propertys as $kind_of_property)
                                               {
                                             ?>
                                                          <option value="<?php echo $kind_of_property['id'];?>"  <?php if( isset( $_GET['kind'] ) &&( $kind_of_property['id'] == $_GET['kind'] ) ) { echo "selected"; }?> ><?php echo $kind_of_property['name'];?></option>
                                                          <?php
                                               }
                                             ?>
                                                          </select>
                                                      </fieldset>     
                                                  </td>
                                               </tr>
                                        <?php
									  }
										?>
                                         <?php
                                         if($search_title!='Rooms' && $search_title!='Land' )
									  {
										?>
                                           <tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_energy_class');?> 
                                               </td>
                                               <td>
                                               <?php $energy_classes=get_all_value('zc_energy_efficiency_class');?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="energyclass">
                                                       <option value="all" <?php if( isset( $_GET['energyclass'] ) &&( $_GET['energyclass'] == "all" ) ) { echo "selected"; }?> ><?php echo $this->lang->line('search_header_energy_class_all');?> </option>
                                                          <?php
                                                         foreach($energy_classes as $energy_class)
                                            {
                                          ?>
                                                       <option value="<?php echo $energy_class['id'];?>" <?php if( isset( $_GET['energyclass'] ) &&( $energy_class['id'] == $_GET['energyclass'] ) ) { echo "selected"; }?> ><?php echo $energy_class['name'];?></option>
                                                       <?php
                                            }
                                          ?>
                                                       </select>
                                                   </fieldset>    
                                               </td>
                                           </tr>
                                        
                                          <?php
									  }
										?>
                                        <?php
                                         if($search_title=='Residential')
									  {
										?>
                                             <tr>
                                                <td>
                                                     <?php echo $this->lang->line('search_header_heating');?> 
                                                  </td>
                                                  <td>
                                                   <?php $heatingArray = array('all'=>'All','No'=>'No','Autonomous'=>'Autonomous','Centralized'=>'Centralized'); ?>
                                                   <fieldset id="inputs">
                                                         <select style="width:137px;" name="heating">
                                                         <?php foreach( $heatingArray as $key=>$val) {?>
                                                                  <option value="<?php echo $key; ?>" <?php if( isset( $_GET['heating'] ) &&( $key == $_GET['heating'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                         <?php } ?>
                                                          </select>
                                                      </fieldset>     
                                                  </td>
                                                </tr>
                                        <?php
									  }
										?>
                                         <?php
                                     if($search_title=='Rooms' || $search_title=='Residential' || $search_title=='Business' || $search_title=='Vacations')
									  {
									?>
                                        	<tr>
                                             <td>
                                                   <?php echo $this->lang->line('search_header_parking');?> 
                                               </td>
                                               <td>
                                               <?php $parkingArray = array('all'=>'All','No'=>'No','Cargarage'=>'Car garage','Parking'=>'Parking'); ?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="parking">
                                                         <?php foreach( $parkingArray as $key=>$val) {?>
                                                               <option value="<?php echo $key; ?>" <?php if( isset( $_GET['parking'] ) &&( $key == $_GET['parking'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                      <?php } ?>
                                                       </select>
                                                   </fieldset>     
                                               </td>
                                            </tr>
                                      <?php
									  }
									  ?>  
                                             <?php
                                     if($search_title=='Rooms' || $search_title=='Residential')
									  {
									?>
                                        	<tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_furnished');?> 
                                               </td>
                                               <td>
                                               <?php $furnishedArray = array('all'=>'All','No'=>'No','Yes'=>'Yes','Partly'=>'Partly'); ?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="furnished">
                                                         <?php foreach( $furnishedArray as $key=>$val) {?>
                                                            <option value="<?php echo $key; ?>" <?php if( isset( $_GET['furnished'] ) &&( $key == $_GET['furnished'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                      <?php } ?>
                                                       </select>
                                                   </fieldset>     
                                               </td>
                                            </tr>
                                        <?php
									  	}
										?>
                                             <?php
                                     if($search_title=='Rooms')
									  {
									?>
                                        	<tr>
                                             <td>
                                                  <?php echo $this->lang->line('search_header_roommates');?> 
                                               </td>
                                               <td>
                                               <?php $roommatesArray = array('all'=>'All','Only women'=>'Only women','Only Men'=>'Only Men','Men and women'=>'Men and women'); ?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="roommates">
                                                       <?php foreach( $roommatesArray as $key=>$val) {?>
                                                            <option value="<?php echo $key; ?>" <?php if( isset( $_GET['roommates'] ) &&( preg_replace('/\s+/','', $key ) == preg_replace('/\s+/','', urldecode($_GET['roommates'])) ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                      <?php } ?>
                                                       </select>
                                                   </fieldset>     
                                               </td>
                                            </tr>
                                        	<tr>
                                             <td>
                                                   <?php echo $this->lang->line('search_header_occupation');?>
                                               </td>
                                               <td>
                                               <?php $occupationArray = array('all'=>'All','Only students'=>'Only students','Only workers'=>'Only workers','Students and workers'=>'Students and workers'); ?>
                                                <fieldset id="inputs">
                                                      <select style="width:137px;" name="occupation">
                                                       <?php foreach( $occupationArray as $key=>$val) {?>
                                                            <option value="<?php echo $key; ?>" <?php if( isset( $_GET['occupation'] ) &&( $key == $_GET['occupation'] ) ) { echo "selected"; }?> ><?php echo $val; ?></option>
                                                      <?php } ?>
                                                       </select>
                                                   </fieldset> 
                                               </td>
                                            </tr>
                                        <?php }?>
                                    </table>    
                              </div>
                              <?php
							    if($search_title!='Land' &&  $search_title!='Luxury' )
							  {
							  ?>
                              <div class="basic_div_part">
                              <hr>
                              
                              		 <?php echo $this->lang->line('search_header_show_only_with');?>
                                    <table width="100%">
                                    <?php
                                     if($search_title=='Rooms')
									  {
									?>
                                     <tr>
                                        	<td>
                                                <span><input type="checkbox" name="smokers" value="1" <?php if( isset( $_GET['smokers'] ) &&( $_GET['smokers'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_smokers_allowed');?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                                <span><input type="checkbox" name="pets" value="1" <?php if( isset( $_GET['pets'] ) &&( $_GET['pets'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_pets_allowed');?></span>
                                            </td>
                                        </tr>
                                        
                                    <?php
									  }
									?>
                                     <?php
                                     if($search_title=='Vacations' || $search_title=='Residential'|| $search_title=='Business')
									  {
									?>
                                    <tr>
                                        	<td>
                                                <span><input type="checkbox" name="elevator" value="1" <?php if( isset( $_GET['elevator'] ) &&( $_GET['elevator'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_elevator');?></span>
                                            </td>
                                        </tr>
                                     <?php
									  }
									 ?>   
                                     <?php
                                     if($search_title=='Vacations' || $search_title=='Residential')
									  {
									?>
                                    	
                                     
                                       
                                        <tr>
                                        	<td>
                                                <span><input type="checkbox" name="air_conditioning" value="1" <?php if( isset( $_GET['air_conditioning'] ) &&( $_GET['air_conditioning'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_air_conditioning');?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                                <span><input type="checkbox" name="garden" value="1" <?php if( isset( $_GET['garden'] ) &&( $_GET['garden'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_garden');?></span>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td>
                                                <span><input type="checkbox" name="terrace" value="1" <?php if( isset( $_GET['terrace'] ) &&( $_GET['terrace'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_terrace');?></span>
                                            </td>
                                        </tr>
                                         <?php
									  }
                                     ?> 
                                     <?php
                                     if($search_title=='Vacations' || $search_title=='Residential'|| $search_title=='Rooms')
									  {
									?> 
                                     <tr>
                                        	<td>
                                                <span><input type="checkbox" name="balcony" value="1" <?php if( isset( $_GET['balcony'] ) &&( $_GET['balcony'] == "1" ) ) { echo "checked"; }?> /></span> 
                                                <span><?php echo $this->lang->line('search_header_balcony');?></span>
                                            </td>
                                        </tr>
                                    <?php
									  }
									?>    
                                        
                                    </table>    
                              </div>
                              <?php }?>
                            
                          </div>                     
                        </li>
                      </ul>
                      <div class="clear"></div>
                    </div>
                </div>
                
                <?php
                 if($search_title=='Rooms')
				 {
				?>
                <div class="bottom_btnbar" style="float:right;margin-top:-1px;">
               	 <input type="submit" name="search" value="<?php echo $this->lang->line('search_header_button_search');?>">
                 <!--<input type="button"  id="save_search" name="search" value="Save Search" >-->
                 
                 <?php
				 if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0')
				   {
				 ?>
                 <a class="save_search" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
                 <?php
				   }
				   else
				   {
				 ?>
                 <a class="save_search_poup" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
                 <?php
				   }
				 ?>
                </div>
               <?php
				 }
				 else
				 {
			   ?>
                <div class="bottom_btnbar" style="float:right;margin-top:-10px;">
               	 <input type="submit" name="search" value="<?php echo $this->lang->line('search_header_button_search');?>">
                 <?php
				 if($this->session->userdata( 'user_id' )!='' || $this->session->userdata('user_id')!='0') {
				 ?>
                 	<a class="save_search" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
                 <?php
				   } else {
				 ?>
                 	<a class="save_search_poup" href="javascript:void(0);"><?php echo $this->lang->line('search_header_save_search');?></a>
                 <?php
				   }
				 ?>
                <!-- <a class="save_search" href="javascript:void(0);">Save Search</a>-->
              <!--    <a href="javascript:void(0)" class="save_search">Save Search</a>-->
                <!-- <input type="button" id="save_search" name="search" value="Save Search" >-->
                 <!--<a href="#fancybox" class="fancybox">Link to open fancybox</a>-->
                </div>
               <?php
				 }
			   ?>
               <?php $segs = $this->uri->segment_array();?>
               <input type="hidden" name="category_search" value="<?php if(isset($search_title)){ echo $search_title;}else{echo $segs[1];}?>" />
               <input type="hidden" name="ordering_opt" id="ordering_opt" value="">
              <?php echo form_close();?>
        </div>
        
    
      