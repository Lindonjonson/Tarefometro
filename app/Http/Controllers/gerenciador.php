<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;

class gerenciador extends Controller
{
    private $atividades =[
        ['id'=>1,'atividade'=>'Ir a Praia','status'=>1],
        ['id'=>2,'atividade'=>'Jogar Bola','status'=>1],
        ['id'=>3,'atividade'=>'Estudar php','status'=>1],
        ['id'=>4,'atividade'=>'Ir para Academia','status'=>1],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $atividades = session('atividades');
        if (!isset($atividades))
            session(['atividades'=> $this->atividades]);
    }
    public function index()
    {
        //
        $atividades = session('atividades');
        
        return view('atividades.index', compact(['atividades']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nome = ucfirst( $request->atividade);
        $atividades = session('atividades');
        $conta = count($atividades);
        $status = 1;
        
        if($nome == null){
            $erro = 1 ;
            return redirect()->route('atividades.index',compact(['erro']));
        }

        if($conta >=1 ){
          $id = end($atividades)['id']+1;
         // $id = 1;
          $dados = ["id"=>$id,"nome" => $nome,"status"=>$status];
          $atividades[] = $dados;
          session(['atividades'=>$atividades]);
         return redirect()->route('atividades.index');
         
        }
        else{
          $id = 1;
          $nome = $request->atividade;
          $dados = ["id"=>$id,"nome" => $nome,"status"=>$status];
          $atividades[] = $dados;
          session(['atividades'=>$atividades]);
         return redirect()->route('atividades.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atividades = session('atividades');
        $index = $this->getIndex($id, $atividades);
        $atividades = $atividades[$index];
        return view('atividades.info',compact('atividades'));
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
        $atividades = session('atividades');
        $index =$this->getIndex($id, $atividades);
        array_splice($atividades, $index,1);
        session(['atividades'=>$atividades]);
        return redirect()->route('atividades.index');
    }
    private function getIndex($id, $atividades){
        $ids = array_column($atividades,'id');
        $index = array_search($id,$ids);
        return $index;

    }
    public function concluir($id){
        $atividades = session('atividades');
        $index = $this->getIndex($id, $atividades);
        $atividades[ $index]['status'] = 0;
        session(['atividades'=>$atividades]);
        return redirect()->route('atividades.index');
    }
}
