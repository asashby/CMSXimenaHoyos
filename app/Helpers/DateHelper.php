<?php
// Zona horarias

use Illuminate\Support\Carbon;

function fecha_string()
{
    $now = Carbon::now(config('app.timezone'));

    $fecha_dia = $now->format('d');
    $fecha_mes = $now->format('m');
    $fecha_year = $now->format('Y');

    $dia_semana = [
        "Monday" => "Lunes",
        "Tuesday" => "Martes",
        "Wednesday" => "Miercoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sabado",
        "Sunday" => "Domingo"
    ];

    $mese_year = [
        "01" => "Enero",
        "02" => "Febrero",
        "03" => "Marzo",
        "04" => "Abril",
        "05" => "Mayo",
        "06" => "Junio",
        "07" => "Julio",
        "08" => "Agosto",
        "09" => "Septiembre",
        "10" => "Octubre",
        "11" => "Noviembre",
        "12" => "Diciembre"
    ];

    $fecha_final = $dia_semana[$now->format('l')] . " " . $fecha_dia . " de " . $mese_year[$fecha_mes] . " de " . $fecha_year;

    return $fecha_final;
}
