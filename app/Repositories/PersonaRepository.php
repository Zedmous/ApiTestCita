<?php

namespace App\Repositories;

use App\Models\Persona;
use App\Http\Resources\PersonaResource;
use Illuminate\Http\Request;

class PersonaRepository 
{
	/**
     * Model de Persona.
     *
     * @var Persona
     */
	public $model;

	/**
     * PersonaRepository instance.
     *
     * @return void
     */
	public function __construct(Persona $model)
	{
		$this->model = $model;
	}

    /**
     * Obtener los permisos y roles de un usuario.
     *
     * @return array
     */
    

    /**
    * @author Eduardo Nieves <[<ejnsilva29@gmail.com>]>
    */
    public function search($data, $request)
    {
        
        return $data;
    }
    
   

    
    /**
    * @author Eduardo Nieves <[<ejnsilva29@gmail.com>]>
    */
    public function noPaginate($data, $request)
    {
        if ($request->has('noPaginate')) {
            $data = $data->get();
        } else {
            $data = $data->paginate(10);
        }
        return $data;
    }
   
    

}