<?php

class CertEntry extends Eloquent {
	protected $table = 'cert';
	public $timestamps = false;
	protected $fillable = ['received_certificate'];
}