<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CcDownArea extends Model
{
    protected $table = 'cc_feasibleareas';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
