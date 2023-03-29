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
    agentId INTEGER PRIMARY KEY,
    FOREIGN KEY (agentID) REFERENCES Agent(agentID) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Ticket (
    ticketId INTEGER PRIMARY KEY,
    hashtags TEXT NOT NULL, /* Aqui vamos guardar um JSON com uma lista */
    priority INTEGER NOT NULL,
    status NVARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    clientId INTEGER NOT NULL,
    agentId INTEGER,

    FOREIGN KEY (clientId) REFERENCES Client(clientId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (agentId) REFERENCES Agent(clientId) ON DELETE NO ACTION ON UPDATE NO ACTION
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


INSERT INTO Client (clientId, name, username, email, password) VALUES (1, 'Pedro Madureira', 'RAM', 'pedro@gmail.com', 'passwordsecreta');
INSERT INTO Client (clientId, name, username, email, password) VALUES (2, 'Tomas Gaspar', 'Gaspar', 'tomasgaspar@gmail.com', '1234567');
INSERT INTO Client (clientId, name, username, email, password) VALUES (3, 'Daniel Gago', 'Gago', 'danielgago@gmail.com', 'daniel_faro123');


INSERT INTO Agent (isAgent, clientId, departmentId) VALUES (true, 1, 1);
INSERT INTO Agent (isAgent, clientId, departmentId) VALUES (true, 2, 1);
INSERT INTO Agent (isAgent, clientId, departmentId) VALUES (true, 3, 1);


INSERT INTO Admin (isAdmin, agentId) VALUES (true, 1);
INSERT INTO Admin (isAdmin, agentId) VALUES (true, 2);
INSERT INTO Admin (isAdmin, agentId) VALUES (true, 3);


INSERT INTO Department (departmentId, name) VALUES (1, 'Accounting');
