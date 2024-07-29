DELIMITER //

CREATE PROCEDURE ReporteTareasPorUsuario(IN idusuario INT)
BEGIN
	
    DECLARE v_idtarea INT;
    DECLARE v_fecha_modificacion DATETIME;
    DECLARE v_tarea_finalizada TINYINT;
    DECLARE v_tareas_finalizadas INT DEFAULT 0;
    DECLARE v_tareas_no_finalizadas INT DEFAULT 0;
    DECLARE v_tarea_mas_reciente INT DEFAULT NULL;
    DECLARE v_fecha_mas_reciente DATETIME DEFAULT '0000-00-00 00:00:00';


    DECLARE cur_tareas CURSOR FOR
        SELECT Idtarea, FechaModificacion, TareaFinalizada
        FROM tarea
        WHERE Idusuario_asignado = idusuario;

    DECLARE CONTINUE HANDLER FOR NOT FOUND
        SET v_idtarea = NULL;

    OPEN cur_tareas;

    bucle: LOOP
        FETCH cur_tareas INTO v_idtarea, v_fecha_modificacion, v_tarea_finalizada;
        IF v_idtarea IS NULL THEN
            LEAVE bucle;
        END IF;

        IF v_tarea_finalizada = 1 THEN
            SET v_tareas_finalizadas = v_tareas_finalizadas + 1;
        ELSE
            SET v_tareas_no_finalizadas = v_tareas_no_finalizadas + 1;
        END IF;

        IF v_fecha_modificacion > v_fecha_mas_reciente THEN
            SET v_fecha_mas_reciente = v_fecha_modificacion;
            SET v_tarea_mas_reciente = v_idtarea;
        END IF;
    END LOOP;

    CLOSE cur_tareas;

    SELECT
        v_tareas_finalizadas AS TareasFinalizadas,
        v_tareas_no_finalizadas AS TareasNoFinalizadas,
        v_tarea_mas_reciente AS TareaMasReciente;
END

//