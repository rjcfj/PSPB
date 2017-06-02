<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Candidato extends Model
{

	protected $fillable = ['nome','email', 'cpf', 'telefone', 'tecnica', 'sociais', 'experiencia', 'arquivo', 'confirmacao', 'cod_confirmacao', 'job_id'];

	protected $dates = ['deleted_at'];

	public function jobs()
	{
		return $this->hasOne('App\Job','id', 'job_id');
	}
}
