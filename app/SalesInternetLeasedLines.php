<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesInternetLeasedLines extends Model
{
    protected $table = 'sales_ills';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
