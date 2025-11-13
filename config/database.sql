CREATE DATABASE IF NOT EXISTS aufgabe_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE aufgabe_db;

CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol ENUM('tecnico', 'trabajador') NOT NULL DEFAULT 'trabajador',
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE casas (
    id_casa INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255),
    telefono VARCHAR(20)
);


CREATE TABLE habitaciones (
    id_habitacion INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(20) NOT NULL,
    id_casa INT NOT NULL,
    descripcion VARCHAR(255),
    FOREIGN KEY (id_casa) REFERENCES casas(id_casa)
        ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE incidencias (
    id_incidencia INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    relevancia ENUM('bajo', 'medio', 'alto') DEFAULT 'medio',
    estado ENUM('no_atendido', 'en_proceso', 'completado') DEFAULT 'no_atendido',
    fecha_inicio DATETIME DEFAULT CURRENT_TIMESTAMP,
    fecha_fin DATETIME NULL,
    id_habitacion INT,
    id_creador INT NOT NULL,
    id_tecnico INT NULL,
    FOREIGN KEY (id_habitacion) REFERENCES habitaciones(id_habitacion)
        ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (id_creador) REFERENCES usuarios(id_usuario)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tecnico) REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE historial_estados (
    id_historial INT AUTO_INCREMENT PRIMARY KEY,
    id_incidencia INT NOT NULL,
    estado_anterior ENUM('no_atendido', 'en_proceso', 'completado') NULL,
    estado_nuevo ENUM('no_atendido', 'en_proceso', 'completado') NOT NULL,
    fecha_cambio DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_tecnico INT,
    FOREIGN KEY (id_incidencia) REFERENCES incidencias(id_incidencia)
        ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (id_tecnico) REFERENCES usuarios(id_usuario)
        ON DELETE SET NULL ON UPDATE CASCADE
);

INSERT INTO casas (nombre, direccion, telefono) VALUES
('Kronenhof', 'Calle Hauptstrasse 12, Zürich', '+41 44 123 4567'),
('Seefeld', 'Avenida Zürichsee 45, Zürich', '+41 44 987 6543'),
('Seeheim', 'Bahnhofstrasse 78, Zürich', '+41 44 654 3210');

INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES
('Anna', 'Müller', 'anna.muller@aufgabe.ch', '1234', 'trabajador'),
('Markus', 'Steiner', 'markus.steiner@aufgabe.ch', '1234', 'trabajador'),
('Jonas', 'Keller', 'jonas.keller@aufgabe.ch', '1234', 'tecnico'),
('Lena', 'Schmidt', 'lena.schmidt@aufgabe.ch', '1234', 'tecnico');

INSERT INTO habitaciones (numero, id_casa, descripcion) VALUES
('101', 1, 'Habitación doble con cama eléctrica'),
('102', 1, 'Habitación individual'),
('201', 2, 'Habitación de rehabilitación'),
('301', 3, 'Habitación psiquiátrica segura');

INSERT INTO incidencias (titulo, descripcion, relevancia, estado, id_habitacion, id_creador, id_tecnico)
VALUES
('Luz fundida en baño', 'La bombilla del baño no enciende.', 'medio', 'no_atendido', 1, 1, 3),
('Cama eléctrica no sube', 'El motor de la cama no responde.', 'alto', 'en_proceso', 3, 2, 4);

INSERT INTO historial_estados (id_incidencia, estado_anterior, estado_nuevo, id_tecnico)
VALUES
(2, 'no_atendido', 'en_proceso', 4);
