<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CcExtension extends Model
{
    protected $table = 'cc_extensions';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
