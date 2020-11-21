
@extends('layouts.principal')
@section('conteudo')


<div class="jumbotron">
    <span class="badge badge-pill badge-primary">ID: {{$atividades['id']}}</span>
    <span class="badge badge-pill badge-primary">status: {{$atividades['status']}}</span>
    @if($atividades['status']==0)   
    <span class="badge badge-pill badge-success">Concluida</span>
    
    @else
    <span class="badge badge-pill badge-danger">Não concluida</span>
    
    @endif
    
    <h1 class="display-4">{{$atividades['nome']}}</h1>
    <p class="lead">Conclua essa tarefa para ganhar pontos na puta que te pariu</p>
    <hr class="my-4">
    <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
    <a class="btn btn-primary btn-lg" href="{{route('atividades.index')}}" role="button">Voltar</a>
    @if($atividades['status']==0)
    <a class="btn btn-warning btn-lg" href="{{route('atividades.index')}}" role="button">Desfazer Atividade</a>
    @else
    <a class="btn btn-primary btn-lg" href="http://127.0.0.1:8000/atividades/update/{{$atividades['id']}}/concluir" role="button">Concluir Atividade</a>
    @endif
    
    <form action="{{route('atividade.destroy', $atividades['id']) }}" method="POST">
      @csrf
      @method('DELETE') 
      <button type="submit"  class="btn btn-danger  btn-lg">Excluir Atividade</button>
  </form>
  </div>


@endsection