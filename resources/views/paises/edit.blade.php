@extends('layouts.main')

@section('content')
    
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">
        Paises
    </h1>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar País') }}
                <a href="{{route('paises.index')}}" class="float-right">Volver</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('paises.update', $pais->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="codigo_pais" class="col-md-4 col-form-label text-md-right">{{ __('Codigo') }}</label>

                            <div class="col-md-6">
                                <input id="codigo_pais" type="text" class="form-control @error('codigo_pais') is-invalid @enderror" name="codigo_pais" value="{{ old('codigo_pais', $pais->codigo_pais) }}" required>

                                @error('codigo_pais')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre', $pais->nombre) }}" required autocomplete="nombre" autofocus>

                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Actualizar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection