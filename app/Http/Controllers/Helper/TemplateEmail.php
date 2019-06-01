<?php

namespace App\Http\Controllers\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateEmail extends Controller
{
    public static function resetPassword($code)
    {
        return '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Cambiar contraseña</title>
        </head>
        <body>
           <h2>Hola cambio de contraseña</h2>
           <p>Aqui tiene su codigo de confirmacion, para cambiar su contraseña <h2>'.$code.'</h2></p>
        </body>
        </html>';
    }

    public static function soporteTecnico($message)
    {
        return '<!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Soporte tecnico</title>
        </head>
        <body>
           <h2>Soporte tecnico</h2>
           <p><h2>'.$message.'</h2></p>
        </body>
        </html>';
    }
}
