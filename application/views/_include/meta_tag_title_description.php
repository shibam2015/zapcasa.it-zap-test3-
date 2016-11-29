			<?php
			if($this->router->fetch_method() == 'common_reg'){
				?>
				<!----/user/common_reg------>
				<title><?php echo $this->lang->line('common_reg_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('common_reg_meta_description');?>">
				
			<?php
			}elseif($this->router->fetch_method() == 'comon_signup'){
				?>
				<!-----/user/comon_signup------>
				<title><?php echo $this->lang->line('reg_user_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_user_meta_description');?>">
				
			<?php
			}elseif($this->router->fetch_method() == 'user_edit'){
				?>
				<!-----/user/user_edit----->
				<title><?php echo $this->lang->line('user_edit_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'thanks'){
				?>
				<!-----/user/thanks/29----->
				<title><?php echo $this->lang->line('thanks_user_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'acctivation'){
				?>
				<!----/ user/acctivation/29/d925fb06d33d43afb3018789256a632b ------>
				<title><?php echo $this->lang->line('thanks_owner_act_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'reg_owner'){
				?>
				<!----/user/reg_owner------>
				<title><?php echo $this->lang->line('reg_owner_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_owner_meta_description');?>">
				
			<?php
			}elseif($this->router->fetch_method() == 'owner_edit'){
				?>
				<!----/user/owner_edit------>
				<title><?php echo $this->lang->line('owner_edit_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'thanksowner'){
				?>
				<!----/user/thanksowner/32------>
				<title><?php echo $this->lang->line('thanks_owner_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'reg_agency'){
				?>
				<!----/user/reg_agency------>
				<title><?php echo $this->lang->line('reg_agency_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('reg_agency_meta_description');?>">
				
			<?php
			}elseif($this->router->fetch_method() == 'agency_edit'){
				?>
				<!----/user/agency_edit------>
				<title><?php echo $this->lang->line('agency_edit_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'thanksagency'){
				?>
				<!----/user/thanksagency/34------>
				<title><?php echo $this->lang->line('thanks_agency_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php 
			}elseif($this->router->fetch_method() == 'forget_password'){
				?>
				<!----/user/forget_password------>
				<title><?php echo $this->lang->line('forgot_password_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'add_property_form'){
				?>
				<!----/property/add_property_form------>
				<title><?php echo $this->lang->line('add_property_form_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'thanks_add_property'){
				?>
				<!----/property/Property successfully saved------>
				<title><?php echo $this->lang->line('property_successfully_saved_meta_title');?></title>				
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'property_details'){
				?>
				<!----/property/List Of Properties page------>
				<title><?php echo $this->lang->line('property_details_meta_title');?></title>				
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'edit_property'){
				?>
				<!----/property/edit_property_form------>
				<title><?php echo $this->lang->line('edit_property_form_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<meta name="robots" content="noindex, nofollow">
				
			<?php
			}elseif($this->router->fetch_method() == 'add_property_csv'){
				?>
				<!----/property/add_property_csv------>
				<title><?php echo $this->lang->line('add_property_csv_meta_title');?></title>
				<meta name="robots" content="noindex, nofollow">

			<?php
            }elseif($this->router->fetch_method() == 'blockedpage'){
				?>
                <!--------blockedpage--------------->
                <title><?php echo $this->lang->line('ur_ac_is_blocked');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'get_message'){
				?>
                <!--------Inbox--------------->
                <title><?php echo $this->lang->line('inbox_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'get_send_message'){
				?>
                <!--------Sent messages--------------->
                <title><?php echo $this->lang->line('inbox_archive_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'get_saved_property'){
				?>
                <!--------get_saved_property--------------->
                <title><?php echo $this->lang->line('saved_property_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'get_saved_search'){
				?>
                <!--------get_saved_search--------------->
                <title><?php echo $this->lang->line('saved_search_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'change_password'){
				?>
                <!--------change_password--------------->
                <title><?php echo $this->lang->line('change_password_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'my_preference'){
				?>
                <!--------my_preference--------------->
                <title><?php echo $this->lang->line('preference_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'delete_account'){
				?>
                <!--------delete_account--------------->
                <title><?php echo $this->lang->line('delete_acc_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->uri->segment(1) == 'My_Feedback'){
				?>
                <!--------My_Feedback--------------->
                <title><?php echo $this->lang->line('feedback_message_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->uri->segment(2) == 'manage_location'){
				?>
                <!--------manage_location--------------->
                <title><?php echo $this->lang->line('managae_location_meta_title');?></title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->uri->segment(1) == 'contact_us'){
				?>
                <!--------contact_us--------------->
                <title><?php echo $this->lang->line('contactus_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('contactus_meta_description');?>">
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'Highlight_your_advert'){
				?>
                <!--------site/Highlight_your_advert--------------->
                <title><?php echo $this->lang->line('highlight_your_advert_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('highlight_your_advert_meta_desctiprion');?>">
				
			<?php
            }elseif($this->uri->segment(2) == 'cmsPages'){
				?>
                <!--------site/cmsPages/--------------->
                <title><?php echo $cmsDetails[$this->lang->line('cms_page_meta_title')];?> - ZapCasa</title>
                <meta name="robots" content="noindex, nofollow">
				
			<?php
            }elseif($this->router->fetch_method() == 'my_account'){
				?>
                <!-----/user/my_account----->
                <title><?php $new_tit=$user_detail[0];
							if($user_detail[0]['user_type']=='3') {
								echo $new_tit['company_name'] ." " .$this->lang->line('my_account_meta_title');
							} elseif($user_detail[0]['user_type']=='2') {
								echo $new_tit['first_name'] ." " .$new_tit['last_name'] ." " .$this->lang->line('my_account_meta_title');
							} else {
								echo $new_tit['first_name'] ." " .$this->lang->line('my_account_meta_title');
							}
						?></title>
				<meta name="robots" content="noindex, nofollow">

			<?php
			}elseif($this->router->fetch_method() == 'advertiser_details'){
				?>
				<!----/ Advertiser_details ------>
				<title><?php
					if($advertiser_detail[0]['user_type']=='3') {
						echo ucfirst($advertiser_detail[0]['company_name']) ." - " .ucfirst($advertiser_detail[0]['business_name']);
					} else {
						echo ucfirst($advertiser_detail[0]['first_name']) ." " .ucfirst($advertiser_detail[0]['last_name']);
					}
					?> - ZapCasa</title>
				<?php
				if($advertiser_detail[0]['about_me']!=''){
					$meta_descr = nl2br($advertiser_detail[0]['about_me']);
					if(strlen($meta_descr)<=130) {
						echo '<meta name="description" content="' . $meta_descr . '">';
					} else {
						$y=substr($meta_descr,0,130) . '...';
						echo '<meta name="description" content="' . $y . '">';
					}
				}
				?>

			<?php
            }elseif($this->uri->segment(2) == 'agency_search_by_area'){
				?>
                <?php if ($this->uri->segment(3) == 'North-west'){ ?>
                	<!--------agency_search_by_area/North-west--------------->
                	<title><?php echo $this->lang->line('advertise_list_northwest_agencies_meta_title');?></title>
                	<meta name="description" content="<?php echo $this->lang->line('advertise_list_northwest_agencies_meta_description');?>">
                <?php }elseif ($this->uri->segment(3) == 'North-east'){ ?>
                	<!--------agency_search_by_area/North-east--------------->
                	<title><?php echo $this->lang->line('advertise_list_northeast_agencies_meta_title');?></title>
                	<meta name="description" content="<?php echo $this->lang->line('advertise_list_northeast_agencies_meta_description');?>">
                <?php }elseif ($this->uri->segment(3) == 'Center'){ ?>
                	<!--------agency_search_by_area/Center--------------->
                	<title><?php echo $this->lang->line('advertise_list_center_agencies_meta_title');?></title>
                	<meta name="description" content="<?php echo $this->lang->line('advertise_list_center_agencies_meta_description');?>">
                <?php }elseif ($this->uri->segment(3) == 'South'){ ?>
                	<!--------agency_search_by_area/South--------------->
                	<title><?php echo $this->lang->line('advertise_list_south_agencies_meta_title');?></title>
                	<meta name="description" content="<?php echo $this->lang->line('advertise_list_south_agencies_meta_description');?>">
                <?php }elseif ($this->uri->segment(3) == 'Islands'){ ?>
                	<!--------agency_search_by_area/Islands--------------->
                	<title><?php echo $this->lang->line('advertise_list_islands_agencies_meta_title');?></title>
                	<meta name="description" content="<?php echo $this->lang->line('advertise_list_islands_agencies_meta_description');?>">
                <?php } ?>

			<?php
            }elseif($category_id=='1'){
				?>
                <!-----/Property search Residential----->
                <title><?php echo $this->lang->line('category_residential_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_residential_meta_description');?>">
                
			<?php
            }elseif($category_id=='2' || $category_id=='6' || $category_id=='7'){
				?>
                <!-----/Property search Business----->
                <title><?php echo $this->lang->line('category_business_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_business_meta_description');?>">

			<?php
            }elseif($category_id=='3'){
				?>
                <!----/Property search Rooms----->
                <title><?php echo $this->lang->line('category_rooms_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_rooms_meta_description');?>">

			<?php
            }elseif($category_id=='4'){
				?>
                <!----/Property search Land------>
                <title><?php echo $this->lang->line('category_land_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_land_meta_description');?>">

			<?php
            }elseif($category_id=='5'){
				?>
                <!----/Property search Vacations------>
                <title><?php echo $this->lang->line('category_vacations_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_vacations_meta_description');?>">

			<?php
            }elseif($category_id=='10'){
				?>
                <!----/Property search Luxury------>
                <title><?php echo $this->lang->line('category_luxury_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('category_luxury_meta_description');?>">

			<?php
			}elseif(($property_details[0]['category_id']=='1') || ($property_details[0]['category_id']=='2') || ($property_details[0]['category_id']=='3') || ($property_details[0]['category_id']=='4') || ($property_details[0]['category_id']=='5') || ($property_details[0]['category_id']=='6') || ($property_details[0]['category_id']=='7') || ($property_details[0]['category_id']=='10')){
				?>
				<!-----/Property detail pages----->
				<title><?php
					if( isset( $_COOKIE['lang'] ) && ( $_COOKIE['lang'] == "english" )) {
						$name=get_perticular_field_value('zc_contract_types','name'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = $name." For ".stripslashes($typology_name)." in ".$city_name.", ".$province_code;
					} else {
						$name_it=get_perticular_field_value('zc_contract_types','name_it'," and contract_id='".$property_details[0]['contract_id']."'");
						$typology_name=get_perticular_field_value('zc_typologies','name_it'," and status='active' and typology_id='".$property_details[0]['typology']."'");
						$city_name=get_perticular_field_value('zc_city','city_name_it'," and city_id='".$property_details[0]['city']."'");
						$province_code=get_perticular_field_value('zc_region_master','province_code'," and city_it='".mysql_real_escape_string($city_name)."'");
						
						$proptitle = stripslashes($typology_name)." in ".$name_it." a ".$city_name.", ".$province_code;
					}
					echo stripslashes($proptitle);
					//print_r($property_details);exit;
					$property_name=property_name($property_details[0]['property_id']);
					$st_name1=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$property_details[0]['provience']."%' group by province_code");
				?></title>
				<meta name="description" content="<?php
                $propertyAddress = '';
					if($property_details[0]['area']!=''){
						$propertyAddress.= $area_prop=$property_details[0]['area'].' - ';
					}
					if($property_details[0]['street_address']!=''){
						$propertyAddress.= $property_details[0]['street_address'].', ';
					}
					if($property_details[0]['street_no']!=''){
						$propertyAddress.= $property_details[0]['street_no'].' - ';
					}
					if($property_details[0]['zip']!=''){
						$propertyAddress.= $property_details[0]['zip'];
					}
					echo $propertyAddress;
				?> - ZapCasa">
			
			<?php
            }elseif(isset($_GET['advertiser_type'])){
				?>
				<?php if($advertiser_type[0] == 'all' || $advertiser_type[0] == '2' || $advertiser_type[0] == '3'); ?>
                <!----/Advertisers search page------>
                <title><?php echo $this->lang->line('advertise_list_meta_title');?></title>
                <meta name="description" content="<?php echo $this->lang->line('advertise_list_meta_description');?>">

			<?php
			}else{
				?>
				<title><?php echo $this->lang->line('home_page_meta_title');?></title>
				<meta name="description" content="<?php echo $this->lang->line('home_page_meta_description');?>">
				<?php
			}
			?>
