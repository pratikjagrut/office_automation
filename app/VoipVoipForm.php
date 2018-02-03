<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoipVoipForm extends Model
{
    protected $table = 'voip_voipform';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
