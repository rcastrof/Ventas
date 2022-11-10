@extends('layouts.logged')
@section('title', 'objetos ' . $objeto->name)
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>Objeto: {{ $objeto->name }}</h1>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{ route('objetos.edit', $objeto) }}">Editar</a>
                        <p><strong>Categoria:</strong></p>
                        <p>{{ $objeto->categoria }}</p>
                        <br>
                        <p><strong>Descripcion:</strong></p>
                        <p>{{ $objeto->descripcion }}</p>
                        <td>
                            <img src="{{ asset($objeto->foto) }}" alt="" width="200px">
                        </td>
                        <br>
                        <br>
                        <form action="{{ route('objetos.destroy', $objeto) }}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                            <button type="submit" onclick="return confirm('Quieres borrar?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
