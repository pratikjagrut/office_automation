<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentApproval extends Model
{
    protected $table = 'document_approvals';
	public $primaryKey = 'id';
	public $timeStamps = true;
}
