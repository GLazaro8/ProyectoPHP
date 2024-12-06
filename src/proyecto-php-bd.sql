--
-- Base de datos BOOK HEAVEN proyecto php
-- 

-- --------------------------------------

-- 
-- Estructura de la tabla 'GenerosLiterarios'
--

CREATE TABLE GenerosLiterarios ( 
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    NombreGenero VARCHAR(100) UNIQUE 
);

-- 
-- Insertar datos en la tabla 'GenerosLiterarios'
--

INSERT INTO GenerosLiterarios (NombreGenero) 
VALUES 
('Realismo mágico'), 
('Distopía'), 
('Fantasía épica'), 
('Fantasía juvenil'), 
('Literatura infantil'), 
('Clásico'), 
('Romance'), 
('Thriller'), 
('Filosofía'), 
('Drama'), 
('Ciencia ficción'), 
('Horror gótico');

-- 
-- Estructura de la tabla 'Libros'
--

CREATE TABLE Libros ( 
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    Titulo VARCHAR(255), 
    IDGenero INT, 
    Autor VARCHAR(255), 
    Nota INT CHECK (Nota >= 1 AND Nota <= 10), 
    Sinopsis VARCHAR(750),
    URLPortada VARCHAR(255), 
    FOREIGN KEY (IDGenero) REFERENCES GenerosLiterarios(ID) 
);

-- 
-- Insertar datos en la tabla 'Libros'
--

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Cien años de soledad', 1, 'Gabriel García Márquez', 10, 'La historia de la familia Buendía a lo largo de siete generaciones en el pueblo ficticio de Macondo.', 'https://ejemplo.com/cien_anos.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('1984', 2, 'George Orwell', 9, 'Una distopía que explora el totalitarismo y la vigilancia extrema bajo un régimen opresivo.', 'https://ejemplo.com/1984.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El Señor de los Anillos: La Comunidad del Anillo', 3, 'J.R.R. Tolkien', 10, 'La primera parte de la épica travesía de Frodo Bolsón para destruir el Anillo Único.', 'https://ejemplo.com/lotr1.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Crónica de una muerte anunciada', 1, 'Gabriel García Márquez', 8, 'Un asesinato anunciado en un pequeño pueblo contado desde múltiples perspectivas.', 'https://ejemplo.com/cronica.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Harry Potter y la piedra filosofal', 4, 'J.K. Rowling', 9, 'La historia del joven mago Harry Potter y su primer año en el Colegio Hogwarts de Magia y Hechicería.', 'https://ejemplo.com/harry_potter1.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El principito', 5, 'Antoine de Saint-Exupéry', 9, 'Un relato poético y filosófico sobre la importancia de las relaciones humanas y la imaginación.', 'https://ejemplo.com/el_principito.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Don Quijote de la Mancha', 6, 'Miguel de Cervantes', 10, 'La historia del ingenioso hidalgo que decide convertirse en caballero andante y sus aventuras con Sancho Panza.', 'https://ejemplo.com/don_quijote.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Orgullo y prejuicio', 7, 'Jane Austen', 9, 'Una crítica social y una historia de amor ambientada en la Inglaterra del siglo XIX.', 'https://ejemplo.com/orgullo_prejuicio.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El código Da Vinci', 8, 'Dan Brown', 8, 'Un thriller que combina arte, religión y ciencia en una trama llena de misterio.', 'https://ejemplo.com/codigo_da_vinci.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El alquimista', 9, 'Paulo Coelho', 7, 'Un joven pastor busca cumplir su leyenda personal en un viaje espiritual por el desierto.', 'https://ejemplo.com/el_alquimista.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Matar a un ruiseñor', 10, 'Harper Lee', 10, 'Una historia sobre la injusticia racial y la pérdida de la inocencia en el sur de los Estados Unidos.', 'https://ejemplo.com/matar_ruisenor.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Los juegos del hambre', 11, 'Suzanne Collins', 9, 'Un mundo distópico donde jóvenes deben luchar a muerte en un espectáculo televisado.', 'https://ejemplo.com/juegos_hambre.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El retrato de Dorian Gray', 12, 'Oscar Wilde', 8, 'La vida de un joven que conserva su juventud mientras un retrato envejece y refleja su alma corrompida.', 'https://ejemplo.com/dorian_gray.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('La sombra del viento', 1, 'Carlos Ruiz Zafón', 9, 'Un joven descubre un libro maldito que cambia su vida mientras desentraña un misterio en la Barcelona de posguerra.', 'https://ejemplo.com/sombra_viento.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Las crónicas de Narnia: El león, la bruja y el armario', 4, 'C.S. Lewis', 8, 'Cuatro hermanos descubren un mundo mágico lleno de aventuras y criaturas fantásticas.', 'https://ejemplo.com/narnia.jpg');


-- 
-- Estructura de la tabla 'Usuarios'
--

CREATE TABLE Usuarios ( 
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    Nombre VARCHAR(100),
    Apellidos VARCHAR(100),
    NombreUsuario VARCHAR(50),
    Imagen VARCHAR(250),
    Email VARCHAR(100) UNIQUE, 
    Contrasena VARCHAR(100), 
    Rol ENUM('Usuario', 'Administrador') 
); 

-- 
-- Insertar datos en la tabla 'Usuarios'
--

INSERT INTO Usuarios (Nombre, Apellidos, NombreUsuario, Imagen, Email, Contrasena, Rol) VALUES 
('Laly', 'Zambrano', 'Laly', 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg', 'laly.zambrano@example.com', '123456', 'Usuario'), 
('Gonzalo', 'Lázaro', 'Gonzalo', 'https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg', 'gonzalo.lazaro@example.com', '123456', 'Administrador');

-- 
-- Estructura de la tabla 'Comentarios'
--

CREATE TABLE Comentarios ( 
    ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    IDUsuario INT, 
    IDLibro INT, 
    TextoComentario TEXT, 
    FechaComentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(ID), 
    FOREIGN KEY (IDLibro) REFERENCES Libros(ID) 
);

-- 
-- Insertar datos en la tabla 'Comentarios'
--