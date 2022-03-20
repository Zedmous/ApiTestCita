<?php

namespace App\Repositories;

use App\Models\Cita;
use App\Http\Resources\CitaResource;
use Illuminate\Http\Request;

class CitaRepository 
{
	/**
     * Model de Cita.
     *
     * @var Cita
     */
	public $model;

	/**
     * CitaRepository instance.
     *
     * @return void
     */
	public function __construct(Cita $model)
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