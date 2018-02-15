<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voip extends Model
{
    protected $table = 'voips';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
