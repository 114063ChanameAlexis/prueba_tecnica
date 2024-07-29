SELECT 
    t.NombreTarea AS 'Tarea',
    u.NombreApellido AS 'Nombre y Apellido',
    u.Email,
    t.Descripcion AS 'Descripcion',
    e.Descripcion AS 'Estado'
FROM 
    tarea t
    JOIN usuario u ON t.Idusuario_asignado = u.Idusuario
    JOIN tipo_tarea tt ON t.Idtipo_tarea = tt.Idtipo_tarea
    JOIN estado e ON t.Idestado = e.Idestado

-----------------------------------------------------------------
    
SELECT 
    u.NombreApellido AS NombreApellido,
    COUNT(t.Idtarea) AS CantidadTareas
FROM 
    usuario u
JOIN 
    tarea t ON u.Idusuario = t.Idusuario_asignado
GROUP BY
    u.Idusuario, u.NombreApellido;

-----------------------------------------------------------------   
   
SELECT 
    u.NombreApellido AS NombreApellido,
    e.Descripcion AS Estado,
    COUNT(t.Idtarea) AS CantidadTareas
FROM 
    usuario u
JOIN 
    tarea t ON u.Idusuario = t.Idusuario_asignado
JOIN 
    estado e ON t.Idestado = e.Idestado
GROUP BY
    u.Idusuario, u.NombreApellido, e.Idestado, e.Descripcion
ORDER BY 
    u.NombreApellido, e.Descripcion;

-----------------------------------------------------------------

SELECT 
    u.Idusuario,
    u.NombreApellido,
    COUNT(t.Idtarea) AS CantidadTareasSinFinalizar
FROM
    usuario u
JOIN
    tarea t ON u.Idusuario = t.Idusuario_asignado AND t.TareaFinalizada = 0
GROUP BY 
    u.Idusuario, u.NombreApellido
HAVING 
    COUNT(t.Idtarea) > 10;
    
-----------------------------------------------------------------