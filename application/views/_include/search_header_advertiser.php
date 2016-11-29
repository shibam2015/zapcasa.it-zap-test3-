<style>
#country-list{background: #ffffff;float:left;list-style:none;margin:0;padding:0;width:100%;}
#country-list li{padding: 10px; background: #ffffff;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background: #f0f0f0;}
</style>
<script type="text/javascript">
/*$(document).ready(function()
{});
*/
/* function bb(value){
var searchid = value;
var dataString = 'search='+ searchid;
if(searchid!='')
{
$.ajax({
type: "POST",
url: "<?php //echo base_url();?>advertiser/search_provience",
data: dataString,
cache: false,
success: function(html)
{
//alert(html);
$(".prove-list").html(html).show();
}
});
}return false;    
}*/     
</script>
<?php
//$attributes = array('class' => '', 'id' => 'agency_search', 'method' => 'GET' );
//echo form_open_multipart('advertiser/advertiser_search_adv', $attributes);
?>   
<form class="" id="agency_search" method="get" action="<?php echo base_url();?>advertiser/search">
<div class="multiplesearch" style="width:100%;">
    <div class="searchbig">
        <input type="text" name="location" placeholder="<?php echo $this->lang->line('search_header_advertise_location_field');?>" id="location" value="<?php echo isset( $_GET['location'] ) ? $_GET['location'] : ''; ?>" autocomplete="off">
        <div id="suggesstion-box" style='overflow:auto;max-height:300px;position:absolute;z-index:1;width:220px;margin-top:32px;'></div>
    </div>
    <div class="searchbig" style="margin-left:10px;">
        <input type="text" name="name"  placeholder="<?php echo $this->lang->line('search_header_advertise_name_field');?>" value="<?php echo isset( $_GET['name'] ) ? $_GET['name'] : ''; ?>" >
        <!-- <div class="prove-list" style="display:"></div> -->
    </div>
    <?php 
        $by_agency_val = 0;
        $by_owner_val = 0;
        if( isset ( $_GET['advertiser_type'] ) ) {
        	$advertiser_type = $_GET['advertiser_type'];
        	if( $advertiser_type == 'all' ) {
				$by_agency_val = isset( $advertiser_type[0] ) ? 3 : 0;
				$by_owner_val = isset( $advertiser_type[1] ) ? 2 : 0;
        	}elseif( count($advertiser_type) > 0 ) {
        		if( count($advertiser_type) == 1 ) {
        			if( $advertiser_type[0] == 3 ) {
        				$by_agency_val = $advertiser_type[0];
        			} if( $advertiser_type[0] == 2 ) {
        				$by_owner_val = $advertiser_type[0];
        			}
        		} else {
        			$by_agency_val = isset( $advertiser_type[0] ) ? $advertiser_type[0] : 0;
        			$by_owner_val = isset( $advertiser_type[1] ) ? $advertiser_type[1] : 0;
        		}
        	} 
        }
		if($this->router->fetch_method()=='agency_search_by_area'){
			$by_agency_val = 3;
		}
        ?>
	<div class="customsearch" style="margin-left:10px;margin-top:4px;">
		<input type="radio" name="advertiser_type" value="all" <?php echo (isset($_GET['advertiser_type']) && $_GET['advertiser_type'] == "all") ? 'checked="true"' : 'checked="true"'; ?>><?php echo $this->lang->line('home_page_type_of_advertiser_all');?>
	</div>
    <div class="customsearch" style="margin-top:4px;">
        <input type="radio" name="advertiser_type" value="2" <?php if( $by_owner_val != 0 ) { echo "checked"; } ?> /><?php echo $this->lang->line('search_header_advertise_owners');?>
    </div>
    <!-- <input type="hidden" value="<?php //if($this->uri->segment('1')) { echo $this->uri->segment('1');}else{ echo  0;} ?>" id="segment_name" /> -->
    <div class="customsearch" style="margin-top:4px;">
        <input type="radio" name="advertiser_type" value="3" <?php if( $by_agency_val != 0 ) { echo "checked"; } ?> /><?php echo $this->lang->line('search_header_advertise_agency');?>
    </div>
    <div class="customsearch" style="float:right;width:80px;">
        <div class="bottom_btnbar">
            <input type="submit" name="search" value="<?php echo $this->lang->line('search_header_advertise_button_search');?>">
        </div>
    </div>
    <?php //$segs = $this->uri->segment_array();?>
    <!-- <input type="hidden" name="category_search" value="<?php //if(isset($search_title)){ echo $search_title;}else{echo $segs[1];}?>" /> -->
    <?php echo form_close();?>
</div>
<script>
	$(document).ready(function(){
		$("#location").keyup(function(){
			var o1 = $(this).val();
			if (o1.length > 2) {
				a(function() {
					$.ajax({
						type: "POST",
						url: "<?php echo base_url(); ?>property/getAjaxAdvLocations",
						data:'fname=location&disname=suggesstion-box&keyword='+o1+"&lang=<?php echo $_COOKIE['lang']; ?>",
						beforeSend: function(){
							$("#location").css("background","#FFF url(<?php echo base_url(); ?>assets/images/LoaderIcon.gif) no-repeat 98%");
						},
						success: function(data){
							$("#suggesstion-box").html('');
							if(data != 0){
								$("#suggesstion-box").show();
								$("#suggesstion-box").html(data);
								$("#suggesstion-box").css("border","#c4c4c4 1px solid");
								$("#location").css("background","#FFF");
							}else{
								$("#suggesstion-box").hide();
								$("#location").css("background","#FFF");
							}
						}
					});		
				}, 500)
			}else{
				$("#suggesstion-box").html('');
				$("#suggesstion-box").hide();
			}
		});
		var a = (function() {
			var e = 0;
			return function(t, s) {
				clearTimeout(e);
				e = setTimeout(t, s)
			}
		})(),
		e = 0;
	});
	function selectCountry(val, fname, disname) {
		$("#"+fname).val(val);
		$("#"+disname).hide();
		$("#suggesstion-box").css("border","#c4c4c4 0px solid");
	}
    $("#mySubmit").click(function() {
        var segment_name = $("#segment_name").val();
        var property_name = $("#property_name").val();
		if (property_name == '') {
            $('#property_name').addClass('errorpop');
            return false;
        } else {
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>property_search/saved_search_prop",
                data: {
                    property_name: $.trim($('#property_name').val()),
                    segment_name: $.trim(segment_name)
                },
                async: false,
                success: function(result) {
                    //alert(result);
                    if (result == 1) {
                        //var url = "<?php //echo base_url();?>property_search/serach_filter";    
                        //$(location).attr('href',url);
                        //location.reload();
                        $("#toPopup1").fadeOut("normal");
                        $("#backgroundPopup1").fadeOut("normal");
                    } else {
                        $("#error").html("<span style='color:red'><?php echo $this->lang->line('search_header_advertise_invalid_username');?></span>");
                    }
                }
            });
        }
    });
</script>
