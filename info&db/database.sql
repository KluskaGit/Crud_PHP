DROP DATABASE IF EXISTS crud_db;
CREATE DATABASE crud_db;
use crud_db;

DROP TABLE IF EXISTS employees;
CREATE TABLE employees
(
    em_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name varchar(255),
    surname varchar(255),
    position int NOT NULL DEFAULT 1,
    email varchar(255) NOT NULL,
    login varchar(255),
    password varchar(255) NOT NULL
)

DROP TABLE IF EXISTS positions
CREATE TABLE positions
(
    pos_id int(11) NOT NULL AUTO_INCREMENT,
    position_name varchar(255) NOT NULL
)