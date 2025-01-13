DROP DATABASE IF EXISTS paellavpn;

CREATE DATABASE paellavpn;

USE paellavpn;

CREATE TABLE Usuaris (
    ID_Usuari INT AUTO_INCREMENT,
    Nom VARCHAR(50) NOT NULL,
    Apellidos VARCHAR(100) NOT NULL,
    Correu_Electronic VARCHAR(100) UNIQUE NOT NULL,
    Contrasenya VARCHAR(255) NOT NULL,
    Data_Registre DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_Usuari)
) ENGINE=INNODB;

CREATE TABLE Plans_Disponibles (
    ID_Plan INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Duracion INT NOT NULL COMMENT 'Duracion en dias',
    Precio DECIMAL(10,2) NOT NULL COMMENT 'Precio del plan',
    Descripcion TEXT,
    PRIMARY KEY (ID_Plan)
);

CREATE TABLE Pla_Actiu (
    ID_Usuari INT NOT NULL,
    ID_Plan INT NOT NULL,
    Fecha_Inicio DATE NOT NULL,
    Fecha_Fin DATE,
    PRIMARY KEY (ID_Usuari, ID_Plan),
    FOREIGN KEY (ID_Usuari) REFERENCES Usuaris(ID_Usuari),
    FOREIGN KEY (ID_Plan) REFERENCES Plans_Disponibles(ID_Plan)
);

CREATE TABLE Tipo_Ticket (
    ID INT AUTO_INCREMENT,
    Nombre VARCHAR(50) NOT NULL,
    Descripcion TEXT,
    PRIMARY KEY (ID)
);

/*Aqui debajo creare una tabla para el apartado de Estado de Ticket*/

CREATE TABLE Estados (
    ID_Estado INT AUTO_INCREMENT,
    Nombre_Estado VARCHAR(30),
    PRIMARY KEY (ID_Estado)
);


CREATE TABLE Ticket (
    ID_Ticket INT AUTO_INCREMENT,
    ID_Usuari INT NOT NULL,
    Tipo_Ticket INT NOT NULL COMMENT 'Referencia a la tabla Tipo_Ticket',
    Descripcion TEXT NOT NULL,
    Estado ENUM('Abierto', 'En Proceso', 'Cerrado') DEFAULT 'Abierto',
    Fecha_Creacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (ID_Ticket),
    FOREIGN KEY (ID_Usuari) REFERENCES Usuaris(ID_Usuari),
    FOREIGN KEY (Tipo_Ticket) REFERENCES Tipo_Ticket(ID)
);
