/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
DROP TABLE IF EXISTS `Usuarios`;
DROP TABLE IF EXISTS `Categorias`;
DROP TABLE IF EXISTS `Restaurantes`;
DROP TABLE IF EXISTS `Rest_Cat`;
DROP TABLE IF EXISTS `Comentarios`;

CREATE TABLE IF NOT EXISTS `Usuarios` (
    `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL, 
    `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
    `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `correo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
    `rol` int(11) NOT NULL,
    PRIMARY KEY (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Categorias` (  
  `id_categoria` INT (11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `clave` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Restaurantes` (
  `id_rest` INT (11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `apertura` INT (5) NOT NULL,
  `precio` INT (5) NOT NULL,
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_rest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Rest_Cat` (
  `id_rest` INT (11) NOT NULL,
  `id_categoria` INT (11) NOT NULL,
  PRIMARY KEY (`id_rest`, `id_categoria`),
  FOREIGN KEY (`id_rest`) REFERENCES `Restaurantes`(`id_rest`),
  FOREIGN KEY (`id_categoria`) REFERENCES `Categorias`(`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Comentarios` (
  `id_comentario` INT(11) NOT NULL AUTO_INCREMENT,
  `id_rest` INT(11) NOT NULL,
  `nombre_usuario` VARCHAR(50) COLLATE utf8mb4_general_ci NOT NULL,
  `fecha` DATE NOT NULL,
  `puntuacion` INT(1) NOT NULL,
  `comentario` TEXT COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_comentario`),
  FOREIGN KEY (`id_rest`) REFERENCES `Restaurantes`(`id_rest`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
