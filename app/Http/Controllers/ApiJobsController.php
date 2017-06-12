<?php
namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;



class ApiJobsController extends Controller
{
	public function index()
	{
		$jobs = Job::all();
		return response()->json($jobs);
	}

	public function show($id)
	{
		$job = Job::find($id);

		if(!$job) {
			return response()->json([
				'message'   => 'Record not found',
				], 404);
		}

		return response()->json($job);
	}

	public function store(Request $request)
	{

		$job = new Job();
		$job->fill($request->all());
		$job->save();

		return response()->json($job, 201);
	}

	public function update(Request $request, $id)
	{
		try {
			$job = Job::findOrFail($id);

			$job->fill($request->all());
			$job->save();

			return response()->json($job);
		} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
			response()->json($e);
		}
	}

	public function destroy($id)
	{
		$job = Job::find($id);

		if(!$job) {
			return response()->json([
				'message'   => 'Record not found',
				], 404);
		}

		$job->delete();
	}
}
