<?php

/*
 *	Image Magic Creation Function
 *	Don't Delete It.
 *
 *	$data = array(
		'sourcePath' => './demo/1.jpg',
		'destinationPath' => './demo/thumb_92_82/1.jpg',
		'imageSize' => '50x20'
	);
 *
 *
*/
function CreateImageUsingImageMagic($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];
	exec ("/usr/bin/convert ".$sourcePath."   -resize ".$imageSize."\!  ".$destinationPath);
}
function CreateImageUsingImageMagicWithGravity1($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$watermarkLogoPath = $data['watermarkLogoPath'];
	$imageSize = $data['imageSize'];	
	
	$rrr = exec ("/usr/bin/convert -strip ".$sourcePath." -flatten \
			-resize ".$imageSize."^ -gravity Center -crop ".$imageSize."+0+0 +repage \
			-background white -alpha remove -quality 80% ".$destinationPath);
}
function CreateImageUsingImageMagicWithGravity($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$watermarkLogoPath = $data['watermarkLogoPath'];
	$imageSize = $data['imageSize'];	
	
	$rrr = exec ("/usr/bin/convert -strip ".$sourcePath." -flatten \
			-resize ".$imageSize."^ -gravity Center -crop ".$imageSize."+0+0 +repage \
			-gravity SouthWest -draw 'image Over 0,0 100,43 'zap_logo.png'' \
			-background white -alpha remove -quality 80% ".$destinationPath);
}
function CreateImageUsingImageMagicWithOutGravity($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];
	exec ("/usr/bin/convert -strip ".$sourcePath." -flatten \
			-resize ".$imageSize."^ -gravity Center -crop ".$imageSize."+0+0 +repage \
			-background white -alpha remove -quality 80% ".$destinationPath);
}
// USE THIS FOR BIG IMAGE AND FOR PLANIMETRY

function CreateImageUsingImageMagicWithOutGravitybBigImage($data){
	$sourcePath = $data['sourcePath'];
	$destinationPath = $data['destinationPath'];
	$imageSize = $data['imageSize'];	
	exec ("/usr/bin/convert -strip ".$sourcePath." -flatten \
			-resize ".$imageSize." \
			-background white -alpha remove -quality 80% ".$destinationPath);
}
/*
 *
 *
*/




/*
 * function to handle array printing request.
 */
function pre( $array , $exit = 0 )
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
    
    if($exit == 1){
        exit();
    }
}

/*
 * file uploader helper function
 */
function uploader( $configArray )
{
    $config = $configArray;
    
    $CI =& get_instance();
    
    $CI->load->library('upload');     
    $CI->upload->initialize($config);
    
    
    if (!$CI->upload->do_upload()) {
        $upload_error = $CI->upload->display_errors();
        $res = json_encode($upload_error);
    } else {
        $file_info = $CI->upload->data();
        $res = json_encode($file_info);
    }
    
     
    return $res;
    exit;
}

function access_token( $length = 8 ){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!_#^*';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $randomString = str_shuffle($randomString);
    return $randomString;
}

function send_mail( $details = array() ){
	//pre($details);die;
    $CI =& get_instance();
    $CI->load->library('email'); // load library
	
     
    $config = Array(
        'protocol' => 'mail', //mail, sendmail, smtp
        //'smtp_host' => 'ssl://smtp.gmail.com',
        //'smtp_port' => 465,
        //'smtp_user' => 'aditya.arbsoft@gmail.com',
        //'smtp_pass' => 'P@ssw0rd1234',
        'mailtype'  => 'html', 
        'charset'   => 'utf-8' // utf-8, iso-8859-1
    );
    $CI->email->initialize($config);
	$CI->email->set_newline("\r\n");
    
    $CI->email->from( $details['from'], 'ZAPCASA' );
    $CI->email->to( $details['to'] ); 
    $CI->email->subject( $details['subject'] );
    $CI->email->message( $details['message'] );
    
    if ($CI->email->send()) {
        echo 'Your email was sent, thanks chamil.';
    } else {
        show_error($CI->email->print_debugger());
    }
	
    return true;
}

