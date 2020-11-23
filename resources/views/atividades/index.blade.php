@extends('layouts.principal')
@section('conteudo')
@yield('conteudo')

<script language="javascript"> 
  function desativar($id){
    var pacote = document.getElementsByName('Pacote');
      for (var i = 0; i < pacote.length; i++){
          if ( pacote[i].checked ) {
              if(pacote[i].value == "Pacote i"){
               /*   var Pacote_i = "Tarefa Concluida Com Sucesso!"+$id;
                  alert($id);*/
                  window.location.href = "atividades/update/"+$id+"/concluir"

              }
          }
      }
  }
  function desfazer($id) {
    var check = document.getElementsByName("Pacote"); 

    for (var i=0;i<check.length;i++){ 
        if (check[i].checked == true){ 
            

        }  else {
          window.location.href = "atividades/update/"+$id+"/desfazer"
        }
    }
}
  
    </script>
    
<div class="jumbotron">
    <h1 class="display-4">Cadastre suas tarefas</h1>
<form action="{{route('atividade.store')}}" method="GET">
  @csrf
    <p class="lead">
        <div class="input-group input-group-sm mb-3">
            <div class="input-group-prepend">
              
              <span class="input-group-text" id="inputGroup-sizing-sm" >Atividade</span>
            </div>
            <input type="text" class="form-control" aria-label="Small" name="atividade" placeholder="Qual sua proxima?" aria-describedby="inputGroup-sizing-sm ">
            <button type="submit" class="btn btn-outline-dark btn-sm">Cadastrar</button>
          </div>
      
    </p>
</form>

    <hr class="my-4">
    <p>Minhas tarefas cadastradas</p>
    <p class="lead">
     
        @foreach ($atividades as $a)
        <br>
        @if($a['status'] == 1)
       
      
          
           <form action="{{route('atividade.destroy', $a['id']) }}" method="POST">
            @csrf
            @method('DELETE') 
             <input type="checkbox" id="Pacote_i" name="Pacote" value="Pacote i" onClick="desativar({{$a['id']}})"> 
        <a href="{{ route ('atividade.show',$a['id'])}}">Informações |</a>  
           {{$a['nome']}}  
        </form>
        
        @else 
        <form>
        <input type="checkbox" id="Pacote_i" name="Pacote" value="" onClick="desfazer({{$a['id']}})" checked>
         <a href="{{ route ('atividade.show',$a['id'])}}">Informações |</a>
         <s>  {{$a['nome']}} </s>

        @endif
      </form>
        @endforeach
    </p>
  </div>
@endsection
