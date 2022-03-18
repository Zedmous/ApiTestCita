<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserRepository 
{
	/**
     * Model de User.
     *
     * @var User
     */
	public $model;

	/**
     * UserRepository instance.
     *
     * @return void
     */
	public function __construct(User $model)
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
    /*Para generar la contraseña de 8 caracteres*/
    public function generatePassword(){
        //Carácteres para la contraseña
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $password = "";
        //Reconstruimos la contraseña segun la longitud que se quiera
        for($i=0;$i<8;$i++) {
            //obtenemos un caracter aleatorio escogido de la cadena de caracteres
            $password .= substr($str,rand(0,62),1);
        }
        return $password;
    }
    

}