<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
	protected $fillable = ['nome', 'descricao', 'local', 'remoto', 'data_ini', 'data_fim'];

	protected $dates = ['deleted_at'];
}
