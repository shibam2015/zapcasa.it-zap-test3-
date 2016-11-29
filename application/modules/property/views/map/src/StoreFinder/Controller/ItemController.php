<?php
namespace StoreFinder\Controller;

use Auth, Request, Redirect, Validator, User, Config, Input, Response, DateTime;

/**
 * Item controller
 *
 * General controller for item related functions.
 *
 * @package		Controllers
 * @category	App
 * @version		0.01
 * @since		2014-05-01
 * @author		NowSquare.com
 */
class ItemController extends BaseController {

    /**
	 * @since	2014-05-02
	 * @author	NowSquare.com
     */
    public function __construct()
    {
		if(Auth::check())
		{
			$this->parent_user_id = (Auth::user()->parent_id == 0) ? Auth::user()->id : Auth::user()->parent_id;
		}
		else
		{
			$this->parent_user_id = 0;
		}
    }

    /**
     * Add a new item or update existing.
	 *
	 * @param 	integer $id 			POST id, 0 = insert
	 * @param 	string $name 			POST Item name
	 * @param 	boolean $active 		POST Is item active / visible
	 *
	 * @return	JSON: field error, general_error or general_success
	 *
	 * @since	2014-05-05
	 * @author	NowSquare.com
     */
	public function postSave()
	{
		$description = (Request::get('description') == '<p><br></p>') ? NULL : Request::get('description');
		$input = array(
			'id'                 => Request::get('id', 0),
			'category_id'        => Request::get('category_id'),
			'name'               => Request::get('name'),
			'options'            => Request::get('options'),
			'address'            => Request::get('address'),
			'phone'              => Request::get('phone'),
			'email'              => Request::get('email'),
			'website'            => Request::get('website'),
			'description'        => $description,
			'marker'             => Request::get('marker'),
			'active'             => Request::get('active', 0)
		);

		$rules = array(
			'name'               => array('required'),
			'category_id'        => array('required'),
			'address'            => array('required'),
			'email'              => array('email')
		);

		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('/dashboard/item?category_id=' . $input['category_id'] . '&id=' . $input['id'])->withInput()->withErrors($validation);
		}

		// Geocode address
		$geocode = \StoreFinder\Core\GeoHelpers::geocode($input['address']);

		if(isset($geocode['error']))
		{
			return Redirect::to('/dashboard/item?category_id=' . $input['category_id'] . '&id=' . $input['id'])->withInput()->with('geoError', $e->getMessage());
		}

		// Permission check
		$oCheck = \StoreFinder\Model\User::find($this->parent_user_id)->categories()->find($input['category_id']);
		if(count($oCheck) == 0) die('No permissions');

		if($input['id'] == 0)
		{
			$oItem = new \StoreFinder\Model\Item;
		}
		else
		{
			$oItem = \StoreFinder\Model\Item::find($input['id']);
            // Detach options
            $oItem->options()->detach();
		}

		$oItem->user_id = $this->parent_user_id;
		$oItem->category_id = $input['category_id'];
		$oItem->name = $input['name'];
		$oItem->address = $input['address'];
		$oItem->phone = $input['phone'];
		$oItem->email = $input['email'];
		$oItem->website = $input['website'];
		$oItem->lat = $geocode['latitude'];
		$oItem->lng = $geocode['longitude'];
		$oItem->description = $input['description'];
		$oItem->marker = $input['marker'];
		$oItem->active = $input['active'];
		$oItem->save();

        if($input['options'] != '')
        {
            // Insert new options
            $aOptions = explode(',', $input['options']);
            foreach($aOptions as $option)
            {
                $bAdd = true;

                if(is_numeric($option))
                {
                    // Check if option exists by id
                    $oOption = \StoreFinder\Model\Option::find($option);
                    if(count($oOption) > 0)
                    {
                        $oItem->options()->attach($oOption->id);
                        $bAdd = false;
                    }
                }
				else
				{
                    // Check if option exists by name
                    $oOption = \StoreFinder\Model\Option::where('name', '=', $option)->where('category_id', '=', $input['category_id'])->first();
                    if(count($oOption) > 0)
                    {
                        $oItem->options()->attach($oOption->id);
                        $bAdd = false;
                    }
				}

                if($bAdd)
                {
                    $oOption = new \StoreFinder\Model\Option;
                    $oOption->user_id = $this->parent_user_id;
                    $oOption->category_id = $input['category_id'];
                    $oOption->name = $option;
                    $oOption->active = 1;
                    $oOption->undeletable = 0;
                    $oOption->save();

                    // Attach option
                    $oItem->options()->attach($oOption->id);
                }
            }
        }

		return Redirect::to('/dashboard/items?category_id=' . $input['category_id'])->with('message', trans('global.save_success'));
	}

    /**
     * Delete item(s)
	 *
	 * @param 	array $id 			POST Array containing IDs
	 *
	 * @return	Redirect
	 *
	 * @since	2014-05-06
	 * @author	NowSquare.com
     */
	public function postBatchDelete()
	{
		if(Auth::check())
		{
			foreach(Request::get('id', array()) as $id)
			{
				$affected = \StoreFinder\Model\Item::where('id', '=', $id)->where('user_id', '=',  $this->parent_user_id)->delete();
			}
		}

		return Redirect::to('/dashboard/items?category_id=' . Request::get('category_id') . '&deleted');
	}

    /**
     * Download CSV.
	 *
	 * @return	CSV download
	 *
	 * @since	2014-05-07
	 * @author	NowSquare.com
     */
	public function getDownloadCsv()
	{
        $category_id = Request::get('category_id', 0);
        $oGet = \StoreFinder\Model\Item::where('user_id', '=', $this->parent_user_id)
                ->where('category_id', '=', $category_id)
                ->get(array('name', 'address', 'phone', 'email', 'website', 'description'))
                ->toArray();

        $outstream = fopen("php://output",'r+') or die("Can't open php://output");

		foreach ($oGet as $row) 
		{
			fputcsv($outstream, $row, ';');
		}

        fclose($outstream);

        return Response::make('', 200, array(
            'Content-Description'       => 'File Transfer',
            'Content-Type'              => 'text/csv',
            'Content-Disposition'       => 'attachment; filename="'. date_format(new DateTime(), 'Y-m-d') . '_' . trans('global.item') . '_Export.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'Expires'                   => 0,
            'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
            'Pragma'                    => 'public'
        ));
	}

    /**
     * Upload file.
	 *
	 * @return	File info
	 *
	 * @since	2014-05-19
	 * @author	NowSquare.com
     */
	public function postUpload()
	{
		$destinationPath = app_path() . '/storage/uploads/' . md5($this->parent_user_id . Config::get('app.key'));

		$file = Input::file('file');
		$category_id = Request::get('category_id', 0);

		if($file == '')
		{
			return Redirect::to('/dashboard/import?category_id=' . $category_id)->withInput()->with('error', trans('global.no_file_selected'));
		}

		$filename = $file->getClientOriginalName();
		$extension = $file->getClientOriginalExtension();

		if($extension != 'csv')
		{
			return Redirect::to('/dashboard/import?category_id=' . $category_id)->withInput()->with('error', trans('global.only_csv_allowed'));
		}

		$uploadSuccess = Input::file('file')->move($destinationPath, $filename);

		if($uploadSuccess)
		{
			return Redirect::to('/dashboard/import?category_id=' . $category_id); //->withInput()->with('message', trans('global.upload_success'));
		} else {
			return Redirect::to('/dashboard/import?category_id=' . $category_id)->withInput()->with('error', trans('global.upload_error'));
		}
	}
}