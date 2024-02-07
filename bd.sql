CREATE DATABASE corretores_imoveis CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE corretores_imoveis;

CREATE TABLE users (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       nome VARCHAR(255) NOT NULL,
                       creci VARCHAR(255) NOT NULL,
                       cpf CHAR(11) UNIQUE NOT NULL,

                       createdAt DATETIME DEFAULT CURRENT_TIMESTAMP,
                       updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE blacklist (
                       id INT PRIMARY KEY AUTO_INCREMENT,
                       nome VARCHAR(255) NOT NULL,
);

insert into blacklist(id, nome) VALUE (1, 'André Nunes');