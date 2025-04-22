<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Municipalidad
 * 
 * @property int $idmunicipalidad
 * @property string|null $razonsocial
 * @property string|null $ruc
 * @property string|null $direccion
 * @property string|null $representante
 * @property string|null $estado
 *
 * @package App\Models
 */
class Municipalidad extends Model
{
	protected $table = 'municipalidad';
	protected $primaryKey = 'idmunicipalidad';
	public $timestamps = false;

	protected $fillable = [
		'razonsocial',
		'ruc',
		'direccion',
		'representante',
		'estado'
	];
}
