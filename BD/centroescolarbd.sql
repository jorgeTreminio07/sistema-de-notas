DROP DATABASE IF EXISTS centroescolarbd;

CREATE DATABASE centroescolarbd;
USE centroescolarbd;

CREATE TABLE secciones (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre char(1) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE grados (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) NOT NULL,
  ciclo varchar(45) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE materias (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(45) NOT NULL,
  num_evaluaciones int(11) NOT NULL,
  id_grado int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_grado) REFERENCES grados (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE alumnos (
  id int(11) NOT NULL AUTO_INCREMENT,
  num_lista int(11) NOT NULL,
  nombres varchar(45) NOT NULL,
  apellidos varchar(45) NOT NULL,
  genero char(1) NOT NULL,
  id_grado int(11) NOT NULL,
  id_seccion int(11) NOT NULL,
  PRIMARY KEY (id),
  password varchar(25) DEFAULT '123',
  rol varchar(25) DEFAULT 'Alumno',
  FOREIGN KEY (id_grado) REFERENCES grados (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (id_seccion) REFERENCES secciones (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(15) NOT NULL,
  password varchar(15) NOT NULL,
  nombre varchar(60) NOT NULL,
  rol varchar(15) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE notas (
  id int(11) NOT NULL AUTO_INCREMENT,
  nota decimal(10,2) DEFAULT NULL,
  observaciones varchar(100) DEFAULT NULL,
  id_alumno int(11) NOT NULL,
  id_materia int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (id_alumno) REFERENCES alumnos (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  FOREIGN KEY (id_materia) REFERENCES materias (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

INSERT INTO users (username, password, nombre, rol) VALUES
	('admin', 'admin123', 'Cristhian', 'Administrador')
;
INSERT INTO grados (nombre, ciclo) VALUES ('Técnico General en Contabilidad', 'I');
INSERT INTO grados (nombre, ciclo) VALUES ('Técnico Especialista en Diseño Gráfico', 'I');
INSERT INTO grados (nombre, ciclo) VALUES ('Técnico General en Cocina y Gastronomía', 'I');

INSERT INTO materias (nombre, num_evaluaciones, id_grado) VALUES ('Adaptación al cambio climático', 4, 1);
INSERT INTO materias (nombre, num_evaluaciones, id_grado) VALUES ('Cultura Emprendedora', 4, 1);
INSERT INTO materias (nombre, num_evaluaciones, id_grado) VALUES ('Gestión de Calidad', 4, 1);
INSERT INTO materias (nombre, num_evaluaciones, id_grado) VALUES ('Higiene y seguridad del trabajo', 4, 1);
INSERT INTO materias (nombre, num_evaluaciones, id_grado) VALUES ('Orientación laboral', 4, 1);


INSERT INTO secciones (nombre) VALUES ('A'), ('B'), ('C');