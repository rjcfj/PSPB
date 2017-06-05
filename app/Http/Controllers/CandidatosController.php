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

		$imageName = $nome . ' - ' . $mail . '.' . 
		$request->file('arquivo')->getClientOriginalExtension();

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

		$imageName = $request['nome'] . " | " . $request['email'] . '.' . 
		$request->file('arquivo')->getClientOriginalExtension();

		$request->file('arquivo')->move(base_path() . '/public/uploads/', $imageName);

		$candidato = $request->all();
		$candidato['arquivo'] = $imageName;

		Candidato::find($id)->update($candidato);

		return redirect()->route('candidato.index')->with('success','Atualizado com sucesso');
	}

	public function destroy($id){

		Candidato::find($id)->delete();

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
}
