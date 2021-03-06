<?php $this->load->view('inc/header.php'); ?>
<style>
    .editbtn {
        padding-right: 18px !important;
    }

    .btn-info.inactive {
        background-color: #ddbebe;
        color: #000000;
    }

    .btn-info.inactive.btn-icon i {
        background-color: #A08282;
    }

    .filterTbl {
        color: #0859db;
        display: table;
        float: left;
        font-weight: bold;
        line-height: 26px;
        margin-bottom: 15px;
    }

    .filterTbl a {
        display: table-cell;
        padding: 0 5px;
    }

    .filterTbl a.selected {
        text-decoration: underline;
    }

    .filterTbl a:first-child {
        color: #666666;
    }

    .lblReq {
        color: red;
        margin: 0 0 0 10px;
    }
</style>
<div class="main-content">
    <h3><?php echo(isset($title_en) ? $title_en : "	ZAPCASA | Dashboard"); ?></h3>
    <hr>
    <div class="post-message" style="text-align:center;background:#00a651;color:#FFFFFF;">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <div class="post-message error" id="error_msg" style="text-align:center;">
        <?php echo $this->session->flashdata('msg_flash'); ?>
    </div>
<span class="filterTbl">
	<select id="fliter_category_id" class="form-control">
        <option value="all" <?php echo($type == 'all' ? 'selected' : ''); ?>>All</option>
        <?php
        if (count($category_list) > 0) {
            foreach ($category_list as $key) {
                ?>
                <option
                    value="<?php echo $key['category_id']; ?>" <?php echo($type == $key['category_id'] ? 'selected' : ''); ?>>
                    <?php echo $key['category_name']; ?>
                </option>
            <?php
            }
        }
        ?>
    </select>
</span>

    <div class="error" id="error_msg"
         style="text-align:center;"><?php echo $this->session->flashdata('msg_flash'); ?></div>
    <table class="table table-bordered table-striped datatable" id="table-2" width="100%">
        <thead>
        <tr>
            <th><b>Property Name</b></th>
            <th><b>Property Optional Name</b></th>
            <th><b>Category Name</b></th>
            <th><b>Picture</b></th>
            <th><b>Address</b></th>
            <th><b>Created On</b></th>
            <th><b>Status</b></th>
            <th><b>Actions</b></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($property_details)) {
            $i = 1;
            foreach ($property_details as $results) {
                $catnm = get_category_nm($results['category_id']);
                $propImg = base_url() . 'assets/images/no_proimg.jpg';
                if ($results['url'] && file_exists("./assets/uploads/NearByProperty/" . $results['url'])) {
                    $propImg = base_url() . 'assets/uploads/NearByProperty/' . $results['url'];
                }
                ?>
        <tr>
            <td><?php echo $results['name'];?></td>
            <td><?php echo $results['opt_name']; ?></td>
            <td><?php echo $catnm['category_name']; ?></td>
            <td><img id="img_1" src="<?php echo $propImg; ?>" alt="" width="142" height="140"></td>
            <td>
                <?php
                $propertyAdd = '';
                if ($results['street_address'] != "") {
                    $propertyAdd .= $results['street_address'] . ", <br>";
                }
                if ($results['street_no'] != "") {
                    $propertyAdd .= $results['street_no'] . ", ";
                }
                if ($results['city'] != "") {
                    $propertyAdd .= $results['city'] . ", <br>";
                }
                if ($results['city'] != "") {
                    $propertyAdd .= $results['zip'];
                }
                echo $propertyAdd;
                ?>
            </td>
            <td><?php echo date('d-m-Y', $results['created']);?></td>
            <td><?php echo($results['status'] == 1 ? "Active" : "Inactive"); ?></td>
            <?php
                if ($results['status'] == '1') {
                    $status = 'enabled';
                    $css_class = "entypo-lock-open";
                    $title = "Click here to disabled";
                    $Login_Status = 'Enable';
                } else {
                    $status = 'disabled';
                    $css_class = "entypo-lock";
                    $title = "Click here to enable";
                    $Login_Status = 'Disable';
                }
                ?>
            <td>
				<a href="<?php echo site_url('/NearByProperty/index_edit_page') . '/' . $results['property_details_id'] . '/'; ?>" href="javascript:void(0);" class="editbtn btn btn-default btn-sm btn-icon btn-xs" title="Click here to edit">
					<i class="entypo-pencil"></i>&nbsp;                
				</a>
				<a href="<?php echo site_url('/NearByProperty/statuschange_prop/') . '/' . $type . '/' . $results['property_details_id'] . '/'; ?>" class="btn btn-info btn-sm btn-icon btn-xs" title="<?php echo $title; ?>" Onclick="return confirm('Are you sure want change status.')">
					<i class="<?php echo $css_class; ?>"></i><?php echo $Login_Status; ?>
				</a>                
                <a href="<?php echo site_url('/NearByProperty/index_delete_page') . '/' . $results['property_details_id'] . '/'; ?>" href="javascript:void(0);" class="btn btn-red btn-sm btn-icon btn-xs" title="Click here to edit" Onclick="return confirm('Are you sure want delete.')">
					<i class="entypo-cancel"></i>Delete
				</a>
            </td>
        </tr>
        </tr>	
        <?php
                $i++;
            }
        } else {
            ?>
            <tr>
                <td colspan="6" align="center" height="100"> No records found.</td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-12 col-md-offset-5">
            <ul class="pagination">
                <?php echo $pagination ?>
            </ul>
        </div>
    </div>
    <?php $this->load->view('inc/footer.php'); ?>
    <script type="text/javascript">
        $('#fliter_category_id').change(function () {
            location.href = "<?php echo base_url().'NearByProperty/index/'; ?>" + $(this).val();
        });
    </script>