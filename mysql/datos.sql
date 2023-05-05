/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
TRUNCATE TABLE `Usuarios`;
TRUNCATE TABLE `Categorias`;
TRUNCATE TABLE `Restaurantes`;
TRUNCATE TABLE `Rest_Cat`;

/*
  user: userpass
  admin: adminpass
*/
INSERT INTO `Usuarios` (`username`, `password`, `nombre`,`correo`,`rol`) VALUES
('admin', 'adminpass', 'Celia', 'admin@gmail.com', 1),
('user1', 'pedro', 'Pedro', 'pedro@gmail.com', 2),
('user2', 'maria', 'Maria', 'maria@gmail.com', 2),
('editor1', 'editorpass', 'Juan', 'edit1@gmail.com', 3);

INSERT INTO `Categorias` (`id_categoria`, `nombre`, `clave`) VALUES
(1, 'Mexicano', '1'),
(2, 'Chino', '2'),
(3, 'Italiano', '3');

INSERT INTO `Restaurantes` (`id_rest`, `nombre`, `apertura`, `precio`, `direccion`, `imagen`) VALUES
(1, 'Restaurante Mexicano', 1990, 8, 'Calle 1, Ciudad de Mexico', 'img/mexicano.jpg'),
(2, 'Restaurante Chino', 1985, 12, 'Calle 2, Pekín', 'img/chino.jpg'),
(3, 'Restaurante Italiano', 2000, 18, 'Calle 3, Roma', 'img/italiano.jpg');

INSERT INTO `Rest_Cat` (`id_rest`, `id_categoria`) VALUES
(1, 1),
(2, 2),
(3, 3);

INSERT INTO `Comentarios` (`id_rest`, `nombre_usuario`, `fecha`, `puntuacion`, `comentario`) VALUES
(1, 'Juan Perez', '2023-04-15', 4, 'La comida estuvo deliciosa, pero el servicio fue un poco lento.'),
(2, 'Maria Garcia', '2023-04-20', 5, 'Excelente servicio y la comida es espectacular, definitivamente volveré.'),
(2, 'Luis Ramirez', '2023-03-25', 3, 'La comida es buena, pero esperaba más variedad en el menú.'),
(3, 'Ana Rodriguez', '2023-04-05', 4, 'El ambiente es agradable y la comida es sabrosa, pero el servicio podría mejorar.'),
(3, 'Pedro Martinez', '2023-04-10', 5, 'El mejor restaurante italiano que he visitado, todo estuvo perfecto.'),
(3, 'Carla Fernandez', '2023-04-28', 2, 'La comida no cumplió con mis expectativas y el precio es demasiado alto para lo que ofrecen.');


/*  MAS RESTAURANTES */

INSERT INTO `Restaurantes` (`id_rest`, `nombre`, `apertura`, `precio`, `direccion`, `imagen`) VALUES
(4, 'Restaurante Wey', 1980, 10, 'Calle 12, Ciudad de Mexico', 'img/mexicano2.jpg'),
(5, 'Restaurante Lin', 2015, 22, 'Calle 32, Wuhan', 'img/chino2.jpg'),
(6, 'Restaurante Nonna', 1999, 26, 'Calle 93, Milan', 'img/italiano2.jpg'),
(7, 'Restaurante Tako', 2018, 12, 'Calle 139, Monterrey', 'img/mexicano3.jpg'),
(8, 'Restaurante Xu', 2022, 16, 'Calle 79, Pekín', 'img/chino3.jpeg'),
(9, 'Restaurante Crust', 2023, 11, 'Calle 16, Florencia', 'img/italiano3.jpg');

INSERT INTO `Rest_Cat` (`id_rest`, `id_categoria`) VALUES
(4, 1),
(5, 2),
(6, 3),
(7, 1),
(8, 2),
(9, 3);

INSERT INTO `Comentarios` (`id_rest`, `nombre_usuario`, `fecha`, `puntuacion`, `comentario`) VALUES
(4, 'Miguel Hernandez', '2023-05-01', 5, 'La atención del personal es excepcional y la comida es deliciosa.'),
(4, 'Laura Gutierrez', '2023-05-02', 3, 'La comida estaba bien, pero el ruido del local hizo que la experiencia no fuera tan agradable.'),
(6, 'Carlos Vega', '2023-04-27', 4, 'El ambiente es muy acogedor y la comida es muy buena, pero el servicio puede ser un poco lento.'),
(6, 'Julia Torres', '2023-04-29', 2, 'No me gustó la comida, sentí que le faltaba sabor y la presentación no era la mejor.'),
(8, 'Manuel Diaz', '2023-05-01', 5, 'La comida es exquisita y el servicio es impecable, definitivamente volveré.');


/*  NUEVA CATEGORIA */


INSERT INTO `Categorias` (`id_categoria`, `nombre`, `clave`) VALUES
(4, 'Español', '4');

INSERT INTO `Restaurantes` (`id_rest`, `nombre`, `apertura`, `precio`, `direccion`, `imagen`) VALUES
(10, 'Restaurante Español', 2014, 14, 'Calle 10, Salamanca', 'img/español.jpg'),
(11, 'Restaurante VIP', 2020, 28, 'Calle 3, Madrid', 'img/español2.jpg'),
(12, 'Restaurante Noche', 2016, 13, 'Calle 45, Barcelona', 'img/español3.jpg');

INSERT INTO `Rest_Cat` (`id_rest`, `id_categoria`) VALUES
(10, 4),
(11, 4),
(12, 4);

INSERT INTO `Comentarios` (`id_rest`, `nombre_usuario`, `fecha`, `puntuacion`, `comentario`) VALUES
(11, 'Miguel Hernandez', '2023-05-01', 5, 'La atención del personal es excepcional y la comida es deliciosa.'),
(12, 'Laura Gutierrez', '2023-05-02', 4, 'La comida estaba bien, pero el ruido del local hizo que la experiencia no fuera tan agradable.'),
(10, 'Carlos Vega', '2023-04-27', 4, 'El ambiente es muy acogedor y la comida es muy buena, pero el servicio puede ser un poco lento.');
