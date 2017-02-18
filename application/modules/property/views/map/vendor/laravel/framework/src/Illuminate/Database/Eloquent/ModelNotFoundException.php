<?php namespace Illuminate\Database\Eloquent;

class ModelNotFoundException extends \RuntimeException {

	/**
	 * Name of the affected Eloquent model.
	 *
	 * @var string
	 */
	protected $model;

	/**
	 * Get the affected Eloquent model.
	 *
	 * @return string
	 */
	public function getModel()
	{
		return $this->model;
	}

	/**
	 * Set the affected Eloquent model.
	 *
	 * @param  string   $model
	 * @return ModelNotFoundException
	 */
	public function setModel($model)
	{
		$this->model = $model;

		$this->message = "No query results for model [{$model}].";

		return $this;
	}

}
