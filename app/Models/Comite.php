<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comite
 * 
 * @property int $idcomite
 * @property string|null $codigo
 * @property string|null $nombre
 * @property string|null $direccion
 * @property string|null $telefono
 * @property string|null $estado
 * @property string|null $coordinadora
 * @property int $idmunicipalidad
 *
 * @package App\Models
 */
class Comite extends Model
{
	protected $table = 'comite';
	protected $primaryKey = 'idcomite';
	public $timestamps = false;

	protected $casts = [
		'idmunicipalidad' => 'int'
	];

	protected $fillable = [
		'codigo',
		'nombre',
		'direccion',
		'telefono',
		'estado',
		'coordinadora',
		'idmunicipalidad'
	];

	public function municipalidad()
    {
        return $this->belongsTo(Municipalidad::class, 'idmunicipalidad');
    }
}
