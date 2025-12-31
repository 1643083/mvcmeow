DROP DATABASE IF EXISTS refugio;
CREATE DATABASE refugio;
USE refugio;


CREATE TABLE animal (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  nombre        VARCHAR(100) NOT NULL,
  especie       VARCHAR(50) NOT NULL,
  edad          INT,
  descripcion   VARCHAR(255),
  foto          VARCHAR(150),
  estado        ENUM('Disponible', 'Adoptado') DEFAULT 'Disponible',
  created       DATETIME      NOT NULL DEFAULT NOW(),
  updated       DATETIME      NULL
); ENGINE = INNODB;

INSERT INTO animal (nombre, especie, edad, descripcion, foto)
VALUES
('Firulais', 'Perro', 2, 'Juguetón y cariñoso', 'perro1.jpg'),
('Michi', 'Gato', 1, 'Muy tranquilo', 'gato1.jpg'),
('Luna', 'Perro', 3, 'Le encanta correr', 'perro2.jpg');

SELECT * FROM animal;