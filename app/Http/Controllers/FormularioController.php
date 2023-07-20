<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        $paisesYPrefijos = $this->getPrefijos();

        return view('formulario', compact('paisesYPrefijos'));
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'telefono' => 'required',
            'prefijo' => 'required',
            'email' => 'required|email',
            'contrasena' => 'required',
            'documento_adverso' => 'required|mimes:pdf,jpg,jpeg,png',
            'documento_reverso' => 'required|mimes:pdf,jpg,jpeg,png',
        ]);

        $datosEnviados = (object) [
            'telefono'   => $request->input('telefono'),
            'prefijo'    => $request->input('prefijo'),
            'email'      => $request->input('email'),
            'contrasena' => $request->input('contrasena'),
        ];

        $documentoAdversoPath = $request->file('documento_adverso')->store('documentos', 'public');
        $documentoReversoPath = $request->file('documento_reverso')->store('documentos', 'public');

        return view('datos_enviados', [
            'datosEnviados' => $datosEnviados,
            'documentoAdversoPath' => $documentoAdversoPath,
            'documentoReversoPath' => $documentoReversoPath,
        ]);
    }

    public function getPrefijos()
    {
        return [
            'Argentina'      => ['+54'],
            'Bolivia'        => ['+591'],
            'Brasil'         => ['+55'],
            'Canadá'         => ['+1'],
            'Chile'          => ['+56'],
            'Colombia'       => ['+57'],
            'Cuba'           => ['+53'],
            'Ecuador'        => ['+593'],
            'España'         => ['+34'],
            'Estados Unidos' => ['+1'],
            'Francia'        => ['+33'],
            'Italia'         => ['+39'],
            'México'         => ['+52'],
            'Perú'           => ['+51'],
            'Reino Unido'    => ['+44'],
            'Rusia'          => ['+7'],
            'Sudáfrica'      => ['+27'],
            'Uruguay'        => ['+598'],
            'Venezuela'      => ['+58'],
        ];
    }
}
