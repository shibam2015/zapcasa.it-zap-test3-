<?php
namespace StoreFinder\Model;

use Eloquent;

Class Option extends Eloquent
{

    protected $table='options';

	/**
	 * Soft delete
	 *
	 * @var boolean
	 */
	protected $softDelete  = true;

	public function getAttribute($key)
	{
		$value = parent::getAttribute($key);
		if($key == 'settings' && $value)
        {
		    $value = json_decode($value);
		}
		return $value;
	}

	public function setAttribute($key, $value)
	{
		if($key == 'settings' && $value)
        {
		    $value = json_encode($value);
		}
		parent::setAttribute($key, $value);
	}

	public function toArray()
	{
		$attributes = parent::toArray();
		if(isset($attributes['settings']))
        {
			$attributes['settings'] = json_decode($attributes['settings']);
		}
		return $attributes;
	}

    public function items()
    {
        return $this->belongsToMany('StoreFinder\Model\Item', 'item_options', 'item_id');
    }

    public function category()
    {
        return $this->belongsTo('StoreFinder\Model\Category', 'category_id');
    }
}