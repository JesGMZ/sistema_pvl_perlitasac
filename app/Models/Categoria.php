<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Categoria
 * 
 * @property int $idcategoria
 * @property string|null $descategoria
 * @property string|null $estado
 *
 * @package App\Models
 */
class Categoria extends Model
{
	protected $table = 'categoria';
	protected $primaryKey = 'idcategoria';
	public $timestamps = false;

	protected $fillable = [
		'descategoria',
		'estado'
	];
}
