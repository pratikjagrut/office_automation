<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesInternetLeasedLines extends Model
{
    protected $table = 'sales_internetleasedlines';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