if (!function_exists('sendemail')) {
	function sendemail($mail_from, $mail_to, $subject, $body, $cc='') {
		$CI = & get_instance();
		$CI->load->library("email");
		$CI->email->set_mailtype("html");
		$CI->email->from($mail_from,'ZAPCASA');
		$CI->email->to($mail_to);
		 $CI->email->cc($cc);
		$CI->email->subject($subject);
		$CI->email->message($body);
		$CI->email->send();
		$CI->email->print_debugger();
	}
}



function country( $id = '' )
{
    $CI =& get_instance();    
    $CI->load->model( 'model_common' );
    
    if( $id == '' ){
        $res = $CI->model_common->get_list( 'country_master' );
    }else{
        $res = $CI->model_common->get_list( 'country_master', $id );
    }
    
    return $res;
}

function state( $id = '' )
{
    $CI =& get_instance();    
    $CI->load->model( 'model_common' );
    
    if( $id == '' ){
        $res = $CI->model_common->get_list( 'state_master' );
    }else{
        $res = $CI->model_common->get_list( 'state_master', $id );
    }
    
    return $res;
}


function upload_file($flag='1',$file_path)
{
		$CI =& get_instance();    
   		$CI->load->model( 'model_common' );
		
		//echo '<pre>';print_r($file);
		//echo $section;
		/////////////////////////////////////////////////////////////////
		$path = $_FILES[$file_path]['name'];
		$mtypes = explode('/',$_FILES[$file_path]['type']);
		$m_type=$mtypes[0];
		
		 if (!is_dir('assets/uploads/')) {
            mkdir('./assets/uploads/', 0777, true);
        }

		if($m_type=='image')
        {
			//echo 'image';
			$file_mime_type='images';
			$config['upload_path'] = 'assets/uploads/';
			$config['allowed_types'] = '*';
			$config['overwrite'] = FALSE;
			$config['encrypt_name'] = TRUE;
			$config['file_name'] = $_FILES[$file_path]['name'];
			$CI->load->library('upload'); //initialize
			$CI->upload->initialize($config);
			 
		if($CI->upload->do_upload()){
			$data = array('upload_data' => $CI->upload->data());
			//echo '<pre>';print_r($data);die;
			
			if($flag!='')
			{
											
											
			//echo '<pre>';print_r($data);die;
    										$CI -> load -> library('image_lib');
											$original_size = getimagesize($_FILES[$file_path]['tmp_name']);
											
											$ratio = $original_size[0] / $original_size[1];
											
											//Thumb image cteate
											 if (!is_dir('assets/uploads/thumb_200_296')) {
           										 mkdir('./assets/uploads/thumb_200_296', 0777, true);
       											 }
											$new_width = 200;
											$new_height = (int)($new_width/$ratio);
											$file_name=$_FILES[$file_path]['name'];
											$file_name=str_replace(" ","_",$file_name);
									  		$config['image_library'] = 'gd2';
											$config['source_image'] = $_FILES[$file_path]['tmp_name'];
											$config['encrypt_name']=TRUE;
										$config['new_image'] = "assets/uploads/thumb_200_296/".$data['upload_data']['file_name'];								$config['maintain_ratio'] = FALSE;
											$config['width'] = $new_width;
											$config['height'] = $new_height;
											
											
											$CI -> image_lib -> initialize($config);
											$CI -> image_lib -> resize();
											
											
											
											
											$original_size = getimagesize($_FILES[$file_path]['tmp_name']);
											
											$ratio = $original_size[0] / $original_size[1];
											
											//Thumb image cteate
											 if (!is_dir('assets/uploads/thumb_92_82')) {
           										 mkdir('./assets/uploads/thumb_92_82', 0777, true);
       											 }
											$new_width = 92;
											$new_height = (int)($new_width/$ratio);
											$file_name=$_FILES[$file_path]['name'];
											$file_name=str_replace(" ","_",$file_name);
									  		$config['image_library'] = 'gd2';
											$config['source_image'] = $_FILES[$file_path]['tmp_name'];
											$config['encrypt_name']=TRUE;
										$config['new_image'] = "assets/uploads/thumb_92_82/".$data['upload_data']['file_name'];							  $config['maintain_ratio'] = FALSE;
											$config['width'] = $new_width;
											$config['height'] = $new_height;
											
											
											$CI -> image_lib -> initialize($config);
											$CI -> image_lib -> resize();
			 }
			 
			 //////////////////////////data insert query//////////////////////////
				$new_data=array(
						 'refference_id'=>'',
						 'reference_type'=>'',
						 'file_mime_type'=>$file_mime_type,
						 'file_name'=>$data['upload_data']['file_name'],
						 'real_name'=>$data['upload_data']['orig_name']
						);
		
		// echo '<pre>';print_r($new_data);die;
				$rs=$CI->model_common->insert( 'zc_file_master', $new_data );
		
		///////////////////////////////////////////////////////////
		
				return $rs;
			 
			}
			else
			{
				return $rs=0;
			}
											
											
		}
       else
        {
			//pre($_FILES);die;
			$file_mime_type=end(explode('-',$_FILES['userfile']['name']));
			$config['upload_path'] = 'assets/uploads/'.$section.'/';
			$config['allowed_types'] = '*';
			$config['overwrite'] = FALSE;
			//$config['encrypt_name'] = TRUE;
			$config['file_name'] = $_FILES['userfile']['name'];
			$CI->load->library('upload'); //initialize
			$CI->upload->initialize($config);
			if($CI->upload->do_upload()){
    			//$CI->upload->data(); 
				$data = array('upload_data' => $CI->upload->data());
				//////////////////////////data insert query//////////////////////////
				$new_data=array(
						 'refference_id'=>$refference_id,
						 'reference_type'=>$reference_type,
						 'file_mime_type'=>$file_mime_type,
						 'file_name'=>$data['upload_data']['file_name'],
						 'real_name'=>$data['upload_data']['orig_name']
						);
		
		// echo '<pre>';print_r($new_data);die;
				$rs=$CI->model_common->insert( 'zc_file_master', $new_data );
		
		///////////////////////////////////////////////////////////
		
				return $rs;
				
				
				
				//////////////////////////data insert ends////////////////////////
			}
			else
			{
				return $rs=0;
			}
        }
		
		return 0;
		
	
}








