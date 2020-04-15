@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Parâmetros - Usuários</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('user.salvar.parametros') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">Nome</label>
                                <input class="form-control" type="text" placeholder="{{Auth::user()->name}} " readonly>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputEmail4">E-mail</label>
                                <input class="form-control" type="text" placeholder="{{Auth::user()->email}} " readonly>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputEmail4">Token</label>
                                <input type="text" class="form-control" name="token_user" placeholder="Token - Pagseguro" value="{{Auth::user()->token}}">
                            </div>
                           
                        </div>
                        <button type="submit" class="btn btn-primary col-md-12">Salvar</button>
                    </form>
                    <form>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
