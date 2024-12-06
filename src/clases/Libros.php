<?php

    class Libros {
        
        private int $id ;
        private string $titulo ;
        private string $autor ;
        private int $nota ;
        private string $sinopsis ;
        private string $portada ;
        private Genero $genero ;

        public function __construct( string $titulo, Genero $genero, string $autor, int $nota, 
                                    string $sinopsis, string $portada) {
            $this->titulo = $titulo;
            $this->genero = $genero;
            $this->autor = $autor;
            $this->nota = $nota;
            $this->sinopsis = $sinopsis;
            $this->portada = $portada;
        }

    }


?>