<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesP2p extends Model
{
    protected $table = 'sales_p2ps';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
