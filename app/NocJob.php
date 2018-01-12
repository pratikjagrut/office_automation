<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocJob extends Model
{
    protected $table = 'noc_jobs';
	public $primaryKey = 'id';
	public $timeStamps = true;

}
