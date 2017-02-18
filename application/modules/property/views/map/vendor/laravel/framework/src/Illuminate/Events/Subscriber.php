<?php namespace Illuminate\Events;

class Subscriber {

	/**
	 * Get the events listened to by the subscriber.
	 *
	 * @return array
	 */
	public static function getSubscribedEvents()
	{
		return static::subscribes();
	}

	/**
	 * Get the events listened to by the subscriber.
	 *
	 * @return array
	 */
	public static function subscribes()
	{
		return array();
	}

}
