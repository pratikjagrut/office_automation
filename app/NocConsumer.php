<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocConsumer extends Model
{
    protected $table = 'noc_consumers';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
