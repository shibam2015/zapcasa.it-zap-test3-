<?php
namespace StoreFinder\Controller;

use Auth, User, Request;

/**
 * Import controller
 *
 * General controller for import related functions.
 *
 * @package		Controllers
 * @category	App
 * @version		0.01
 * @since		2014-05-26
 * @author		NowSquare.com
 */
class ImportController extends BaseController {

    /**
     * Import row.
	 *
	 * @param 	string $index 			POST index count
	 * @param 	array of fields  		POST []
	 *
	 * @return	JSON
	 *
	 * @since	2014-05-26
	 * @author	NowSquare.com
     */
	public function postRow()
	{
        // Check if user is logged in
		if(Auth::check())
		{
			$parent_user_id = (Auth::user()->parent_id == 0) ? Auth::user()->id : Auth::user()->parent_id;
		}
		else
		{
			die('Not logged in');
		}

        $category_id = Request::get('category_id');
        $append = Request::get('append');
        $index = Request::get('index');
        $count = Request::get('count');
        $value = Request::get('value');

        // Check if user owns category
        $oCat = \StoreFinder\Model\User::find($parent_user_id)->categories()->find($category_id);
        if(count($oCat) == 0) die('No permissions');

        // Remove existing data (replace)
        if($append == '0' && $index == 0)
        {
            $affectedRows = \StoreFinder\Model\Item::where('user_id', '=', $parent_user_id)->where('category_id', '=', $category_id)->forceDelete();
        }

        $name = (isset($value[0]) && $value[0] != '') ? $value[0] : '';
        $address = (isset($value[1]) && $value[1] != '') ? $value[1] : '';
        $phone = (isset($value[2]) && $value[2] != '') ? $value[2] : '';
        $email = (isset($value[3]) && $value[3] != '') ? $value[3] : '';
        $website = (isset($value[4]) && $value[4] != '') ? $value[4] : '';
        $description = (isset($value[5]) && $value[5] != '') ? $value[5] : '';

        if($address != '')
        {
            // Geocode address
            $geocode = \StoreFinder\Core\GeoHelpers::geocode($address);

            if(isset($geocode['error']))
            {
                return 'error geocoding';
            }

			$oItem = new \StoreFinder\Model\Item;
            $oItem->user_id = $parent_user_id;
            $oItem->category_id = $category_id;
            $oItem->name = $name;
            $oItem->address = $address;
            $oItem->phone = $phone;
            $oItem->email = $email;
            $oItem->website = $website;
            $oItem->description = $description;
            $oItem->lat = $geocode['latitude'];
            $oItem->lng = $geocode['longitude'];
            $oItem->active = 1;
            $oItem->save();
        }

        if($count == $index)
        {
            return 'ready';
        }
	}
}