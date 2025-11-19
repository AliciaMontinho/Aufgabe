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
    numero VARCHAR(100) NOT NULL,
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


INSERT INTO casas (nombre, direccion, telefono) VALUES
('Kronenhof', 'Calle Hauptstrasse 12, Zürich', '+41 44 123 4567'),
('Seefeld', 'Avenida Zürichsee 45, Zürich', '+41 44 987 6543'),
('Seeheim', 'Bahnhofstrasse 78, Zürich', '+41 44 654 3210');

INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES
('Anna', 'Müller', 'anna.muller@aufgabe.ch', '1234', 'trabajador'),
('Markus', 'Steiner', 'markus.steiner@aufgabe.ch', '1234', 'trabajador'),
('Jonas', 'Keller', 'jonas.keller@aufgabe.ch', '1234', 'tecnico'),
('Lena', 'Schmidt', 'lena.schmidt@aufgabe.ch', '1234', 'tecnico'),
('Alicia', 'Montinho','aliciamontinho@gmail.com', '1234', 'trabajador'),
('Artur', 'Montinho','martinsart@gmail.com', '1234', 'tecnico');

INSERT INTO habitaciones (numero, id_casa, descripcion) VALUES
('Sala de enfermeros', 1, 'Sala equipada para el personal de enfermería'),
('Ascensor principal', 1, 'Ascensor de acceso principal para pacientes y visitantes'),
('Sala de espera', 1, 'Área de espera cómoda para pacientes y familiares'),
('Ascensor de servicio', 1, 'Ascensor destinado para el transporte de equipos y suministros'),
('Sala de reuniones', 1, 'Espacio para reuniones del personal médico y administrativo'),
('101', 1, 'Habitación individual estándar'),
('102', 1, 'Habitación doble con vista al jardín'),
('103', 1, 'Habitación doble estándar'),
('104', 1, 'Habitación individual adaptada'),
('105', 1, 'Habitación doble con baño asistido'),
('106', 1, 'Habitación individual para cuidados paliativos'),
('107', 1, 'Habitación doble con accesibilidad total'),
('108', 1, 'Habitación individual con monitorización básica'),
('109', 1, 'Habitación doble económica'),
('110', 1, 'Habitación individual para estancias cortas'),
('111', 1, 'Habitación individual estándar'),
('112', 1, 'Habitación doble con cama articulada'),
('113', 1, 'Habitación individual silenciosa'),
('114', 1, 'Habitación doble para acompañantes'),
('115', 1, 'Habitación individual con baño privado'),
('116', 1, 'Habitación doble adaptada para personas mayores'),
('117', 1, 'Habitación individual con asistencia de enfermería'),
('118', 1, 'Habitación individual económica'),
('119', 1, 'Habitación doble con climatización especial'),
('120', 1, 'Habitación individual con espacio para silla de ruedas'),

('Ascensor principal', 2, 'Ascensor de acceso principal para pacientes y visitantes'),
('Sala de espera', 2, 'Área de espera cómoda para pacientes y familiares'),
('Sala de enfermeros', 2, 'Sala equipada para el personal de enfermería'),
('Ascensor de servicio', 2, 'Ascensor destinado para el transporte de equipos y suministros'),
('Sala de reuniones', 2, 'Espacio para reuniones del personal médico y administrativo'),
('201', 2, 'Habitación individual de rehabilitación'),
('202', 2, 'Habitación de fisioterapia'),
('203', 2, 'Habitación individual para terapia ocupacional'),
('204', 2, 'Habitación de hospitalización prolongada'),
('205', 2, 'Habitación doble postquirúrgica'),
('206', 2, 'Habitación de aislamiento estándar'),
('207', 2, 'Habitación individual con equipo de rehabilitación'),
('208', 2, 'Habitación doble de recuperación'),
('209', 2, 'Habitación individual para seguimiento diario'),
('210', 2, 'Habitación de rehabilitación avanzada'),
('211', 2, 'Habitación individual para ejercicios asistidos'),
('212', 2, 'Habitación doble para recuperación física'),
('213', 2, 'Habitación individual con equipamiento de terapia'),
('214', 2, 'Habitación para evaluación postoperatoria'),
('215', 2, 'Habitación individual de seguimiento funcional'),
('216', 2, 'Habitación de fisioterapia respiratoria'),
('217', 2, 'Habitación doble para movilidad reducida'),
('218', 2, 'Habitación de ejercicios musculares guiados'),
('219', 2, 'Habitación individual equipada con barras de apoyo'),
('220', 2, 'Habitación para dos pacientes en rehabilitación'),

('Ascensor principal', 3, 'Ascensor de acceso principal para pacientes y visitantes'),
('Sala de espera', 3, 'Área de espera cómoda para pacientes y familiares'),
('Sala de enfermeros', 3, 'Sala equipada para el personal de enfermería'),
('Ascensor de servicio', 3, 'Ascensor destinado para el transporte de equipos y suministros'),
('Sala de reuniones', 3, 'Espacio para reuniones del personal médico y administrativo'),
('301', 3, 'Habitación psiquiátrica segura'),
('302', 3, 'Habitación de observación psiquiátrica'),
('303', 3, 'Habitación de monitoreo constante'),
('304', 3, 'Habitación acolchada'),
('305', 3, 'Habitación de contención supervisada'),
('306', 3, 'Habitación de baja estimulación'),
('307', 3, 'Habitación individual segura'),
('308', 3, 'Habitación de ingreso psiquiátrico'),
('309', 3, 'Habitación doble con supervisión continua'),
('310', 3, 'Habitación psiquiátrica con vigilancia intermitente'),
('311', 3, 'Habitación individual de observación continua'),
('312', 3, 'Habitación de soporte emocional'),
('313', 3, 'Habitación segura para crisis'),
('314', 3, 'Habitación individual con mobiliario protegido'),
('315', 3, 'Habitación de estabilización temporal'),
('316', 3, 'Habitación de aislamiento psiquiátrico'),
('317', 3, 'Habitación doble con control de estímulos'),
('318', 3, 'Habitación de ingreso involuntario'),
('319', 3, 'Habitación terapéutica con monitoreo'),
('320', 3, 'Habitación individual para tratamiento intensivo');


INSERT INTO incidencias (titulo, descripcion, relevancia, estado, fecha_inicio, fecha_fin, id_habitacion, id_creador, id_tecnico)
VALUES
('Luz fundida en baño', 'La luz del baño no funciona', 'medio', 'no_atendido', '2025-01-15 09:00:00', NULL, 38, 5, NULL),
('Fuga de agua en pasillo', 'Se observa humedad en la pared', 'alto', 'no_atendido', '2025-02-08 11:20:00', NULL, 33, 5, NULL),
('Ascensor estropeado', 'El ascensor no arranca correctamente', 'alto', 'en_proceso', '2025-02-12 08:15:00', NULL, 15, 1, 4),
('Ventana rota', 'Cristal agrietado en la ventana', 'medio', 'en_proceso', '2025-02-10 15:00:00', NULL, 54, 5, 2),
('Cama eléctrica no sube', 'El motor de la cama no responde al botón', 'alto', 'completado', '2025-01-20 10:00:00', '2025-01-21 16:30:00', 70, 2, 4),
('Problemas de calefacción', 'Temperatura demasiado baja en invierno', 'medio', 'completado', '2024-02-01 08:00:00', '2024-02-03 12:45:00', 29, 5, 3),
('Mal olor en la habitación', 'Posible fuga en el sistema de ventilación', 'bajo', 'completado', '2023-01-10 14:00:00', '2023-01-11 09:20:00', 21, 2, 6),
('Puerta principal no cierra', 'La cerradura no hace clic bien', 'medio', 'completado', '2023-01-29 09:30:00', '2023-01-29 11:40:00', 46, 2, 6);
