<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NocOngoingJob extends Model
{
    protected $table = 'noc_ongoing_jobs';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
