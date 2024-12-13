--
-- Base de datos BOOK HEAVEN proyecto php
-- 

-- --------------------------------------

-- 
-- Estructura de la tabla 'GenerosLiterarios'
--

CREATE TABLE GenerosLiterarios ( 
    IDGenero INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
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
    IDLibro INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
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

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El Hobbit', 3, 'J.R.R. Tolkien', 10, 'La historia de Bilbo Bolsón y su inesperada aventura con enanos para recuperar un tesoro custodiado por un dragón.', 'https://ejemplo.com/el_hobbit.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Drácula', 12, 'Bram Stoker', 9, 'La clásica historia de horror gótico que sigue a Jonathan Harker en su encuentro con el Conde Drácula.', 'https://ejemplo.com/dracula.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('La casa de los espíritus', 1, 'Isabel Allende', 8, 'Una saga familiar cargada de realismo mágico y eventos históricos en América Latina.', 'https://ejemplo.com/casa_espiritus.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Fundación', 11, 'Isaac Asimov', 10, 'Una serie de novelas de ciencia ficción que exploran la caída y resurgimiento de un imperio galáctico.', 'https://ejemplo.com/fundacion.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El nombre del viento', 3, 'Patrick Rothfuss', 9, 'La primera parte de las aventuras de Kvothe, un joven con un talento extraordinario.', 'https://ejemplo.com/nombre_viento.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('It (Eso)', 12, 'Stephen King', 9, 'Un grupo de amigos enfrenta a una entidad maligna que adopta la forma de un payaso aterrador.', 'https://ejemplo.com/it.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('La metamorfosis', 10, 'Franz Kafka', 8, 'Un relato inquietante sobre un hombre que se despierta transformado en un insecto gigante.', 'https://ejemplo.com/metamorfosis.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El guardián entre el centeno', 10, 'J.D. Salinger', 8, 'La vida de un adolescente rebelde que busca sentido en un mundo que le parece falso.', 'https://ejemplo.com/guardian_centeno.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Coraline', 5, 'Neil Gaiman', 9, 'Una niña descubre un mundo paralelo que parece perfecto, pero esconde oscuros secretos.', 'https://ejemplo.com/coraline.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Dune', 11, 'Frank Herbert', 10, 'Una épica saga de ciencia ficción sobre política, religión y poder en un desierto intergaláctico.', 'https://ejemplo.com/dune.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Frankenstein', 12, 'Mary Shelley', 9, 'La historia de un científico que crea un ser vivo y enfrenta las consecuencias de su experimento.', 'https://ejemplo.com/frankenstein.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Bajo la misma estrella', 7, 'John Green', 8, 'Un romance entre dos adolescentes con cáncer que reflexionan sobre la vida y la muerte.', 'https://ejemplo.com/bajo_estrella.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('El perfume', 9, 'Patrick Süskind', 9, 'Un hombre obsesionado con crear el perfume perfecto mediante métodos oscuros.', 'https://ejemplo.com/el_perfume.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('Anna Karenina', 10, 'León Tolstói', 10, 'Una obra maestra de la literatura que explora el amor, la familia y las tensiones sociales en la Rusia imperial.', 'https://ejemplo.com/anna_karenina.jpg');

INSERT INTO Libros (Titulo, IDGenero, Autor, Nota, Sinopsis, URLPortada) 
VALUES 
('La divina comedia', 9, 'Dante Alighieri', 10, 'Un poema épico que describe un viaje a través del infierno, el purgatorio y el paraíso.', 'https://ejemplo.com/divina_comedia.jpg');


-- 
-- Estructura de la tabla 'Usuarios'
--

CREATE TABLE Usuarios ( 
    IDUsuario INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
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
    IDComentario INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    IDUsuario INT, 
    IDLibro INT, 
    TextoComentario TEXT, 
    FechaComentario TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (IDUsuario) REFERENCES Usuarios(ID), 
    FOREIGN KEY (IDLibro) REFERENCES Libros(ID) 
);

-- Insertar comentarios en la tabla 'Comentarios'

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 1, 'Un libro que no puedes dejar de leer. La narrativa es espectacular y el realismo mágico es simplemente fascinante.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 2, 'La historia es inquietante y te hace reflexionar mucho sobre la libertad y el control. Un clásico de la ciencia ficción distópica.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 3, 'La riqueza del mundo creado por Tolkien es impresionante. Una obra maestra que siempre recomiendo.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 4, 'Un relato muy interesante con una estructura narrativa única. Muy recomendable.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 5, 'Perfecto para todas las edades. Un libro que despierta la imaginación y te transporta a un mundo mágico.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 6, 'Un libro que invita a reflexionar profundamente sobre la vida y las relaciones. Me encantó.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 7, 'Una joya de la literatura. La profundidad de los personajes es increíble.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 8, 'Una historia de amor llena de crítica social. Muy disfrutable y entretenida.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 9, 'Intrigante de principio a fin. Los giros de la trama son geniales.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 10, 'Un libro que inspira y te deja con muchas enseñanzas. Muy recomendable.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 11, 'Una historia que te atrapa por completo y te hace reflexionar sobre la justicia y la humanidad.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 12, 'Llena de acción y drama, es una lectura muy emocionante.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 13, 'Una obra gótica que me encantó. El personaje principal es inolvidable.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 14, 'Una historia apasionante y llena de misterio. La recomiendo mucho.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 15, 'Un libro mágico lleno de aventuras y moralejas. Ideal para todas las edades.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 16, 'Una obra inolvidable que sentó las bases de la fantasía moderna. Me encantó.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 17, 'Un clásico del horror que no pasa de moda. Me mantuvo intrigado todo el tiempo.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 18, 'Una historia que combina magia y realidad con maestría. Altamente recomendable.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 19, 'Una de las mejores sagas de ciencia ficción que he leído. Impresionante.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 20, 'Una obra muy bien escrita con un personaje principal lleno de carisma.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 21, 'Una lectura intensa y emocionante que te mantiene enganchado hasta el final.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 22, 'Un libro inquietante y profundo. No lo podía dejar de leer.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 23, 'Un relato cargado de simbolismo y con una narrativa única. Fascinante.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 24, 'Un libro con una historia atrapante y un mensaje muy poderoso.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 25, 'Una historia mágica y oscura que me encantó de principio a fin.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 26, 'Un mundo fascinante lleno de detalles y personajes inolvidables.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 27, 'Un relato gótico inolvidable. Muy recomendable.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(1, 28, 'Una obra conmovedora y profundamente reflexiva.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(2, 29, 'Una narrativa brillante y con un mensaje impactante. Me encantó.');

INSERT INTO Comentarios (IDUsuario, IDLibro, TextoComentario) 
VALUES 
(3, 30, 'Un poema épico que nunca deja de maravillarme. Una joya literaria.');