function days_left($date)
{
	$future = strtotime($date);
	$now = time();
	$timeleft = $future-$now;
	return $daysleft = round((($timeleft/24)/60)/60);
}


function day_diff_from_current($date1,$date2)
{
	//return $date1;
	$interval = $date1->diff($date2);
	//return $interval->h;die;
	
	//return pre($interval);die;
	if($interval->invert==1)
	{
		//return $interval->h;die;
	$diff=' ';
if($interval->y!=0)
{
	$diff.=$interval->y.' Yr ';
}
if($interval->m!=0)
{
	$diff.=$interval->m.' mnth ';
}
if($interval->d!=0)
{
	$diff.=$interval->d.' d ';
}
if($interval->h!=0)
{
	$diff.=$interval->h.' h ';
}
if($interval->i!=0)
{
	$diff.=$interval->i.' m ';
}
//if($interval->s!=0)
//{
//	$diff.=$interval->s.' sec ';
//}


return $diff;
	}
	else
	{
		
		$diff=' ';
if($interval->y!=0)
{
	$diff.=$interval->y.' Yr ';
}
if($interval->m!=0)
{
	$diff.=$interval->m.' mnth ';
}
if($interval->d!=0)
{
	$diff.=$interval->d.' d ';
}
if($interval->h!=0)
{
	$diff.=$interval->h.' h ';
}
if($interval->i!=0)
{
	$diff.=$interval->i.' m ';
}
//if($interval->s!=0)
//{
//	$diff.=$interval->s.' sec ';
//}


return $diff;
	}
}


