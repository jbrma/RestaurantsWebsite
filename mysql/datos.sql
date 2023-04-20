/*
  Recuerda que deshabilitar la opción "Enable foreign key checks" para evitar problemas a la hora de importar el script.
*/
TRUNCATE TABLE `Usuarios`;
TRUNCATE TABLE `Editores`;
TRUNCATE TABLE `Categorias`;
TRUNCATE TABLE `Restaurantes`;

/*
  user: userpass
  admin: adminpass
*/
INSERT INTO `Usuarios` (`username`, `password`, `nombre`,`correo`,`rol`) VALUES
('user1', 'user1pass', 'Pedro', 'pedro@gmail.com', 'usuario'),
('user2', 'user2pass', 'Maria', 'maria@gmail.com', 'usuario'),
('admin', 'adminpass', 'Celia', 'admin@gmail.com', 'admin');

INSERT INTO `Editores` (`id_editor`, `username`, `nombre`,`password`) VALUES
(1, 'editor1', 'Editor 1', 'pass1'),
(2, 'editor2', 'Editor 2', 'pass2'),
(3, 'editor3', 'Editor 3', 'pass3');

INSERT INTO `Categorias` (`id_categoria`, `nombre`, `clave`) VALUES
(1, 'Mexicano', '1'),
(2, 'Chino', '2'),
(3, 'Italiano', '3');

INSERT INTO `Restaurantes` (`id_rest`, `nombre`, `apertura`, `direccion`, `imagen`, `id_editor`) VALUES
(1, 'Restaurante Mexicano', 1990, 'Calle 1, Ciudad', 'img/mexicano.jpg', 1),
(2, 'Restaurante Chino', 1985, 'Calle 2, Ciudad', 'img/chino.jpg', 2),
(3, 'Restaurante Italiano', 2000, 'Calle 3, Ciudad', 'img/italiano.jpg', 3);