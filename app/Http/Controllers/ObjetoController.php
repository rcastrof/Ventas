<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObjeto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ObjetoController extends Controller
{
    /* verifica autenticacion */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $objetos = Objeto::where('user_id', Auth::user()->id)->get();
        return view('objetos.index' ,compact('objetos'));
    }

    /* solo retorna la vista create */
    public function create()
    {
        $categorias = Categoria::all();
        return view('objetos.create', compact('categorias'));
    }

    /*
    se excluye el token del request y se requiere que 'foto' sea una imagen

    obtiene el nombre del archivo y la extension
    para poder guardarlos como url dentro de $objeto

    almacena dentro de Storage/uploads la foto bajo el nombre y extension
    */
    public function store(Request $request, Objeto $objeto)
    {
        $objeto = request()->except('_token');
        $request->validate([
            'foto' => 'required|image'
        ]);
        $fileName = time().$request->file('foto')->getClientOriginalName();
        $path = $request->file('foto')->storeAs('uploads', $fileName , 'public');


        $objeto = [
            'name' => $request->input('name'),
            'foto' => '/storage/'.$path,
            'descripcion' => $request->input('descripcion'),
            'categoria_id' => $request->get('categoria'),
            'user_id' =>  auth()->user()->id,
        ];
        Objeto::insert($objeto);

        return redirect()->route('objetos.index', $objeto);
    }
    public function show(Objeto $objeto)
    {
        $categorias = Categoria::all();
        return view('objetos.show', compact('objeto','categorias')) ;
    }

    /* buscar registro mediante la id del objeto */
    public function edit($id)
    {
        $categorias = Categoria::all();
        $objeto=Objeto::findOrFail($id);
        return view('objetos.edit',compact('objeto','categorias'));
    }
    /* valida que los parametros sean requeridos en el formulario de ingreso */
    public function update(Request $request, Objeto $objeto)
    {

        $objeto->update($request->all());
        return redirect()->route('objetos.show', $objeto);
    }

    public function destroy($id)
    {
        Objeto::destroy($id);
        return redirect()->route('objetos.index');
    }
}
