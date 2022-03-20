<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Repositories\PersonaRepository;
use App\Repositories\CitaRepository;
use App\Http\Resources\PersonaResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class PersonaController extends Controller
{
    
    
    private $personaRepository;
    private $citaRepository;
    
    public function __construct(PersonaRepository $personaRepository,CitaRepository $citaRepository)
    {
        $this->citaRepository = $citaRepository;
        $this->personaRepository = $personaRepository;
    }

    public function index(Request $request)
    {
        $data = $this->personaRepository->model->orderBy('id', 'DESC');
        $data = $this->personaRepository->search($data, $request);
        $data = $this->personaRepository->noPaginate($data, $request);
        return new PersonaResource( $data );/**/
    }

   
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|min:8',
            'descripcion' => 'nullable|string|min:10',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return DB::transaction(function() use ($request) {

            $persona = $this->personaRepository->model
                ->create([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'telefono'=>$request->telefono,
                    'descripcion' => $request->descripcion
                ]);
            return new PersonaResource($persona);
        });

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Persona  $persona
     * @return \Illuminate\Http\Response
     */
    public function show(Persona $persona)
    {
        //$persona = $persona->load(['user','coach','coach.user','scholarship']);
        return new PersonaResource($persona);
    }


    public function update(Request $request, Persona $persona)
    {
        
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'telefono' => 'nullable|string|min:8',
            'descripcion' => 'nullable|string|min:10',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return DB::transaction(function() use ($request, $persona) {
            $persona->update([
                    'nombre' => $request->nombre,
                    'apellido' => $request->apellido,
                    'telefono'=>$request->telefono,
                    'descripcion' => $request->descripcion
                ]);
            return new PersonaResource($persona);
        });
    }

    public function destroy(Request $request,Persona $persona)
    {
        //$cita=$this->citaRepository->model->orWhere('persona_id',$persona->id)->get();
        $collection = collect($this->citaRepository->model->orWhere('persona_id',$persona->id)->get());
        $contador =$collection->count();
        if($contador>0){
            return response()->json(['error' => 'No se puede eliminar la persona ya tiene citas registradas'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }else{
            $persona->delete();
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }
        
    }
     
}
