@extends('layouts.main')

@section('content')
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Usuarios
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
                    <form method="GET" action="{{route('users.index')}}">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <input type="search" name="search" class="form-control mb-2" id="inlineFormInput" placeholder="Usuario o Email">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary mb-2">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                 <div>
                    <a href="{{route('users.create')}}" class="btn btn-primary mb-2">Crear Usuario</a>
                </div>
            </div>
        </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">Usuario</th>
                <th scope="col">Email</th>
                <th scope="col">Acciones</th>
                </tr>
            </thead>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->usuario }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-success">Editar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>


@endsection