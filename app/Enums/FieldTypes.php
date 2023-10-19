<?php

namespace App\Enums;

enum FieldTypes: string {
    case Texto = '1';
    case Numero = '2';
    case Fecha = '3';
    case Foto = '4';
    case Booleano = '5';
    case Seleccionable = '6';
}