///////////////////////////////////force dowload///////////////////////////////////////////
function force_download( $filename = '', $data = '' )
{
	
	//echo $data;die;
    if( $filename == '' || $data == '' )
    {
        return false;
    }
     
    if( !file_exists( $data ) )
    {
        return false;
    }
 
    // Try to determine if the filename includes a file extension.
    // We need it in order to set the MIME type
    if( false === strpos( $filename, '.' ) )
    {
        return false;
    }
 
    // Grab the file extension
    $extension = strtolower( pathinfo( basename( $filename ), PATHINFO_EXTENSION ) );
 
    // our list of mime types
    $mime_types = array(
 
        'txt' => 'text/plain',
        'htm' => 'text/html',
        'html' => 'text/html',
        'php' => 'text/html',
        'css' => 'text/css',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'swf' => 'application/x-shockwave-flash',
        'flv' => 'video/x-flv',
 
        // images
        'png' => 'image/png',
        'jpe' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'gif' => 'image/gif',
        'bmp' => 'image/bmp',
        'ico' => 'image/vnd.microsoft.icon',
        'tiff' => 'image/tiff',
        'tif' => 'image/tiff',
        'svg' => 'image/svg+xml',
        'svgz' => 'image/svg+xml',
 
        // archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'exe' => 'application/x-msdownload',
        'msi' => 'application/x-msdownload',
        'cab' => 'application/vnd.ms-cab-compressed',
 
        // audio/video
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
 
        // adobe
        'pdf' => 'application/pdf',
        'psd' => 'image/vnd.adobe.photoshop',
        'ai' => 'application/postscript',
        'eps' => 'application/postscript',
        'ps' => 'application/postscript',
 
        // ms office
        'doc' => 'application/msword',
        'rtf' => 'application/rtf',
        'xls' => 'application/vnd.ms-excel',
        'ppt' => 'application/vnd.ms-powerpoint',
 
        // open office
        'odt' => 'application/vnd.oasis.opendocument.text',
        'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
    );
 
    // Set a default mime if we can't find it
    if( !isset( $mime_types[$extension] ) )
    {
        $mime = 'application/octet-stream';
    }
    else
    {
        $mime = ( is_array( $mime_types[$extension] ) ) ? $mime_types[$extension][0] : $mime_types[$extension];
    }
         
    // Generate the server headers
    if( strstr( $_SERVER['HTTP_USER_AGENT'], "MSIE" ) )
    {
        header( 'Content-Type: "'.$mime.'"' );
        header( 'Content-Disposition: attachment; filename="'.$filename.'"' );
        header( 'Expires: 0' );
        header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
        header( "Content-Transfer-Encoding: binary" );
        header( 'Pragma: public' );
        header( "Content-Length: ".filesize( $data ) );
    }
    else
    {
        header( "Pragma: public" );
        header( "Expires: 0" );
        header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
        header( "Cache-Control: private", false );
        header( "Content-Type: ".$mime, true, 200 );
        header( 'Content-Length: '.filesize( $data ) );
        header( 'Content-Disposition: attachment; filename='.$filename);
        header( "Content-Transfer-Encoding: binary" );
    }
    readfile( $data );
    exit;
 
}

///////////////////////////////category listing/////////////////////////////////////////

function get_category()
{
	
	//$config = $configArray;
    
    $CI =& get_instance();
    
    $sql="select * from `tr_project_category` where status='1' and parent_id=0";
	$query=$CI->db->query($sql);
	
		 
		if($query->num_rows()> 0)
		{
			
			foreach($query->result_array() as $row)
			{
				$data[]=$row;
				$sql_sub_cat="select * from tr_project_category where status='1' and parent_id='".$row['cat_id']."'";
				$query_sub=$CI->db->query($sql_sub_cat);
				if($query_sub->num_rows()> 0)
				{
					foreach($query_sub->result_array() as $row1)
					{
						$data[]=$row1;
					}
				}
				
			}
			
			return $data;
			
		}
     
    //return $data;
    exit;
}


//////////////special function/////////////////////

/////////////////////////////////////////////////////////////
	//	Function to get perticular field from table
	/////////////////////////////////////////////////////////////
function get_perticular_field_value($tablename,$filedname,$where=""){
		$CI =& get_instance();	
		$str="select ".$filedname." from ".$tablename." where 1=1 ".$where;
		$query=$CI->db->query($str);
		$record="";
		if($query->num_rows()>0){
			
			foreach($query->result_array() as $row){
				$field_arr=explode(" as ", $filedname);
				if(count($field_arr)>1){
					$filedname=$field_arr[1];
				}else{
					$filedname=$field_arr[0];
				}
				$record=$row[$filedname];
			}
			
		}
		return $record;
	
	}
	
	/////////////////////////////////////////////////////////////
	//	Function to get last  field  value from table 
	/////////////////////////////////////////////////////////////
