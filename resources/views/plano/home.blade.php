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
                        Cadastro de Planos
                        </div>
                        <div class="col-sm-3">
                        <a class="btn btn-primary right" href="{{route('plano.adicionar')}} " role="button">Adicionar</a>
               
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
                    @if (session('status_erro'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('status_erro') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Periodicidade</th>
                            <th scope="col">valor</th>
                            <th scope="col">Status</th>
                            <th scope="col">Criar PagSeguro</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($Plano as $Planos)
                            <tr>
                                <th>{{$Planos->id}} </td>
                                <td>{{$Planos->nome}} </td>
                                <td>
                                @if ($Planos->periodo == '1')
                                    Semanal
                                @elseif($Planos->periodo == '2')
                                    Mensal
                                @else
                                    Anual
                                @endif
                                </td>
                                <td>{{$Planos->valor}} </td>
                                <td>@if (empty($Planos->code_retorno))  
                                        <div class="alert alert-dark" role="alert">
                                            Não Criado
                                        </div> 
                                    @else 
                                        <div class="alert alert-primary" role="alert">
                                            Criado
                                        </div>
                                     @endif 
                                </td>
                                <td> 
                                    <a @if (empty($Planos->code_retorno)) class="btn btn-outline-dark " @else class="btn btn-outline-dark disabled" @endif  role="button" href="{{route('plano.enviar',['plano'=> $Planos->id] )}}"><i class="fa fa-send-o" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>

function envio_pagseguro(){

    var settings = {
  "url": "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request/?email=danilo_pitombera@hotmail.com&token=ACADBEE557C8483782CE3D51F0FDC481",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Accept": "application/vnd.pagseguro.com.br.v3+xml;charset=ISO-8859-1",
    "Content-Type": "application/xml;charset=ISO-8859-1",
    "Access-Control-Allow-Origin" : "*"
  },
  "crossDomain": true,
  "data": "<preApprovalRequest><preApproval><name>Plano - Teste</name><reference>TESTEREJES</reference><charge>MANUAL</charge><period>weekly</period><amountPerPayment>1.00</amountPerPayment><cancelURL>http://sitedocliente.com</cancelURL><membershipFee>2.00</membershipFee><trialPeriodDuration>1</trialPeriodDuration></preApproval><maxUses>500</maxUses></preApprovalRequest>",
};

$.ajax(settings).done(function (response) {
  console.log(response);
});


    }
</script>
@endsection
