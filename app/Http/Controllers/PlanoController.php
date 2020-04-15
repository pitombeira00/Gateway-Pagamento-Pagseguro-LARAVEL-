<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planos;
use Illuminate\Support\Facades\Auth;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Plano = Planos::All(); 
            
        return view('plano.home',compact('Plano'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plano.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Novo_plano = new Planos;

        $Novo_plano->nome = $request->nome;
        $Novo_plano->periodo = $request->periodicidade;
        $Novo_plano->valor = $request->valor;
        $Novo_plano->apagado = '1';

        $Novo_plano->save();

        $request->session()->flash('status', 'Criado Plano');

        return redirect()->route('plano.inicio');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pagseguro_send($Plano){

        $email       = TRIM(Auth::user()->email);
        $token       = TRIM(Auth::user()->token);
        $tipo_plano  = array(1 => 'weekly', 2 => 'monthly', 3 =>'yearly');
        
        $plano_atual = Planos::find($Plano);

        $nome    = $plano_atual->nome;
        $id      = $plano_atual->id;
        $valor   = number_format($plano_atual->valor, 2);
        $periodo = $tipo_plano[$plano_atual->periodo];
         
        

        $URL = "https://ws.sandbox.pagseguro.uol.com.br/pre-approvals/request/?email=danilo_pitombera@hotmail.com&token=ACADBEE557C8483782CE3D51F0FDC481" ;

        //DD($URL);
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"<?xml version=\"1.0\" encoding=\"ISO-8859-1\" standalone=\"yes\"?>\r\n<preApprovalRequest>\r\n<preApproval>\r\n<name>".$nome."</name>\r\n<reference>".$id."</reference>\r\n<charge>AUTO</charge>\r\n<period>".$periodo."</period>\r\n<amountPerPayment>".$valor."</amountPerPayment>\r\n<cancelURL>http://sitedocliente.com</cancelURL>\r\n</preApproval>\r\n<maxUses>500</maxUses>\r\n</preApprovalRequest>",
        CURLOPT_HTTPHEADER => array(
            "Accept: application/vnd.pagseguro.com.br.v3+xml;charset=ISO-8859-1",
            "Content-Type: application/xml;charset=ISO-8859-1"
        ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
               
        if ($response == "Unauthorized"){

            session()->flash('status_erro', 'Não autorizado, verifique EMAIL ou TOKEN');

            return redirect()->route('plano.inicio');

        }else{

            $retorno_xml = simplexml_load_string($response);

            
            $plano_atual->code_retorno = $retorno_xml->code;
            $plano_atual->data_retorno = $retorno_xml->date;

            $plano_atual->save();


            session()->flash('status', 'Plano Autorizado, verifique EMAIL ou TOKEN');

            return redirect()->route('plano.inicio');

        }
        
       
        
    }
}