function get_last_field_value($tablename,$filedname,$where=""){
		$CI =& get_instance();	
		$str="select ".$filedname." from ".$tablename." where 1=1 ".$where." order by id desc limit 1";
		$query=$CI->db->query($str);
		$record="";
		if($query->num_rows()>0){
			
			foreach($query->result_array() as $row){
				$record=$row[$filedname];
			}
			
		}
		return $record;
	
	}
	
	
	
	/////////////////////////////////////////////////////////////
	//	Function to get perticular field from table
	/////////////////////////////////////////////////////////////
function get_perticular_count($tablename,$where=""){
		$CI =& get_instance();	
		$str="select * from ".$tablename." where 1=1 ".$where;
		//echo $str;
		$query=$CI->db->query($str);
		$record=$query->num_rows();
		return $record;
	
	}
	
	
	
	
	function millisecsBetween($dateOne, $dateTwo, $abs = true) {
    $func = $abs ? 'abs' : 'intval';
    return $func(strtotime($dateOne) - strtotime($dateTwo)) * 1000;
}

/////////////////////////////////////////////////////////////
	//	Function to DATABASE DATE
	/////////////////////////////////////////////////////////////
	function database_date($date){
		$date_array=explode("/", $date);
		$new_date=$date_array[2].'-'.$date_array[0].'-'.$date_array[1];
		return $new_date;
	}
	/////////////////////////////////////////////////////////////
	//	Function to VIEW DATE
	/////////////////////////////////////////////////////////////
	function view_date($date){

		$date_array=explode("-", $date);
		$new_date=$date_array[1].'/'.$date_array[2].'/'.$date_array[0];
		return $new_date;
	}
