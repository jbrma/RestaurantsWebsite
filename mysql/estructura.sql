/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
DROP TABLE IF EXISTS `Usuarios`;
DROP TABLE IF EXISTS `Editores`;
DROP TABLE IF EXISTS `Categorias`;
DROP TABLE IF EXISTS `Restaurantes`;

CREATE TABLE IF NOT EXISTS `Usuarios` (
    `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL, 
    `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
    `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `correo` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
    `rol` varchar(15) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Usuario',
    PRIMARY KEY (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Editores` (
    `id_editor` INT (11) NOT NULL AUTO_INCREMENT,
    `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `nombre` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
    `password` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
   PRIMARY KEY (`id_editor`)
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
  `direccion` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `id_editor`  INT (11) NOT NULL,
  PRIMARY KEY (`id_rest`),
  FOREIGN KEY (`id_editor`) REFERENCES `Editores`(`id_editor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `Rest_Cat` (
  `id_rest` INT (11) NOT NULL,
  `id_categoria` INT (11) NOT NULL,
  PRIMARY KEY (`id_rest`, `id_categoria`),
  FOREIGN KEY (`id_rest`) REFERENCES `Restaurantes`(`id_rest`),
  FOREIGN KEY (`id_categoria`) REFERENCES `Categorias`(`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
