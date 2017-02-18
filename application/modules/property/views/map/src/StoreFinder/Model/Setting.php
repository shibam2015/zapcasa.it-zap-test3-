<?php
namespace StoreFinder\Model;

use Eloquent;

Class Setting extends Eloquent
{

    public $timestamps = false;

	// Disabling Auto Timestamps
    protected $table = 'settings';

    public function users()
    {
        return $this->hasOne('StoreFinder\Model\User');
    }

}