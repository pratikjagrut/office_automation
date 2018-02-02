<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CcRefund extends Model
{
    protected $table = 'cc_refunds';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
