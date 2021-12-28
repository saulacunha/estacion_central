CREATE DATABASE web_estacion_central;

USE web_estacion_central;

CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  user varchar (100),
  password varchar (100),
  PRIMARY KEY (id)
);

INSERT INTO users (user, password) VALUES
('admin', 'admin');

CREATE TABLE node (
    id int(11) NOT NULL AUTO_INCREMENT,
    node_id varchar (100),
    alias varchar (100),
    min_light_needed int,
    water_needed float,
    max_temperature int,
    min_temperature int,
  PRIMARY KEY (id)
);