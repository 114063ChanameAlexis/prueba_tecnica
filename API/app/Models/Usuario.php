<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Usuario
 * 
 * @property int $Idusuario
 * @property string $NombreApellido
 * @property string $Email
 * @property string|null $Calle
 * @property string|null $Altura
 * @property string|null $CodigoPostal
 * @property string|null $Localidad
 * @property string|null $Provincia
 * @property int|null $Activo
 * 
 * @property Collection|Tarea[] $tareas
 *
 * @package App\Models
 */
class Usuario extends Model
{
	protected $table = 'usuario';
	protected $primaryKey = 'Idusuario';
	public $timestamps = false;

	protected $casts = [
		'Activo' => 'int'
	];

	protected $fillable = [
		'NombreApellido',
		'Email',
		'Calle',
		'Altura',
		'CodigoPostal',
		'Localidad',
		'Provincia',
		'Activo'
	];

	public function tareas()
	{
		return $this->hasMany(Tarea::class, 'Idusuario_asignado');
	}
}
