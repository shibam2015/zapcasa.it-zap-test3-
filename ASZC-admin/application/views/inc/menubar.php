<?php
$controller_name =  $this->router->fetch_class();
$function_name = $this->router->fetch_method();
?>
<ul id="main-menu" class="">
    <li class="<?php echo($controller_name=='dashboard'?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-gauge"></i>
			<span>Dashboard</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='dashboard' && $function_name=='index')?'active':'');?>">
				<a href="<?php echo site_url('/dashboard/'); ?>">
					<span>Manage Dashboard</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='dashboard' && $function_name=='editadmin')?'active':'');?>">
				<a href="javascript:void(0);" data-target="#modalUpdateAdmin" data-toggle="modal">
					<span>Manage Admin Profile</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="<?php echo($controller_name=='user'?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-users"></i>
			<span>Manage All Users</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='user' && $function_name=='index')?'active':'');?>">
                <a href="<?php print site_url('/user/all/all');?>"><span>View All User</span></a>
			</li>
			<li class="<?php echo(($controller_name=='user' && $function_name=='individual')?'active':'');?>">
                <a href="<?php echo site_url('/user/individual/all');?>"><span>Individual</span></a>
			</li>
			<li class="<?php echo(($controller_name=='user' && $function_name=='owner')?'active':'');?>">
                <a href="<?php echo site_url('/user/owner/all');?>"><span>Owner</span></a>
			</li>
			<li class="<?php echo(($controller_name=='user' && $function_name=='agency')?'active':'');?>">
                <a href="<?php echo site_url('/user/agency/all');?>"><span>Agency</span></a>
			</li>
			<li class="<?php echo(($controller_name=='user' && $function_name=='admin')?'active':'');?>">
                <a href="<?php echo site_url('/user/admin/all');?>"><span>Admin</span></a>
			</li>
			<li class="<?php echo(($controller_name=='user' && $function_name=='adduser')?'active':'');?>">
                <a href="javascript:void(0);" data-target="#modalAddUser" data-toggle="modal"><span>Add User</span></a>
            </li>
        </ul>
    </li>
    <li class="<?php echo($controller_name=='property'?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="fa fa-archive"></i>
			<span>Property Management System</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='all')?'active':'');?>">
                <a href="<?php print site_url('/property/all/all'); ?>">
					<span>Manage All Properties</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='byowner')?'active':'');?>">
                <a href="<?php print site_url('/property/byowner/all'); ?>">
					<span>By Owner</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='byagency')?'active':'');?>">
                <a href="<?php print site_url('/property/byagency/all'); ?>">
					<span>By Agency</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='residentail')?'active':'');?>">
                <a href="<?php print site_url('/property/residentail/all'); ?>">
					<span>Residential</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='bussiness')?'active':'');?>">
                <a href="<?php print site_url('/property/bussiness/all'); ?>">
					<span>Bussiness</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='rooms')?'active':'');?>">
                <a href="<?php print site_url('/property/rooms/all'); ?>">
					<span>Rooms</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='land')?'active':'');?>">
                <a href="<?php print site_url('/property/land/all'); ?>">
					<span>Land</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='vacations')?'active':'');?>">
                <a href="<?php print site_url('/property/vacations/all'); ?>">
					<span>Vacations</span>
                </a>
            </li>
			<li class="<?php echo(($controller_name=='property' && $function_name=='index' && $this->uri->segment('2')=='luxury')?'active':'');?>">
                <a href="<?php print site_url('/property/luxury/all'); ?>">
					<span>Luxury</span>
                </a>
            </li>
            <!--
			<li class="<?php echo($function_name=='add_property'?'active':'');?>">
                <a href="<?php print site_url('/property/add_property'); ?>">                
                	<span>Add Property</span>                
                </a>
			</li>
			-->	
        </ul>
    </li>
    <li class="<?php echo(($controller_name=='setting' && $function_name=='index')?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-cog"></i>
			<span>Site Setting</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='setting' && $function_name=='index')?'active':'');?>">
                <a href="<?php print site_url('/setting/'); ?>">
					<span>Manage Settings</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="<?php echo(($controller_name=='cms' && ($function_name=='index' || $function_name=='add_page'))?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-doc-text"></i>
			<span>Content Management System</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='cms' && $function_name=='index')?'active':'');?>">
                <a href="<?php print site_url('/cms/'); ?>">
					<span>Manage All CMS Pages</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='cms' && $function_name=='add_page')?'active':'');?>">
                <a href="<?php print site_url('/cms/add_page'); ?>">
					<span>Add Page</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="<?php echo(($controller_name=='NearByProperty' && ($function_name=='n_category' || $function_name=='n_category_edit' || $function_name=='index' || $function_name=='index_edit'))?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-doc-text"></i>
			<span>Near by Property</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='NearByProperty' && $function_name=='n_category')?'active':'');?>">
                <a href="<?php print site_url('/NearByProperty/n_category'); ?>">
					<span>Near By Property Category</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='NearByProperty' && $function_name=='n_category_edit')?'active':'');?>">
                <a href="<?php print site_url('/NearByProperty/n_category_edit'); ?>">
					<span>Add Near By Property Category</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='NearByProperty' && $function_name=='index')?'active':'');?>">
                <a href="<?php print site_url('/NearByProperty/index/all'); ?>">
					<span>List Of Near By Property</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='NearByProperty' && $function_name=='index_edit')?'active':'');?>">
                <a href="<?php print site_url('/NearByProperty/index_edit'); ?>">
					<span>Add Near By Property</span>
                </a>
            </li>
        </ul>
    </li>
    <li class="<?php echo(($controller_name=='Reports' && ($function_name=='property_wise' || $function_name=='user_wise_reports'))?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-docs"></i>
			<span>Reports</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='Reports' && $function_name=='property_wise')?'active':'');?>">
                <a href="<?php print site_url('/Reports/property_wise'); ?>">
					<span>Reports Property Wise</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='Reports' && $function_name=='user_wise_reports')?'active':'');?>">
                <a href="<?php print site_url('/Reports/user_wise_reports'); ?>">
					<span>Reports User Wise</span>
                </a>
            </li>
        </ul>
    </li>	
	<li class="<?php echo($controller_name=='typology'?'active opened':''); ?>">
        <a href="javascript:void(0);">
			<i class="entypo-code"></i>
			<span>Typology</span>
        </a>
        <ul class="">
            <li class="<?php echo(($controller_name=='typology' && $function_name=='typologylist')?'active':'');?>">
				<a href="<?php echo site_url('/typology/typologylist'); ?>">
					<span>Manage Typology</span>
                </a>
            </li>
            <li class="<?php echo(($controller_name=='typology' && $function_name=='add_typo')?'active':'');?>">
				<a href="<?php echo site_url('/typology/add_typo'); ?>">
					<span>Add New Typology</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?php print site_url('/dashboard/logout/'); ?>">
			<i class="entypo-logout right"></i>
			<span>Logout</span>
        </a>
    </li>
</ul>

