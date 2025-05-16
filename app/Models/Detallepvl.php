<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Detallepvl
 * 
 * @property int $iddetallepvl
 * @property string|null $cantidad
 * @property string|null $precio
 * @property int $idproductos
 * @property int $idpvl
 *
 * @package App\Models
 */
class Detallepvl extends Model
{
	protected $table = 'detallepvl';
	protected $primaryKey = 'iddetallepvl';
	public $timestamps = false;

	protected $casts = [
		'idproductos' => 'int',
		'idpvl' => 'int'
	];

	protected $fillable = [
		'cantidad',
		'precio',
		'idproductos',
		'idpvl'
	];

	public function pvl()
    {
        return $this->belongsTo(Pvl::class, 'idpvl');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproductos');
    }
}