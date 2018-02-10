<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrManpower extends Model
{
    protected $table = 'hr_manpowers';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
