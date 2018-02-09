<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesIll extends Model
{
    protected $table = 'sales_ills';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
