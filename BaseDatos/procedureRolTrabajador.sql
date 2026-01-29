DELIMITER $$

CREATE PROCEDURE alta_trabajador (
    IN p_nombre VARCHAR(50),
    IN p_apellidos VARCHAR(50),
    IN p_email VARCHAR(50),
    IN p_hash_contrasena VARCHAR(255),
    IN p_telefono VARCHAR(9),
    IN p_puesto VARCHAR(25),
    IN p_salario DECIMAL(6,2),
    IN p_turno VARCHAR(10),
    IN p_fecha_contratacion DATE
)
BEGIN
    DECLARE v_id_usuario INT;

    START TRANSACTION;

    -- 1) Insertar en USUARIOS
    INSERT INTO USUARIOS (
        NOMBRE,
        APELLIDOS,
        EMAIL,
        CONTRASENA,
        ROL,
        CAMBIAR_PASSWORD
    ) VALUES (
        p_nombre,
        p_apellidos,
        p_email,
        p_hash_contrasena,
        'TRABAJADOR',
        TRUE
    );

    -- Guardamos el ID del usuario recién creado
    SET v_id_usuario = LAST_INSERT_ID();

    -- 2) Insertar en CLIENTES
    INSERT INTO CLIENTES (
        ID_USUARIO,
        TELEFONO,
        PUNTOS
    ) VALUES (
        v_id_usuario,
        p_telefono,
        0
    );

    -- 3) Insertar en EMPLEADOS
    INSERT INTO EMPLEADOS (
        ID_USUARIO,
        PUESTO,
        SALARIO,
        TURNO,
        FECHA_CONTRATACION
    ) VALUES (
        v_id_usuario,
        p_puesto,
        p_salario,
        p_turno,
        p_fecha_contratacion
    );

    COMMIT;
END$$

DELIMITER ;