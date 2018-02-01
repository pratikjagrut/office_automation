<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrStationery extends Model
{
    protected $table = 'hr_stationaries';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
