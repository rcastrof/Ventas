@extends('layouts.app')
@section('title', 'Objeto ver')
@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>mis objetos</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a href="{{ route('objetos.create') }}">Crear objeto</a>
                        <ul>
                            @foreach ($objetos as $objeto)

                                <li>
                                    <a href="{{ route('objetos.show', $objeto->id) }}">{{ $objeto->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
