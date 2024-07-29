<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 * 
 * @property int $Idestado
 * @property string|null $Descripcion
 * @property int|null $Activo
 * 
 * @property Collection|Tarea[] $tareas
 *
 * @package App\Models
 */
class Estado extends Model
{
	protected $table = 'estado';
	protected $primaryKey = 'Idestado';
	public $timestamps = false;

	protected $casts = [
		'Activo' => 'int'
	];

	protected $fillable = [
		'Descripcion',
		'Activo'
	];

	public function tareas()
	{
		return $this->hasMany(Tarea::class, 'Idestado');
	}
}
