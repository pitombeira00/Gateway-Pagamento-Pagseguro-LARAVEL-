@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                        Cadastro de Planos - Adicionar
                        </div>
                        <div class="col-sm-3">
                        <a class="btn btn-danger right" href="{{route('plano.inicio')}} " role="button">Retornar</a>
               
                        </div>
                    </div>
                </div>
            </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="post" action="{{route('plano.salvar')}}">
                        @csrf
                        <div class="form-group">
                            <label for="add-plano">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome do Plano" name="nome">
                        </div>
                        <div class="form-group">
                            <label for="add-plano">Periodicidade</label>
                            <select class="form-control" name="periodicidade">
                            <option selecetd >Escolha o Período</option>
                            <option value="1">Semanal</option>
                            <option value="2">Mensal</option>
                            <option value="3">Anual</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="add-plano">Valor</label>
                            <input type="number" class="form-control" placeholder="R$" name="valor">
                        </div>
                        <button type="submit" class="btn btn-primary col-sm-12">Salvar</button> 
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
