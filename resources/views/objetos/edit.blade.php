@extends('layouts.logged')
@section('title', 'objeto edit')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>editar {{ $objeto->name }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('objetos.update', $objeto) }}" method="POST" enctype="multipart/form-data">
                            @csrf {{-- token oculto --}}
                            @method('put') {{-- cambia el metodo post del form action para actualizar con PUT --}}

                            <br>
                            <label>
                                Nombre:<br>
                                <input type="text" name="name" value="{{ old('name', $objeto->name) }}">
                            </label>
                            @error('name')
                                <br>
                                <small>*{{ $message }}</small>
                            @enderror
                            <br>
                            <br>

                            <label>
                                Descripcion:<br>
                                <textarea name="descripcion" rows="5">{{ old('descripcion', $objeto->descripcion) }}</textarea>
                            </label>
                            @error('descripcion')
                                <br>
                                <small>*{{ $message }}</small>
                                <br>
                            @enderror
                            <br>
                            <label>
                                Categoria:<br>
                                <input type="text" name="categoria" value="{{ old('categoria', $objeto->categoria) }}">
                            </label>
                            @error('categoria')
                                <br>
                                <small>*{{ $message }}</small>
                                <br>
                            @enderror
                            <br>
                            <button type="submit">editar</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
