<?php $this->load->view("inc/header");?>
 <!------ banner part ------------->
<div class="slider">
  <div class="flexslider">
     <ul class="slides">
        <li> <img src="<?php echo base_url();?>assets/images/banner_img1.jpg" alt="" /> </li>
      <li> <img src="<?php echo base_url();?>assets/images/banner_img2.jpg" alt=""/></li>
        <li> <img src="<?php echo base_url();?>assets/images/banner_img3.jpg" alt=""/></li>
      </ul>  
      <div class="main">
      	<div class="property_sect">
        	<div class="property_colum">
            	<h2><?php echo $this->lang->line('home_page_search_for_a_property');?></h2>
              	<div class="tabBox">                    
                    <div class="tabContainer">
                      <div id="tab1" class="tabContent">
                      		<form name="search" id="prop_search" method="get" class="searchbox" action="<?php echo base_url();?>property/search">
                            	<h4><?php echo $this->lang->line('home_page_search_by');?>:</h4>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_category');?></label>
                                    <select name="category_id" onChange="setOptions(this.value);" >
									<?php
										if($categories != ''){
											foreach($categories as $arrCat){
												if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
													echo '<option value="'.$arrCat['category_id'].'">'.$arrCat['name'].'</option>';
												} else {
													echo '<option value="'.$arrCat['category_id'].'">'.$arrCat['name_it'].'</option>';
												}
											}
										}
									?>
									</select>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_contract_type');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
											<td><input type="radio" checked="true" name="contract_type" value="all" id="contract_for_all" ></td><td><?php echo $this->lang->line('home_page_contract_type_all');?></td>
											<td width="22px"></td>

								<?php
									if($contract_types != ''){
										foreach($contract_types as $arrCT){
											if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
								?>
												<td><input type="radio" name="contract_type" value="<?php echo $arrCT['contract_id'];?>" id="contract_for_<?php echo $arrCT['name'];?>" ></td>
												<td>Only for <?php echo $arrCT['name'];?></td>
								<?php
											} else {
								?>
												<td><input type="radio" name="contract_type" value="<?php echo $arrCT['contract_id'];?>" id="contract_for_<?php echo $arrCT['name'];?>" ></td>
												<td>Solo in <?php echo $arrCT['name_it'];?></td>
								<?php
											}
										}
									}
								?>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_type_of_advertiser');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input type="radio" checked="true" name="posted_by" value="all"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_all');?></td><td width="22px"></td>
                                            <td><input type="radio" name="posted_by" value="2"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_only_owners');?></td></td>
                                            <td><input type="radio" name="posted_by" value="3"></td><td><?php echo $this->lang->line('home_page_type_of_advertiser_only_agencies');?></td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_location');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                       	 <td align="center"><a class="locate" href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/location_icon.png" alt=""></a></td>
                                         <td width="10px">&nbsp;</td>
                                         <td width="278px"><input type="text" name="location" placeholder="<?php echo $this->lang->line('home_page_property_location_field');?>"></td>
                                        </tr>
                                    </table>
                                </span>
                                <span style="padding-bottom:14px;">
                                	<label><?php echo $this->lang->line('home_page_price');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                       	 <td width="37px"><?php echo $this->lang->line('home_page_price_from');?></td>
                                         <td width="53px"><input type="text" class="small" name="min_price" placeholder="4000"></td>
                                         <td width="20px" style="color:#177cc2; font-size:12px; font-weight:bold;"><?php echo $this->lang->line('home_page_price_currency');?></td>
                                         <td width="8px">&nbsp;</td>
                                         <td width="20px"><?php echo $this->lang->line('home_page_price_to');?></td>
                                         <td width="53px"><input type="text" class="small" name="max_price" placeholder="10000"></td>
                                         <td width="20px" style="color:#177cc2; font-size:12px; font-weight:bold;"><?php echo $this->lang->line('home_page_price_currency');?></td>
                                        </tr>
                                    </table>
                                </span>
                            	<div class="bottomsect">
                                	<input type="submit" value="<?php echo $this->lang->line('home_page_button_search');?>" class="searchbt">
                                </div>
                             </form>
                           
                       </div>
                      <div class="bottomshadow"></div>
                    </div>
          		</div>
            </div>
            <div class="property_colum_adverts">
           	   <h2>Find an advertiser</h2>
           	   <div class="tabBox1">
               		<form name="agency_search" id="agency_search" method="get" class="searchbox1" action="<?php echo base_url();?>advertiser/search">
                            	<h4><?php echo $this->lang->line('home_page_find_an_advertiser_search_by');?>:</h4>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_location');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                       	 <td align="center"><a class="locate" href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/location_icon.png" alt=""></a></td>
                                         <td width="10px">&nbsp;</td>
                                         <td width="278px"><input type="text" name="location" class="required" placeholder="<?php echo $this->lang->line('home_page_advertiser_location_field');?>"></td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_name');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input class="big" type="text" name="name"  placeholder="<?php echo $this->lang->line('home_page_advertiser_name_field');?>"></td>
                                        </tr>
                                    </table>
                                </span>
                                <span>
                                	<label><?php echo $this->lang->line('home_page_find_an_advertiser_type');?></label>
                                    <table cellpadding="0" cellspacing="0">
                                    	<tr>
                                        	<td><input type="radio" checked="true" name="advertiser_type" value="all" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_all');?></td><td width="22px"></td>
                                            <td><input type="radio" name="advertiser_type" value="2" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_only_owners');?></td></td>
                                            <td><input type="radio" name="advertiser_type" value="3" class="required"></td><td><?php echo $this->lang->line('home_page_find_an_advertiser_type_only_agencies');?></td>
                                        </tr>                                      
                                    </table>
                                </span>                 
                                
                            	<div class="bottomsect">
                                	<input type="submit" value="<?php echo $this->lang->line('home_page_button_search');?>" class="searchbt">
                                </div>
                            </form>
                    <div class="bottomshadow1"></div>
               </div>
            </div>
            <div class="property_colum_postp">
            	<h2><?php echo $this->lang->line('home_page_post_your_property');?></h2>
                <div class="tabBox2">
                	<h3>POST your property</h3>
                    <a href="" class="freepost">Post your Property <font style="color:#fff000">FREE</font></a>
                </div>
            </div>
        </div>
      </div>     
	</div>
