CREATE DATABASE gestion_tareas;

USE gestion_tareas;

CREATE TABLE estado (
    Idestado INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(100),
    Activo TINYINT DEFAULT 1
);

CREATE TABLE tipo_tarea (
    Idtipo_tarea INT AUTO_INCREMENT PRIMARY KEY,
    Descripcion VARCHAR(100),
    Activo TINYINT DEFAULT 1
);

CREATE TABLE usuario (
    Idusuario INT AUTO_INCREMENT PRIMARY KEY,
    NombreApellido VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Calle VARCHAR(100),
    Altura VARCHAR(20),
    CodigoPostal VARCHAR(20),
    Localidad VARCHAR(100),
    Provincia VARCHAR(100),
    Activo TINYINT DEFAULT 1,
    UNIQUE KEY (Email)
);

CREATE TABLE tarea (
    Idtarea INT AUTO_INCREMENT PRIMARY KEY,
    NombreTarea VARCHAR(100) NOT NULL,
    Descripcion VARCHAR(250),
    Idtipo_tarea INT,
    FechaCreacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    FechaModificacion DATETIME,
    Idestado INT,
    Idusuario_asignado INT,
    TareaFinalizada TINYINT DEFAULT 0,
    FOREIGN KEY (Idtipo_tarea) REFERENCES tipo_tarea(Idtipo_tarea),
    FOREIGN KEY (Idestado) REFERENCES estado(Idestado),
    FOREIGN KEY (Idusuario_asignado) REFERENCES usuario(Idusuario)
);