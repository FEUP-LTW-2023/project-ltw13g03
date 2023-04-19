DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Agent;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Modification;

CREATE TABLE Client (
    username NVAR(25) PRIMARY KEY,
    name NVARCHAR(120) NOT NULL,
    email NVARCHAR(60) NOT NULL,
    password NVARCHAR(40) NOT NULL
);

CREATE TABLE Agent (
    isAgent BOOLEAN NOT NULL,
    username NVAR(25) PRIMARY KEY,
    departmentId INTEGER,
    FOREIGN KEY (username) REFERENCES Client(username) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (departmentID) REFERENCES Department(departmentID) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Admin (
    isAdmin BOOLEAN NOT NULL,
    username NVAR(25) PRIMARY KEY,
    FOREIGN KEY (username) REFERENCES Agent(username) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Ticket (
    ticketId INTEGER PRIMARY KEY,
    hashtags TEXT NOT NULL, /* Aqui vamos guardar um JSON com uma lista */
    priority INTEGER NOT NULL,
    status NVARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    clientUsername NVAR(25) NOT NULL,
    agentUsername NVAR(25),

    FOREIGN KEY (clientUsername) REFERENCES Client(username) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (agentUsername) REFERENCES Agent(username) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Department (
    departmentId INTEGER PRIMARY KEY,
    name NVARCHAR(20) NOT NULL
);

CREATE TABLE Modification (
    modificationID INTEGER PRIMARY KEY,
    field NVARCHAR(30) NOT NULL,
    old NVARCHAR(60) NOT NULL,
    new NVARCHAR(60) NOT NULL,
    date DATE NOT NULL,
    ticketID INTEGER NOT NULL,
    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID) ON DELETE NO ACTION ON UPDATE NO ACTION
);



INSERT INTO Client (name, username, email, password) VALUES ('Pedro Madureira', 'RAM', 'pedro@gmail.com', '3678b4619913882f81cb27e5a1a723291fa8da0d'); --passwordsecreta
INSERT INTO Client (name, username, email, password) VALUES ('Tomas Gaspar', 'Gaspar', 'tomasgaspar@gmail.com', '20eabe5d64b0e216796e834f52d61fd0b70332fc'); --1234567
INSERT INTO Client (name, username, email, password) VALUES ('Daniel Gago', 'Gago', 'danielgago@gmail.com', '02aea1da66459976cc45823b47bc219a9799f166'); --daniel_faro123


INSERT INTO Agent (isAgent, username, departmentId) VALUES (true, 'RAM', 1);
INSERT INTO Agent (isAgent, username, departmentId) VALUES (true, 'Gaspar', 1);
INSERT INTO Agent (isAgent, username, departmentId) VALUES (true, 'Gago', 1);


INSERT INTO Admin (isAdmin, username) VALUES (true, 'RAM');
INSERT INTO Admin (isAdmin, username) VALUES (true, 'Gaspar');
INSERT INTO Admin (isAdmin, username) VALUES (true, 'Gago');


INSERT INTO Department (departmentId, name) VALUES (1, 'Accounting');
