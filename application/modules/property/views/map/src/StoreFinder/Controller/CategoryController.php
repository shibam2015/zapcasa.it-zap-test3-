<?php
namespace StoreFinder\Controller;

use Auth, Request, Validator, Redirect;

/**
 * Category controller
 *
 * General controller for category related functions.
 *
 * @package		Controllers
 * @category	App
 * @version		0.01
 * @since		2014-05-02
 * @author		NowSquare.com
 */
class CategoryController extends BaseController {

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
     * Add a new category or update existing.
	 *
	 * @param 	integer $id 			POST id, 0 = insert
	 * @param 	string $name 			POST Category name
	 * @param 	boolean $active 		POST Is category active / visible
	 *
	 * @return	JSON: field error, general_error or general_success
	 *
	 * @since	2014-05-02
	 * @author	NowSquare.com
     */
	public function postSave()
	{
		$input = array(
			'id'           => Request::get('id', 0),
			'map_style_id' => Request::get('map_style_id'),
			'name'         => Request::get('name'),
			'marker'       => Request::get('marker'),
			'theme'        => Request::get('theme'),
			'language'     => Request::get('language'),
			'active'       => Request::get('active', 0)
		);

		$rules = array(
			'name'         => array('required')
		);

		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('/dashboard')->withInput()->withErrors($validation);
		}

		if($input['id'] == 0)
		{
			$oCat = new \StoreFinder\Model\Category;
		}
		else
		{
			$oCat = \StoreFinder\Model\Category::find($input['id']);
		}

		$oCat->user_id = $this->parent_user_id;
		$oCat->map_style_id = $input['map_style_id'];
		$oCat->name = $input['name'];
		$oCat->marker = $input['marker'];
		$oCat->active = $input['active'];
		$oCat->settings = array(
			'language' => $input['language'],
			'theme' => $input['theme']
		);
		//$oCat->save();

		return Redirect::to('/dashboard')->with('message', trans('global.save_success'));
	}

    /**
     * Delete cat(s)
	 *
	 * @param 	array $id 			POST Array containing IDs
	 *
	 * @return	Redirect
	 *
	 * @since	2014-05-02
	 * @author	NowSquare.com
     */
	public function postBatchDelete()
	{
		if(Auth::check())
		{
			foreach(Request::get('id', array()) as $id)
			{
				$affected = \StoreFinder\Model\Category::where('id', '=', $id)->where('user_id', '=',  $this->parent_user_id)->delete();
			}
		}

		return Redirect::to('/dashboard?deleted');
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
        $oGet = \StoreFinder\Model\Category::where('user_id', '=', $this->parent_user_id)->get(array('name', 'active', 'updated_at', 'created_at'))->toArray();

        $outstream = fopen("php://output",'r+') or die("Can't open php://output");

         foreach ($oGet as $row) 
         {
            fputcsv($outstream, $row);
         }

        fclose($outstream);

        return Response::make('', 200, array(
            'Content-Description'       => 'File Transfer',
            'Content-Type'              => 'text/csv',
            'Content-Disposition'       => 'attachment; filename="'. date_format(new DateTime(), 'Y-m-d') . '_' . trans('global.category') . '_Export.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'Expires'                   => 0,
            'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
            'Pragma'                    => 'public'
        ));
	}
}