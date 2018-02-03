<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesApprovalNote extends Model
{
    protected $table = 'sales_approvalnotes';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
