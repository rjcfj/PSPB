<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;


class JobsController extends Controller
{
	public function index(Request $request)
	{
		$job = Job::orderBy('id','DESC')->paginate(5);
		return view('jobs.index',compact('job'))
		->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function create()
	{
		return view('jobs.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'local' => 'required',
			'remoto' => 'required',
			]);

		Job::create($request->all());

		return redirect()->route('job.index')->with('success','Criado com sucesso');;
	}

	public function show($id)
	{
		$job = Job::find($id);
		return view('jobs.show',compact('job'));
	}

	public function edit($id)
	{
		$job = Job::find($id);
		return view('jobs.edit',compact('job'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, [
			'nome' => 'required',
			'descricao' => 'required',
			'local' => 'required',
			'remoto' => 'required',
			]);

		Job::find($id)->update($request->all());

		return redirect()->route('job.index')->with('success','Atualizado com sucesso');;
	}

	public function destroy($id)
	{
		Job::find($id)->delete();

		return redirect()->route('job.index')->with('success','Excluído com sucesso');;
	}
}
