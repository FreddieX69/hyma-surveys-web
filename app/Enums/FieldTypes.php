<?php

namespace App\Enums;

enum FieldTypes: string {
    case Texto = '0';
    case ÁreaDeTexto = '1';
    case Número = '2';
    case Fecha = '3';
    case Foto = '4';
    case Booleano = '5';
    case SeleccionarRespuesta = '6';
}
