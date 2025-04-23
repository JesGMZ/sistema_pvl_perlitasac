<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Pvl
 * 
 * @property int $idpvl
 * @property string|null $fecha
 * @property int $idbeneficiarios
 * @property int $idcomite
 * @property string|null $estado
 * @property string|null $mes
 *
 * @package App\Models
 */
class Pvl extends Model
{
	protected $table = 'pvl';
	protected $primaryKey = 'idpvl';
	public $timestamps = false;

	protected $casts = [
		'idbeneficiarios' => 'int',
		'idcomite' => 'int'
	];

	protected $fillable = [
		'fecha',
		'idbeneficiarios',
		'idcomite',
		'estado',
		'mes'
	];

	public function beneficiario()
	{
		return $this->belongsTo(Beneficiario::class, 'idbeneficiarios');
	}
	
	public function comite()
	{
		return $this->belongsTo(Comite::class, 'idcomite');
	}
	
}
