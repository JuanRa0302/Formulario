<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use Illuminate\Http\Request;

class FormularioController extends Controller
{
    public function index()
    {
        $paisesYPrefijos = $this->getPrefix();

        return view('formulario', compact('paisesYPrefijos'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'telefono'          => 'required',
            'prefijo'           => 'required',
            'email'             => 'required|email',
            'contrasena'        => 'required',
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

        $formulario = Formulario::create([
            'telefono'          => $request->input('telefono'),
            'prefijo'           => $request->input('prefijo'),
            'email'             => $request->input('email'),
            'contrasena'        => $request->input('contrasena'),
            'codigo'            => $this->generateRandomCode(),
            'documento_adverso' => $documentoAdversoPath,
            'documento_reverso' => $documentoReversoPath,
            'estado'            => false,
            'numero_serie'      => $this->generateSerialNumber(),
        ]);

        return view('datos_enviados', [
            'datosEnviados'        => $datosEnviados,
            'documentoAdversoPath' => $documentoAdversoPath,
            'documentoReversoPath' => $documentoReversoPath,
        ]);
    }

    public function getPrefix()
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

    public function generateRandomCode($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        $charactersLength = strlen($characters);

        for ($i = 0; $i < $length; $i++) {
            $code .= $characters[rand(0, $charactersLength - 1)];
        }

        return $code;
    }

    public function generateSerialNumber($length = 10): string
    {
        $serial = '';
        $digits = '0123456789';
        $digitsLength = strlen($digits);

        for ($i = 0; $i < $length; $i++) {
            $serial .= $digits[rand(0, $digitsLength - 1)];
        }

        return $serial;
    }

    public function findByCode($code)
    {
        return Formulario::where('codigo', '=', $code)->first();
    }

    public function findBySerialNumber($serial_number)
    {
        return Formulario::where('numero_serie', '=', $serial_number)->first();
    }
}
