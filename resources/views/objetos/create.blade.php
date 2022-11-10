@extends('layouts.logged')
@section('title','Objetos create')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h1>pagina para crear objetos</h1></div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('objetos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- token oculto --}}
                        <label>
                            Nombre:<br>
                            <input required type="text" name="name" value="{{old('name')}}">
                        </label>
                        @error('name')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                        @enderror
                        <br>
                        <label>
                            Imagen:<br>
                            <input type="file" required name="foto" id="foto" accept="image/*">
                            @error('foto')
                        <br>
                        <small class="text-danger">{{$message}}</small>
                        <br>
                        @enderror
                        </label>

                        <br>
                        <label>
                            Descripcion:<br>
                            <textarea name="descripcion" required rows="5">{{old('descripcion')}}</textarea>
                        </label>
                        @error('descripcion')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                        @enderror
                        <br>
                        <label>
                            Categoria:<br>
                            <select name="categoria" required id="categoria" class="form-control">
                                <option value="">Seleccione categoria</option>
                                @foreach ($categorias as $categoria)
                                <option value="{{$categoria['id']}}">{{$categoria['name']}}</option>
                                @endforeach
                            </select>
                        </label>
                        @error('categoria')
                        <br>
                        <small>*{{$message}}</small>
                        <br>
                        @enderror
                        <br>
                        <button type="submit">Crear</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
