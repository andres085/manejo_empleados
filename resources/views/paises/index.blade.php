@extends('layouts.main')

@section('content')
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Paises
    </h1>
</div>
<div class="row">
    <div class="card mx-auto">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <form method="GET" action="{{route('paises.index')}}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="País">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                 <div>
                    <a href="{{route('paises.create')}}" class="btn btn-primary mb-2">Crear País</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Codigo</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            @foreach ($paises as $pais)
                <tr>
                    <th scope="row">{{ $pais->id }}</th>
                    <td>{{ $pais->codigo_pais }}</td>
                    <td>{{ $pais->nombre }}</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <a href="{{route('paises.edit', $pais->id)}}" class="btn btn-success">Editar</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('paises.destroy', $pais->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" onclick="return confirm('¿Esta seguro que desea borrar?')">Borrar</button>
                                </form> 
                            </div>
                            
                        </div>
                    </td>
                    
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>


@endsection