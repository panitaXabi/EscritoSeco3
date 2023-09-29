<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TareaController extends Controller
{
    use Illuminate\Support\Facades\DB;

public function crearTareaConCategoriasYRevision()
{
    DB::beginTransaction();

    try {
        $tarea = new Tarea([
            'titulo' => 'gonzalo escrito',
            'contenido' => 'gonzalo no me pongas 1',
            'estado' => 'secoooo',
            'usuario_id' => 1, 
        ]);
        $tarea->save();

        
        $tarea->categorias()->attach([1, 2]);

        $revision = new Revision([
            'detalle' => 'gonzalo asdasd',
            'tarea_id' => $tarea->id,
        ]);
        $revision->save();

        DB::commit();
        
        return response()->json(['message' => 'Tarea creada '], 200);
    } catch (\Exception $e) {
        DB::rollback();


        return response()->json(['message' => 'Error con la tarea'], 500);
    }
}

}
