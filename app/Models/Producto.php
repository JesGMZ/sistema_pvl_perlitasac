<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Producto
 * 
 * @property int $idproductos
 * @property string|null $descripcion
 * @property string|null $unidadmedida
 * @property string|null $marca
 * @property string|null $origen
 * @property string|null $fecha
 * @property string|null $cantidad
 * @property string|null $fechavencimiento

 * @package App\Models
 */
class Producto extends Model
{
	protected $table = 'productos';
	protected $primaryKey = 'idproductos';
	public $timestamps = false;

	protected $fillable = [
		'descripcion',
		'unidadmedida',
		'marca',
		'origen',
		'fecha',
		'cantidad',
		'fechavencimiento'
	];
}
