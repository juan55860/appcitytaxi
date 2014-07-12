CREATE DATABASE dbcitytaxi;

CREATE TABLE person (
  id INT NOT NULL,
  name VARCHAR(45) NOT NULL,
  lastname VARCHAR(45) NOT NULL,
  rh VARCHAR(45) NOT NULL,
  active BOOLEAN NOT NULL,
  password INT NOT NULL,
  phone INT NOT NULL,
  PRIMARY KEY (id)
);