<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ParamController extends Controller
{
    /**
     * Tela de Parâmetros
     */
    public function index(){


        return view('usuarios.param');
    }
    /**
     * Salvar Parâmetros do Token Pagseguro
     */
    public function store(Request $request){

        $usuario = User::find(Auth::user()->id);

        $usuario->token = $request->token_user;

        $usuario->save();

        $request->session()->flash('status', 'Token Salvo com sucesso');

        return redirect()->route('user.parametros');
    }
}
