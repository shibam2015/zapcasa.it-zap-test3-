<?php
namespace StoreFinder\Controller;

use Auth, Request, Validator, Redirect;

/**
 * Option controller
 *
 * General controller for option related functions.
 *
 * @package		Controllers
 * @category	App
 * @version		0.01
 * @since		2014-05-02
 * @author		NowSquare.com
 */
class OptionController extends BaseController {

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
     * Save option.
	 *
	 * @param 	string $name 			POST Category option
	 * @param 	boolean $active 		POST Is option active / visible
	 *
	 * @return	JSON: field error, general_error or general_success
	 *
	 * @since	2014-05-17
	 * @author	NowSquare.com
     */
	public function postSave()
	{
		$input = array(
			'id'           => Request::get('id', 0),
			'category_id'  => Request::get('category_id'),
			'name'         => Request::get('name'),
			'active'       => Request::get('active', 0)
		);

		$rules = array(
			'name'         => array('required')
		);

		$validation = Validator::make($input, $rules);

		if($validation->fails())
		{
			return Redirect::to('/option?id=' . $input['id'] . '&category_id=' . $input['category_id'])->withInput()->withErrors($validation);
		}

		if($input['id'] == 0)
		{
			$oOption = new \StoreFinder\Model\Option;
		}
		else
		{
			$oOption = \StoreFinder\Model\Option::find($input['id']);
		}

		$oOption->user_id = $this->parent_user_id;
		$oOption->name = $input['name'];
		$oOption->active = $input['active'];
		$oOption->save();

		return Redirect::to('/dashboard/options?category_id=' . $input['category_id'])->with('message', trans('global.save_success'));
	}

    /**
     * Delete item(s)
	 *
	 * @param 	array $id 			POST Array containing IDs
	 *
	 * @return	Redirect
	 *
	 * @since	2014-05-08
	 * @author	NowSquare.com
     */
	public function postBatchDelete()
	{
		if(Auth::check())
		{
			foreach(Request::get('id', array()) as $id)
			{
				if(isset($_POST['delete']))
				{
					$action = 'deleted';
					$affected = \StoreFinder\Model\Option::where('id', '=', $id)->where('user_id', '=',  $this->parent_user_id)->delete();
				}
				if(isset($_POST['switch']))
				{
					$action = 'switched';
					$current = \StoreFinder\Model\Option::where('id', '=', $id)->first();
					$switch = ($current->active == 1) ? 0 : 1;
					$affected = \StoreFinder\Model\Option::where('id', '=', $id)->where('user_id', '=',  $this->parent_user_id)->update(array('active' => $switch));
				}
			}
		}

		return Redirect::to('/dashboard/options?category_id=' . Request::get('category_id') . '&' . $action);
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
        $oGet = \StoreFinder\Model\Option::where('user_id', '=', $this->parent_user_id)
                ->get(array('name', 'active', 'updated_at', 'created_at'))
                ->toArray();

        $outstream = fopen("php://output",'r+') or die("Can't open php://output");

         foreach ($oGet as $row) 
         {
            fputcsv($outstream, $row);
         }

        fclose($outstream);

        return Response::make('', 200, array(
            'Content-Description'       => 'File Transfer',
            'Content-Type'              => 'text/csv',
            'Content-Disposition'       => 'attachment; filename="'. date_format(new DateTime(), 'Y-m-d') . '_' . trans('global.option') . '_Export.csv"',
            'Content-Transfer-Encoding' => 'binary',
            'Expires'                   => 0,
            'Cache-Control'             => 'must-revalidate, post-check=0, pre-check=0',
            'Pragma'                    => 'public'
        ));
	}
}