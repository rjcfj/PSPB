<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $fillable = ['nome', 'descricao', 'local', 'remoto'];

	protected $dates = ['deleted_at'];
}
