<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class MY_pagination extends CI_Pagination{
    
	var $per_page			= 10; // Max number of items you want shown per page
	var $num_links			=  2; // Number of "digit" links to show before/after the currently viewed page
	var $first_link			= '&lsaquo; First';
	var $next_link			= '&rsaquo;';
	var $prev_link			= '&lsaquo;';
	var $last_link			= 'Last &rsaquo;';
	var $uri_segment		= 3;
	var $full_tag_open		= '';
	var $full_tag_close		= '';
	var $first_tag_open		= '<li>';
	var $first_tag_close	        = '</li>';
	var $last_tag_open		= '<li>';
	var $last_tag_close		= '</li>';
	var $first_url			= ''; // Alternative URL for the First Page.
	var $cur_tag_open		= '<li class="active"><a href="#">';
	var $cur_tag_close		= '</a></li>';
	var $next_tag_open		= '<li>';
	var $next_tag_close		= '</li>';
	var $prev_tag_open		= '<li>';
	var $prev_tag_close		= '</li>';
	var $num_tag_open		= '<li>';
	var $num_tag_close		= '</li>';
	var $display_pages		= TRUE;
	var $anchor_class		= '';
        
//        public function __construct($params = array()) {
//            parent::__construct($params);
//        }
    
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}
}