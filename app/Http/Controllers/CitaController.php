<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use App\Repositories\CitaRepository;
use App\Http\Resources\CitaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class CitaController extends Controller
{
    private $citaRepository;

    
    public function __construct(CitaRepository $citaRepository)
    {
        $this->citaRepository = $citaRepository;
    }

    public function index(Request $request)
    {
        $data = $this->citaRepository->model->with(['persona'])->orderBy('id', 'DESC');
        $data = $this->citaRepository->search($data, $request);
        $data = $this->citaRepository->noPaginate($data, $request);
        return new CitaResource( $data );/**/
    }

   
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:100',
            'motivo' => 'nullable|string|max:100',
            'fecha' => 'required|date',
            'hora' => 'required|string',
            'persona_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return DB::transaction(function() use ($request) {
            $cita = $this->citaRepository->model
                ->create([
                    'titulo' => $request->titulo,
                    'motivo' => $request->motivo,
                    'fecha'=>$request->fecha,
                    'hora' => $request->hora,
                    'persona_id'=>$request->persona_id
                ]);
            $cita->load(['persona']);
            return new CitaResource($cita);
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cita  $cita
     * @return \Illuminate\Http\Response
     */
    public function show(Cita $cita)
    {
        //$cita = $cita->load(['user','coach','coach.user','scholarship']);
        return new CitaResource($cita);
    }


    public function update(Request $request, Cita $cita)
    {
        
        $validator = Validator::make($request->all(), [
            'titulo' => 'required|string|max:100',
            'motivo' => 'nullable|string|max:100',
            'fecha' => 'required|date',
            'hora' => 'required|string',
            'persona_id' => 'required|integer',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return DB::transaction(function() use ($request, $cita) {
            $cita->update([
                'titulo' => $request->titulo,
                'motivo' => $request->motivo,
                'fecha'=>$request->fecha,
                'hora' => $request->hora,
                'persona_id'=>$request->persona_id
            ]);
            return new CitaResource($cita);
        });
    }

    public function destroy(Request $request,Cita $cita)
    {
        $cita->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
