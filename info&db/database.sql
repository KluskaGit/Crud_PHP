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
    phone_number int(9),
    email_address varchar(255),
    city varchar(255),
    date_of_employment DATE NOT NULL
    
);

DROP TABLE IF EXISTS positions;
CREATE TABLE positions
(
    pos_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    position_name varchar(255) NOT NULL
);

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
    user_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    email varchar(255) NOT NULL,
    login varchar(255),
    password varchar(255) NOT NULL
);

ALTER TABLE employees
ADD CONSTRAINT FOREIGN KEY (position) REFERENCES positions (pos_id);

INSERT INTO positions(position_name) VALUES ('Intern'),('Boss');

INSERT INTO employees(name, surname, position, phone_number, email_address, city, date_of_employment)
values ('Kamil', 'Kluska', 1, 222444333, '123email@gmail.com', 'Siedlce', '2023-05-25'),
('Mateusz', 'Kowal', 2, 121341445, '512email@gmail.com', 'Warszawa', '2023-05-25');