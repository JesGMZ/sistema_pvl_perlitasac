<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $idusuario
 * @property string|null $usuario
 * @property string|null $clave
 * @property string|null $estado
 * @property int $idmunicipalidad
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'idusuario';
	public $timestamps = false;

	protected $casts = [
		'idmunicipalidad' => 'int'
	];

	protected $fillable = [
		'usuario',
		'clave',
		'estado',
		'idmunicipalidad'
	];

	public function municipalidad()
    {
        return $this->belongsTo(Municipalidad::class, 'idmunicipalidad');
    }
}
