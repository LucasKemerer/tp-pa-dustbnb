SET NAMES utf8mb4;

CREATE DATABASE IF NOT EXISTS dustbnb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dustbnb;

DROP TABLE IF EXISTS usuarios;
DROP TABLE IF EXISTS departamentos;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL
);

CREATE TABLE departamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    capacidad INT NOT NULL,
    precio_noche DECIMAL(10,2) NOT NULL,
    disponible TINYINT(1) NOT NULL DEFAULT 1
);

INSERT INTO usuarios (usuario, contrasena) VALUES
('fcytuader', '$2y$10$tCdagwIiGyZ5Qlw/IoxlcOHtOoa2jlj83kLqSl9VG37WqAEpVLTGy');

INSERT INTO departamentos (nombre, direccion, capacidad, precio_noche, disponible) VALUES
('Monoambiente Costanera', 'Av. Laurencena 450, Paraná', 2, 28000.00, 1),
('Depto Parque Urquiza', 'Av. Estrada 1220, Paraná', 4, 42000.00, 1),
('Loft Centro', 'San Martín 870, Paraná', 2, 31500.00, 0),
('Casa Oro Verde', 'Ruta 11 Km 10,5, Oro Verde', 6, 65000.00, 1),
('Dúplex Puerto Viejo', 'Liniers 215, Paraná', 5, 54000.00, 0);
