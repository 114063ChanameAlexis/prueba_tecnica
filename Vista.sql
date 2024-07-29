CREATE VIEW vista_tareas AS
SELECT
    u.Idusuario,
    u.NombreApellido AS 'Nombre y Apellido',
    t.Idtarea,
    t.NombreTarea AS 'Nombre de Tarea',
    tt.Descripcion AS 'Descripción del Tipo de Tarea',
    e.Descripcion AS 'Descripción del Estado',
    t.TareaFinalizada as "Tarea Finalizada"
FROM
    tarea t
    JOIN usuario u ON t.Idusuario_asignado = u.Idusuario
    JOIN tipo_tarea tt ON t.Idtipo_tarea = tt.Idtipo_tarea
    JOIN estado e ON t.Idestado = e.Idestado;