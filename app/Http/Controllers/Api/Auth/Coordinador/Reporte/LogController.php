<?php

namespace App\Http\Controllers\Api\Auth\Coordinador\Reporte;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    public function logNotificaciones()
    {
        $log = DB::table('notificaciones')
        ->orderBy('fecha', 'DESC')
        ->take(100)
        ->get();

        return response()->json(['message' => $log],200);
    }
}
