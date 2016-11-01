<?php

class StudentEntry extends Eloquent {
	protected $table = 'students'; 
	public $timestamps = false;

	public function branch()
	{
		return $this->belongsTo('Branch');
	}
}