///////////////////////create random password///////////////////////////
function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\"#$%&[]{}?|";
        }

        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                

        return $password;
    }
	
    function subject_inbox($property_id) {
    	$property_name="";
    	$contract = "";
    	$contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
    	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
    	$province=get_perticular_field_value('zc_property_details','provience'," and property_id='".$property_id."'");
    	$prov_sn=get_perticular_field_value('zc_region_master','province_code'," and `province_name` LIKE '%".$province."%' group by province_code");
    
    	if($contract_id==1)
    	{
    		$contract="Rent For";
    	}
    	if($contract_id==2)
    	{
    		$contract="Sell For";
    	}
    	$property_name.=$contract;
    	$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$typology."'");
    	return $property_name.=' '.stripslashes($typology_name).' In '.$province.'-'.$prov_sn;
    }	
	
    function property_name($property_id) {
    	$property_name="";
    	$contract_id=get_perticular_field_value('zc_property_details','contract_id'," and property_id='".$property_id."'");
    	$typology=get_perticular_field_value('zc_property_details','typology'," and property_id='".$property_id."'");
    	$contract = "";
    	if($contract_id==1) {
    		$contract="Rent For";
    	} if($contract_id==2) {
    		$contract="Sell For";
    	}
    	$property_name.=$contract;
    	$typology_name=get_perticular_field_value('zc_typologies','name'," and status='active' and typology_id='".$typology."'");
    	return $property_name.=' '.stripslashes($typology_name);
    
    }
    function property_posted_by($property_id) {
    	$property_posted_by_name="";
    	 $CI =& get_instance();
	    $sql="select `first_name`,`last_name`,`user_id` from `zc_user` where status='1' and user_id='".$property_id."'";
		$query=$CI->db->query($sql);
		$data = array();
		if($query->num_rows()> 0) {
			foreach($query->result_array() as $row) {
					$data=$row;
			}
		}
		return $data;
	    exit;
    
    }
    
    function potential_buyer_count( $property_id ) {
    	$CI =& get_instance();
    	$sql="select count( `saved_id`) as totalSaved from `zc_saved_property` where property_id='".$property_id."'";
    	$query=$CI->db->query($sql);
    	$data = array();
    	if($query->num_rows()> 0) {
    		foreach($query->result_array() as $row) {
    			$data=$row;
    		}
    	}
    	return $data;
    	exit;
    }
		
    function thumb($src, $width, $height, $image_thumb = '') {
    
    	// Get the CodeIgniter super object
    	$CI = &get_instance();
    
    	// get src file's dirname, filename and extension
    	$path = pathinfo($src);
    
    	// Path to image thumbnail
    	if( !$image_thumb )
    		$image_thumb = $path['dirname'] . DIRECTORY_SEPARATOR . $path['filename'] . "_" . $height . '_' . $width . "." . $path['extension'];
    
    	if ( !file_exists($image_thumb) ) {
    
    		// LOAD LIBRARY
    		$CI->load->library('image_lib');
    
    		// CONFIGURE IMAGE LIBRARY
    		$config['source_image'] = $src;
    		$config['new_image'] = $image_thumb;
    		$config['width'] = $width;
    		$config['height'] = $height;
    		//$config['create_thumb'] = TRUE;
    		$config['maintain_ratio'] = false;
    
    		$CI->image_lib->initialize($config);
    		$CI->image_lib->resize();
    		$CI->image_lib->clear();
    
    		// get our image attributes
    		list($original_width, $original_height, $file_type, $attr) = getimagesize($image_thumb);
    
    		// set our cropping limits.
    		$crop_x = ($original_width / 2) - ($width / 2);
    		$crop_y = ($original_height / 2) - ($height / 2);
    
    		// initialize our configuration for cropping
    		$config['source_image'] = $image_thumb;
    		$config['new_image'] = $image_thumb;
    		$config['x_axis'] = $crop_x;
    		$config['y_axis'] = $crop_y;
    		$config['maintain_ratio'] = FALSE;
    
    		$CI->image_lib->initialize($config);
    		$CI->image_lib->crop();
    		$CI->image_lib->clear();
    
    	}
    
    	return basename($image_thumb);
    }
	function get_category_nm($cat_id){
		$CI =& get_instance();
		$sql="select * from `zc_nearbyproperty_category` where category_id='".$cat_id."'";
		$query=$CI->db->query($sql);
		$data = array();
		if($query->num_rows()> 0) {
			foreach($query->result_array() as $row) {
				$data=$row;
			}
		}
		return $data;
	}
	function CreateNewRefToken($id,$typo){
		return strtoupper(($typo=='Rent'?'R':'S').substr(md5($id),0,17));
	}
	function get_all_value($tablename,$where=""){
		$CI =& get_instance();
		$str="select * from ".$tablename." where 1=1 ".$where;
		$query=$CI->db->query($str);
		$record="";	if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$record[]=$row;
			}
		}
		return $record;
	}
	function deleteNonEmptyDir($dir){
		if (is_dir($dir)){
			$objects = scandir($dir);
			foreach ($objects as $object){
				if($object != "." && $object != ".."){
					if (filetype($dir . "/" . $object) == "dir"){
						deleteNonEmptyDir($dir . "/" . $object);
					}else{
						unlink($dir . "/" . $object);
					}
				}
			}
			reset($objects);
			rmdir($dir);
		}
	}
	function getLangLat($address){
		$address = urlencode($address);
		$request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=" . $address . "&sensor=true";
		$xml = simplexml_load_file($request_url);
		if ($xml->status && $xml->status == "OK") {
			return $xml->result->geometry->location;
		} else {
			return (object) array('lat' => '', 'lng' => '');
		}
	}
	function get_category_name_list($categoryCode){
		$CI =& get_instance();
		$str = '';
		$sql="SELECT GROUP_CONCAT(`name` SEPARATOR ',') AS `name` FROM `zc_categories` WHERE FIND_IN_SET(`short_code`,'".$categoryCode."')";
		$query=$CI->db->query($sql);
		if($query->num_rows()>0){
			$row = $query->result_array();
			$str.= $row[0]['name'];
		}
		return $str;
	}
	function exisitingProForThisTypology($typologyID){
		$CI =& get_instance();
		$str = '';
		$sql="SELECT `property_id` FROM `zc_property_details` WHERE `typology`='".$typologyID."'";
		$query=$CI->db->query($sql);
		return $query->num_rows();
	}
	function get_Adjusted_TypologyID_asArray($categoryCode){
		$CI =& get_instance();
		$str="SELECT `typology_id` FROM `zc_typologies` WHERE FIND_IN_SET('".$categoryCode."',`category_code`)";
		$query=$CI->db->query($str);
		$record = array();
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$record[] = $row['typology_id'];
			}
		}
		return $record;
	}