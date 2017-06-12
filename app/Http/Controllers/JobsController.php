<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;


class JobsController extends Controller
{
	public function index(Request $request)
	{

		if ($request->input('idata') || $request->input('fdata')) {
			$job = Job::whereDate('data_ini', [$request->input('idata')])
			->whereDate('data_fim', [$request->input('fdata')])->paginate(5);			
		} else {
			$job = Job::orderBy('id','DESC')->paginate(5);
		}

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

		$this->curl('POST', $request->all(), null);

		return redirect()->route('job.index')->with('success','Criado com sucesso');
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

		$this->curl('PUT', $request->all(), $id);

		return redirect()->route('job.index')->with('success','Atualizado com sucesso');
	}

	public function destroy($id)
	{
		Job::find($id)->delete();

		$this->curl('DELETE', '', $id);

		return redirect()->route('job.index')->with('success','Excluído com sucesso');
	}

	public function curl($route, $string, $id) 
	{

		$url = "http://localhost:8080/api/job/";
		$porta = "8080";

		$curl = curl_init();

		switch ($route) {
			
			case "POST":			

			$data = array("nome" => $string['nome'], "descricao" => $string['descricao'], "local" => $string['local'], "remoto" => $string['remoto'], "data_ini" => $string['data_ini'], "data_fim" => $string['data_fim']);
			$data_json = json_encode($data);

			curl_setopt_array($curl, array(
				CURLOPT_PORT => $porta,
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POSTFIELDS => $data_json,
				CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"content-type: application/json"
					),
				));

			break;

			case "PUT":

			$data = array("nome" => $string['nome'], "descricao" => $string['descricao'], "local" => $string['local'], "remoto" => $string['remoto'], "data_ini" => $string['data_ini'], "data_fim" => $string['data_fim']);
			$data_json = json_encode($data);

			curl_setopt_array($curl, array(
				CURLOPT_PORT => $porta,
				CURLOPT_URL => $url.$id,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "PUT",
				CURLOPT_POSTFIELDS => $data_json,
				CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"content-type: application/json"
					),
				));
			
			break;

			case "DELETE":

			curl_setopt_array($curl, array(
				CURLOPT_PORT => $porta,
				CURLOPT_URL => $url.$id,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "DELETE",
				CURLOPT_HTTPHEADER => array(
					"cache-control: no-cache",
					"content-type: application/json"
					),
				));

			break;
		}

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		// if ($err) {
		// 	echo "cURL Error #:" . $err;
		// } else {
		// 	echo $response;
		// }

	}
}
