<?php

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;

class CandidatosController extends Controller
{

	public function file($filename){

		$entry = Candidato::where('arquivo', '=', $filename)->firstOrFail();
		$file = Storage::disk('uploads')->get($entry->arquivo);

		$ultimas = substr($filename, -4);
		$tirar_ponto = str_replace("." , "" , $ultimas);

		switch ($tirar_ponto) {
			case "jpeg":			
			$tipo = 'application/image/jpeg';
			break;
			case "jpg":			
			$tipo = 'application/image/jpeg';
			break;
			case "bmp":
			$tipo = 'application/image/bmp';
			break;
			case "png":
			$tipo =  'application/image/png';
			break;
			case "pdf":
			$tipo = 'application/pdf';
			break;
		}

		$response = FacadeResponse::make($file, 200);
		$response->header('Content-Type', $tipo);
		return $response;
	}

	public function index(Request $request){

		$candidato = Candidato::orderBy('id','DESC')->paginate(5);
		return view('candidatos.index',compact('candidato'))
		->with('i', ($request->input('page', 1) - 1) * 5);
	}

	public function create(){

		return view('candidatos.create');
	}

	public function store(Request $request){
		$this->validate($request, [
			'nome' => 'required',
			'email' => 'required',
			'cpf' => 'required',
			'telefone' => 'required',
			'tecnica' => 'required',
			'sociais' => 'required',
			'experiencia' => 'required',
			'arquivo' => 'required',
			'job_id' => 'required',
			]);
		
		$nome = $request['nome'];
		$mail = $request['email'];

		$imageName = $nome . ' - ' . $mail . '.' . $request->file('arquivo')->getClientOriginalExtension();

		$request->file('arquivo')->move(base_path().DIRECTORY_SEPARATOR. 'public' .DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR, $imageName);

		$confirmation_code = str_random(30);

		$candidato = $request->all();
		$candidato['cod_confirmacao'] = $confirmation_code;
		$candidato['arquivo'] = $imageName;

		Candidato::create($candidato);

		$data = array('confirmacao' => $confirmation_code);

		Mail::send('candidatos.verify', $data, function($message) use ($mail, $nome) {
			$message->to($mail, $nome)->subject('Verifique seu endereço de e-mail');
		});

		$this->curl('POST', $request, null);

		if(Auth::check()){
			return redirect()->route('candidato.index')->with('success','Criado com sucesso');
		}else{
			return redirect()->to('/')->with('success','Obrigado por inscrever-se! Por favor verifique seu email');
		}

	}

	public function show($id){

		$candidato = Candidato::find($id);
		return view('candidatos.show',compact('candidato'));
	}

	public function edit($id){

		$candidato = Candidato::find($id);
		return view('candidatos.edit',compact('candidato'));
	}

	public function update(Request $request, $id){

		$this->validate($request, [
			'nome' => 'required',
			'email' => 'required',
			'cpf' => 'required',
			'telefone' => 'required',
			'tecnica' => 'required',
			'sociais' => 'required',
			'experiencia' => 'required',
			'arquivo' => 'required',
			'job_id' => 'required',
			]);

		$nome = $request['nome'];
		$mail = $request['email'];

		$imageName = $nome . ' - ' . $mail . '.' . $request->file('arquivo')->getClientOriginalExtension();

		$request->file('arquivo')->move(base_path().DIRECTORY_SEPARATOR. 'public' .DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR, $imageName);

		$candidato = $request->all();
		$candidato['arquivo'] = $imageName;

		Candidato::find($id)->update($candidato);

		$this->curl('PUT', $request->all(), $id);

		return redirect()->route('candidato.index')->with('success','Atualizado com sucesso');
	}

	public function destroy($id){

		Candidato::find($id)->delete();

		$this->curl('DELETE', '', $id);

		return redirect()->route('candidato.index')->with('success','Excluído com sucesso');

	}

	public function confirma($code){

		$candidato = Candidato::where('cod_confirmacao', $code)->first();

		if ($candidato) {
			$candidato->confirmacao = 1;
			$candidato->cod_confirmacao = null;
			$candidato->save();
			return redirect()->to('/')->with('success','Você verificou sua conta com sucesso.');
		}else{
			return redirect()->to('/')->with('success','Não existe seu candidato ou já candidato em ativo.');
		}
		
	}

	public function curl($route, $string, $id) 
	{

		$url = "http://localhost:8080/api/candidato/";
		$porta = "8080";

		$curl = curl_init();

		switch ($route) {
			
			case "POST":

			$data = array("nome" => $string['nome'], "email" => $string['email'], "cpf" => $string['cpf'], "telefone" => $string['telefone'], "tecnica" => $string['tecnica'], "sociais" => $string['sociais'], "experiencia" => $string['experiencia'], "arquivo" => '', "job_id" => $string['job_id']);
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

			$data = array("nome" => $string['nome'], "email" => $string['email'], "cpf" => $string['cpf'], "telefone" => $string['telefone'], "tecnica" => $string['tecnica'], "sociais" => $string['sociais'], "experiencia" => $string['experiencia'], "arquivo" => '', "job_id" => $string['job_id']);
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

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}

	}
}
