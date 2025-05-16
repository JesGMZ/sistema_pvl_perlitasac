<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Socio
 * 
 * @property int $idsocios
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $dni
 * @property string|null $direccion
 * @property string|null $sexo
 * @property string|null $fechanacimiento
 * @property string|null $edad
 *
 * @package App\Models
 */
class Socio extends Model
{
	protected $table = 'socios';
	protected $primaryKey = 'idsocios';
	public $timestamps = false;

	protected $fillable = [
		'nombres',
		'apellidos',
		'dni',
		'direccion',
		'sexo',
		'fechanacimiento',
		'edad'
	];
}