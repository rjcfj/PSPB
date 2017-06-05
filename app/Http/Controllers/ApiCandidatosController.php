<?php

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Mail;

class ApiCandidatosController extends Controller
{
	public function index()
	{

		$candidatos = Candidato::with('jobs')->get();
		return response()->json($candidatos);
	}

	public function show($id)
	{
		$candidato = Candidato::with('jobs')->find($id);

		if(!$candidato) {
			return response()->json([
				'message'   => 'Record not found',
				], 404);
		}

		return response()->json($candidato);
	}

	public function store(Request $request)
	{

		$confirmation_code = str_random(30);

		$nome = $request['nome'];
		$mail = $request['email'];
		
		$file = $request->arquivo;

		$ultimas = substr($file, -4);

		$tirar_ponto = str_replace("." , "" , $ultimas);

		$data = file_get_contents($file);
		$uploadfile = base_path().DIRECTORY_SEPARATOR. 'public' .DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR. $nome . ' - ' . $mail . '.' . $tirar_ponto;
		file_put_contents($uploadfile, $data);

		$candidato = $request->all();
		$candidato['cod_confirmacao'] = $confirmation_code;
		$candidato['arquivo'] = $nome . ' - ' . $mail . '.' . $tirar_ponto;
		Candidato::create($candidato);

		$data = array('confirmacao' => $confirmation_code);

		Mail::send('candidatos.verify', $data, function($message) use ($mail, $nome) {
			$message->to($mail, $nome)->subject('Verifique seu endereço de e-mail');
		});

		return response()->json($candidato, 201);
	}

	public function update(Request $request, $id)
	{
		try {
			$nome = $request['nome'];
			$mail = $request['email'];
			
			$candidato = Candidato::findOrFail($id);
			
			$file = $request->arquivo;
			$data = file_get_contents($file);
			$uploadfile = base_path().DIRECTORY_SEPARATOR. 'public' .DIRECTORY_SEPARATOR. 'uploads' .DIRECTORY_SEPARATOR. $nome . ' - ' . $mail . '.' .'PDF';
			file_put_contents($uploadfile, $data);
			
			$candidato = $request->all();
			$candidato['arquivo'] = $nome . ' - ' . $mail . '.' .'PDF';
			
			Candidato::find($id)->update($candidato);

			return response()->json($candidato);
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			response()->json($e);
		}
	}

	public function destroy($id)
	{
		$candidato = Candidato::find($id);

		if(!$candidato) {
			return response()->json([
				'message'   => 'Record not found',
				], 404);
		}

		$candidato->delete();
	}
}
