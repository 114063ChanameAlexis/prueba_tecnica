<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoTarea
 * 
 * @property int $Idtipo_tarea
 * @property string|null $Descripcion
 * @property int|null $Activo
 * 
 * @property Collection|Tarea[] $tareas
 *
 * @package App\Models
 */
class TipoTarea extends Model
{
	protected $table = 'tipo_tarea';
	protected $primaryKey = 'Idtipo_tarea';
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
		return $this->hasMany(Tarea::class, 'Idtipo_tarea');
	}
}
