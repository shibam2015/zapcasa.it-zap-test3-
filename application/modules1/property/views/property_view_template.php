<?php $this->load->view('inc/header.php'); ?>


<style>
.success { margin-bottom:10px; background-color:#006868; color:#ffea52; border:#CCC solid 1px; text-align:center;}
</style>
<div class="main-content">		

<h3>View Property</h3>
<hr />
 		<?php
         if($this->session->flashdata('success')!='')
		 {
		?>
        <div class="success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php }?>
<div class="error" id="error_msg" style="text-align:center;"><?php echo $this->session->flashdata('msg_flash');?></div>
<div class="jumbotron">
	<?php
            $property_name="";
			if($property_details[0]['contract_id']==1)
			{
				$contract="Rent For";
			}
			if($property_details[0]['contract_id']==2)
			{
				$contract="Sell For";
			}
			$property_name.=$contract;
			$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
			$property_name.=' '.stripslashes($typology_name);
			
			
			?>
			<h1><?php echo $property_name.' In '.$property_details[0]['city'].' '.$property_details[0]['provience'];?></h1>
            <br />
            <h2>Short description of the property</h2>
                    <p><?php echo nl2br($property_details[0]['description']);?></p>
            <h2><b>Address:</b></h2>        
            <label><?php echo nl2br($property_details[0]['street_address']);?></label>
            
            <label><?php echo $property_details[0]['street_no']?></label>
            
            <label><?php if($property_details[0]['zip']!=''){ echo ','.$property_details[0]['zip'];}?></label>
            
            <?php if($property_details[0]['area']!=''){ echo '<br/><label><b>Area :</b> '.$property_details[0]['area'].'</label>';}?>
            <?php if($property_details[0]['private_nagotiation']!='0'){ echo '<br/><label> Private Nagotiation </label>';}?>
            <?php if($property_details[0]['private_nagotiation']=='0'){ echo '<br/><label><b>Price :</b> '.$property_details[0]['price'].'</label><br>';}?>
            <label> <b>Published on </b>  <?php echo $property_details[0]['posting_time']; ?> By 
			<b><?php echo get_perticular_field_value('zc_user','first_name'," and user_id='".$property_details[0]['property_post_by']."'"); ?>
            <?php echo get_perticular_field_value('zc_user','last_name'," and user_id='".$property_details[0]['property_post_by']."'"); ?></b>
            
            </label>
</div>
<div class="row">
<div class="col-md-6">
 <h2>Main Features</h2>
                    <!--<div class="column">
                    	<ul>
                        	<li><span>Contact</span>: <?php // echo $contract; ?></li>
                            <li><span>Category</span>: <?php //echo $property_details[0]['category_id']; ?></li>
                        </ul>
                    </div>-->
                   <!-- <div class="column">
                    	<ul>
                        	<li><span>City</span>: <?php //echo $property_details[0]['city']; ?></li>
                            <li><span>Provience</span>: <?php //echo $property_details[0]['provience']; ?></li>
                            <li><span>Zip Code</span>: <?php //echo $property_details[0]['zip']; ?></li>
                            <li><span>Address</span>: <?php //echo $property_details[0]['street_address']; ?></li>
                            
                        </ul>
                    </div>-->
                    <div class="column">
                    	<ul>
                        	<li>
                            		<span>Typology</span>:
                                    <?php echo get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'"); ?> 
                            </li>
                            <li><span>Status</span>: <?php echo get_perticular_field_value('zc_status_of_property','name'," and id='".$property_details[0]['status']."'") ;?></li>
                            <li><span>Kind</span>: 
							<?php echo get_perticular_field_value('zc_kind_of_property','name'," and id='".$property_details[0]['kind']."'") ;?>
							</li>
                            <li><span>Energy Class</span>:
                            <?php echo get_perticular_field_value('zc_energy_efficiency_class','name'," and id='".$property_details[0]['energyclass']."'") ;?>
                           </li>
                        </ul>
                    </div>
                    <div class="column">
                    	<ul>
                        	<li><span>Surface Area</span>: <?php echo $property_details[0]['surface_area']; ?></li>
                            <li><span>Room No</span>: <?php echo $property_details[0]['room_no']; ?></li>
                            <li><span>Floor</span>: <?php echo $property_details[0]['floor']; ?></li>
                            <li><span>Total Floors</span>: <?php echo $property_details[0]['total_of_floors']; ?></li>
                        </ul>
                    </div>
                    
                    <div class="column">
                    	<ul>
                        	<li><span>Year of Building</span>: <?php echo $property_details[0]['year_of_building']; ?></li>
                            <li><span>Beds</span>: <?php echo $property_details[0]['beds_no']; ?></li>
                            <li><span>Bathrooms No</span>: <?php echo $property_details[0]['bathrooms_no']; ?></li>
                            <li><span>Kitchen</span>: <?php echo $property_details[0]['kitchen']; ?></li>
                        </ul>
                    </div>
                    <div class="column">
                    	<ul>
                        	<li><span>Heating</span>: <?php echo $property_details[0]['heating']; ?></li>
                            <li><span>Parking</span>: <?php echo $property_details[0]['parking']; ?></li>
                            <li><span>Roommates</span>: <?php echo $property_details[0]['roommates']; ?></li>
                            <li><span>Occupation</span>: <?php echo $property_details[0]['occupation']; ?></li>
                        </ul>
                    </div>
                    
                     <div class="column">
                    	<ul>
                        	<li><span>Furnished</span>: <?php echo $property_details[0]['furnished']; ?></li>
                            <li><span>Availability</span>: <?php echo $property_details[0]['availability']; ?></li>
                            <li><span>Smokers</span>: <?php echo $property_details[0]['smokers']; ?></li>
                            <li><span>Pets</span>: <?php echo $property_details[0]['pets']; ?></li>
                        </ul>
                    </div>
                    
</div>
<div class="col-md-6">
<h2>Additional Features</h2>
                    <div class="column">
                    	<ul>
                        	<li><span>Air conditioning</span>: 
							   <?php if($property_details[0]['air_conditioning']==0){ echo 'No';} else{ echo 'Yes' ;} ?>
                            </li>
                            <li><span>Elevator</span>: 
							  <?php if($property_details[0]['elevator']==0){echo 'No';} else{echo 'yes';} ?></li>
                            <li><span>Balcony</span>:
							<?php if($property_details[0]['balcony']==0){ echo 'No';}else{echo 'Yes';} ?></li>
                            <li><span>Terrace</span>: 
							<?php if($property_details[0]['terrace']==0){ echo 'No';} else{echo 'Yes'; } ?></li>
                            <li><span>Garden</span>:
                             <?php if($property_details[0]['garden']==0){echo 'No';}else{echo 'Yes';} ?></li>
                        </ul>
                    </div>
</div>
<div class="detailview">
            	
                <div class="section1">
                	
                    
                    
                </div>
                <div class="section1">
                <a class="btn btn-primary btn-lg" role="button" href="<?php echo base_url();?>property/property_image/<?php echo $this->uri->segment('3');?>">Go to Image Gallery</a>
                	
                    <!--<div class="column">
                    	<ul>
                        	<li><span>City</span>: Rome</li>
                            <li><span>Provience</span>: App</li>
                            <li><span>Zip Code</span>: 433</li>
                            <li><span>Address</span>: 23 plot 3v South bore CA</li>
                            
                        </ul>
                    </div>
                    <div class="column">
                    	<ul>
                        	<li><span>Typology</span>: Lorem Ipsum</li>
                            <li><span>Status</span>: Lorem Ipsum</li>
                            <li><span>Kind</span>: Lorem Ipsum</li>
                            <li><span>Energy Class</span>: Lorem Ipsum</li>
                            
                        </ul>
                    </div>-->
                </div>
               
                    
                   
                </div>
            </div>

<?php //echo '<pre>';print_r($property_details);?>

<!-- Modal 6 (Long Modal)-->
<?php $this->load->view('inc/footer.php'); ?>
