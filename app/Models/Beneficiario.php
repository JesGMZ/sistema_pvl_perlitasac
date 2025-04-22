<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Beneficiario
 * 
 * @property int $idbeneficiarios
 * @property string|null $nombres
 * @property string|null $apellidos
 * @property string|null $direccion
 * @property string|null $parentesco
 * @property string|null $sexo
 * @property int $idcategoria
 * @property int $idsocios
 * @property string|null $fechanacimiento
 * @property string|null $edad
 * @property string|null $estado
 *
 * @package App\Models
 */
class Beneficiario extends Model
{
	protected $table = 'beneficiarios';
	protected $primaryKey = 'idbeneficiarios';
	public $timestamps = false;

	protected $casts = [
		'idcategoria' => 'int',
		'idsocios' => 'int'
	];

	protected $fillable = [
		'nombres',
		'apellidos',
		'direccion',
		'parentesco',
		'sexo',
		'idcategoria',
		'idsocios',
		'fechanacimiento',
		'edad',
		'estado'
	];

	public function socio()
    {
        return $this->belongsTo(Socio::class, 'idsocios');
    }

	public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }	
}
