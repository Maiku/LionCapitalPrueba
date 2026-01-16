<?php

namespace App\Utils;
/*Trait para poder obtener las columnas formateadas para consultas con joins en eloquent*/
/* Resultado: TABLADELMODELO.COLUMNAINVOCADA */
use Illuminate\Database\Eloquent\Model;

trait TableGetColumn
{
    public static function getColumn(string $column, string $alias = null): string
    {
        /** @var Model $model */
        $model = new static();
        //Añadimos el alias a la columna si hubiese
        if($alias) $column .= ' as '.$alias;
        //Devolvemos combo
        return $model->getTable() . '.' . $column;
    }
}
