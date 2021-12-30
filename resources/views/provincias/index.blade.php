@extends('layouts.main')

@section('content')
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Provincias
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
                    <form method="GET" action="{{route('provincias.index')}}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Provincia">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                 <div>
                    <a href="{{route('provincias.create')}}" class="btn btn-primary mb-2">Crear Provincia</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Codigo País</th>
                <th scope="col">Nombre</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            @foreach ($provincias as $provincia)
                <tr>
                    <th scope="row">{{ $provincia->id }}</th>
                    <td>{{ $provincia->pais->codigo_pais }}</td>
                    <td>{{ $provincia->nombre }}</td>
                    <td>
                        <div class="row">
                            <div class="col">
                                <a href="{{route('provincias.edit', $provincia->id)}}" class="btn btn-success">Editar</a>
                            </div>
                            <div class="col">
                                <form method="POST" action="{{ route('provincias.destroy', $provincia->id) }}">
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