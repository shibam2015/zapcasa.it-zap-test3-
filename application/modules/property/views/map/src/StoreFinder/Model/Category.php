<?php
namespace StoreFinder\Model;

use Eloquent;

Class Category extends Eloquent
{

    protected $table='categories';

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
        return $this->hasMany('StoreFinder\Model\Item', 'category_id');
    }

    public function options()
    {
        return $this->hasMany('StoreFinder\Model\Option', 'category_id')->orderBy('name', 'ASC');
    }

    public function map_style()
    {
        return $this->hasOne('StoreFinder\Model\MapStyle');
    }
}