<?php

namespace App\Http\Controllers;

use App\Models\Objeto;
use Illuminate\Http\Request;
use App\Http\Requests\StoreObjeto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ObjetoController extends Controller
{
    /* verifica autenticacion */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /* llena $objeto con la cantidad de objetos dentro de paginate() y retorna la vista index*/
    public function index()
    {
        $objetos = Objeto::paginate();
        return view('objetos.index' ,compact('objetos'));
    }

    /* solo retorna la vista create */
    public function create()
    {
        return view('objetos.create');
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
        $newFilename = md5($request->file('foto')->getClientOriginalName());
        $extension = $request->file('foto')->getClientOriginalExtension();
        if ($request->hasFile('foto')) {
            $objeto['foto']=$request->file('foto')->storeAs('public/uploads', $newFilename . '.'. $extension);
        }
        $objeto = [
            'name' => $request->input('name'),
            'foto' => Storage::url('public/uploads/'. $newFilename . '.'. $extension),
            'descripcion' => $request->input('descripcion'),
            'categoria' => $request->input('categoria'),
            'user_id' =>  auth()->user()->id,
        ];
        Objeto::insert($objeto);

        return redirect()->route('objetos.index', $objeto);
    }
    public function show(Objeto $objeto)
    {
        return view('objetos.show', compact('objeto')) ;
    }

    /* buscar registro mediante la id del objeto */
    public function edit($id)
    {
        $objeto=Objeto::findOrFail($id);
        return view('objetos.edit',compact('objeto'));
    }
    /* valida que los parametros sean requeridos en el formulario de ingreso */
    public function update(Request $request, Objeto $objeto)
    {
        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categoria' => 'required'
        ]);
        $objeto->update($request->all());
        return redirect()->route('objetos.show', $objeto);
    }

    public function destroy($id)
    {
        Objeto::destroy($id);
        return redirect()->route('objetos.index');
    }
}