</div>
<div class="taglinesect">
	<div class="main">
    	<h3 class="tagline">Real Estate for <font style="font-weight:bold; color:#3687c6;">jobs</font> & 
        <font style="font-weight:bold; color:#3687c6;">Housing</font></h3>
        <span><a href="" class="readmore">Read more</a></span>
    </div>
</div>

<!------ body part ------------->

<div class="main">
	<section>
    	<div class="latestadd">
        	<div class="leftcont">
            	<h1>Latest Add</h1>
                <p>Shop for single-family homes, condos, townhomes</p>
            </div>
            <div class="rightcarousel">
                <div id="wrapper">
                    <div class="carousel2">
                        <span><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/latestadd_img1.jpg" alt="" /> </a><h4>Montagnola, Vigna Murata</h4>
                         <p class="price">€ <b style="font-weight:bold">255.000</b> | 60 m² | 2 Rooms</p></span>
                       <span><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/latestadd_img2.jpg" alt="" /> </a><h4>Ostia Antica</h4> 
                       <p class="price">€ <b style="font-weight:bold">399.000</b> | 160 m² | 8 Rooms</p></span>
                       <span ><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/latestadd_img3.jpg" alt="" /> </a><h4>Dragona, Dragoncello </h4> 
                       <p class="price">€ <b style="font-weight:bold">299.000</b> | 133 m² | 6 Rooms</p></span>
                       <span ><a href="javascript:void(0);"><img src="<?php echo base_url();?>assets/images/latestadd_img2.jpg" alt="" /> </a><h4>Ostia Antica</h4> 
                       <p class="price">€ <b style="font-weight:bold">399.000</b> | 160 m² | 8 Rooms</p></span>
                    </div>
                <a class="prev2" href="#"><img src="<?php echo base_url();?>assets/images/leftarrow.png" alt=""></a>
                <a class="next2" href="#"><img src="<?php echo base_url();?>assets/images/rightarrow.png" alt=""></a>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $this->load->view("inc/footer");?>