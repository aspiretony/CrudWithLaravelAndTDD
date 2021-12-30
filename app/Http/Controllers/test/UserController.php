<?php

namespace App\Http\Controllers\test;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;

use App\Models\User as Usuario;
use App\Http\Resources\User as UserResource;


class UserController extends Controller
{

    public function __construct(){
   //     $this->middleware('guest');
    }
    public function index(){
        $users = Usuario::paginate(20);
        return UserResource::collection($users);
    }

    public function salvar(Request $request){

      /*  $usuarioCadastro = new Usuario;
        $usuarioCadastro->name = $request->input('name');
        $usuarioCadastro->email = $request->input('email');
        $usuarioCadastro->email = $request->input(Hash::make('password'));*/
        $user = Usuario::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->save;
        if ($user->save()){
            return new UserResource($user);
        }
    }

    public function atualizar(Request $request, $id){

        $usuarioEditar = Usuario::findOrFail($request->id);
        $usuarioEditar->name = $request->input('name');
        $usuarioEditar->email = $request->input('email');

     /* $usuarioEditar =  User::where('id', $id)->update(['name' => $request['name'],'email'=>$request['email']]);*/

        if($usuarioEditar->save()){
            return new UserResource($usuarioEditar);
        }

    }

    public function ver($id){

        $usuarios = Usuario::findOrfail($id);
        return new UserResource($usuarios);

   /*     return User::find($id);*/

    }

    public function excluir($id){

        $usuariosExcluir = Usuario::findOrfail($id);
        if ($usuariosExcluir->delete()){
            return new UserResource($usuariosExcluir);

        }

        /*     return User::find($id);*/

    }

}
