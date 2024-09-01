WITH EstadoReciente AS (
    SELECT 
        ve.vacante_id, 
        ve.estado_id, 
        ve.fecha_desde
    FROM 
        vacantes_estados ve
    INNER JOIN (
        SELECT 
            vacante_id, 
            MAX(fecha_desde) AS max_fecha_desde
        FROM 
            vacantes_estados
        GROUP BY 
            vacante_id
    ) ve_max ON ve.vacante_id = ve_max.vacante_id 
              AND ve.fecha_desde = ve_max.max_fecha_desde
)

INSERT INTO vacantes_estados (vacante_id, estado_id, fecha_desde, observacion)
SELECT 
    v.id, 
    2,  -- ID del estado "Abierta"
    GETDATE(),  
    'Cambio automático a abierta'
FROM 
    vacantes v
INNER JOIN 
    EstadoReciente er ON v.id = er.vacante_id
WHERE 
    er.estado_id = 1002  -- ID del estado "Creada"
    AND v.fecha_ini <= GETDATE();
