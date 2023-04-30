DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Agent;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Modification;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS AgentDepartment;

CREATE TABLE Client (
    username NVAR(25) PRIMARY KEY,
    name NVARCHAR(120) NOT NULL,
    email NVARCHAR(60) NOT NULL,
    password NVARCHAR(40) NOT NULL
);

CREATE TABLE Agent (
    isAgent BOOLEAN NOT NULL,
    username NVAR(25) PRIMARY KEY
);

CREATE TABLE AgentDepartment (
    username NVAR(25),
    departmentId INTEGER,
    FOREIGN KEY (username) REFERENCES Agent(username) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (departmentID) REFERENCES Department(departmentID) ON DELETE NO ACTION ON UPDATE NO ACTION,
    UNIQUE (username, departmentId)
);

CREATE TABLE Admin (
    isAdmin BOOLEAN NOT NULL,
    username NVAR(25) PRIMARY KEY,
    FOREIGN KEY (username) REFERENCES Agent(username) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Ticket (
    ticketId INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    body TEXT NOT NULL,
    hashtags TEXT NOT NULL, /* Aqui vamos guardar um JSON com uma lista */
    priority INTEGER NOT NULL,
    status NVARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    client NVAR(25) NOT NULL,
    agent NVAR(25),

    FOREIGN KEY (client) REFERENCES Client(username) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (agent) REFERENCES Agent(username) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Comment (
  id INTEGER PRIMARY KEY,
  ticketId INTEGER,
  username NVAR(25) NOT NULL,
  date DATE NOT NULL,
  text TEXT,

  FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
  FOREIGN KEY (username) REFERENCES Client(username)
);

CREATE TABLE Department (
    departmentId INTEGER PRIMARY KEY,
    name NVARCHAR(20) NOT NULL
);

CREATE TABLE Hashtag (
    name NVARCHAR(20) NOT NULL PRIMARY KEY
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


INSERT INTO Agent (isAgent, username) VALUES (true, 'RAM');
INSERT INTO Agent (isAgent, username) VALUES (true, 'Gaspar');
INSERT INTO Agent (isAgent, username) VALUES (true, 'Gago');


INSERT INTO Admin (isAdmin, username) VALUES (true, 'RAM');
INSERT INTO Admin (isAdmin, username) VALUES (true, 'Gaspar');
INSERT INTO Admin (isAdmin, username) VALUES (true, 'Gago');


INSERT INTO Department (departmentId, name) VALUES (1, 'Human Resources');
INSERT INTO Department (departmentId, name) VALUES (2, 'Information Technology');
INSERT INTO Department (departmentId, name) VALUES (3, 'Sales');
INSERT INTO Department (departmentId, name) VALUES (4, 'Finance');


INSERT INTO AgentDepartment (username, departmentID) VALUES ('RAM', 1);
INSERT INTO AgentDepartment (username, departmentID) VALUES ('RAM', 2);
INSERT INTO AgentDepartment (username, departmentID) VALUES ('Gago', 3);

INSERT INTO Ticket (ticketID, title, body, hashtags, priority, status, date, client, agent) VALUES (1, 'Não sei fazer isto', 'Não sei fazer aquilo. Afinal até sei, só que mais ou menos, na verdade isto é ganda palha, porque estou a testar se o código de php está a funcionar. CAso não esteja ficarei bastante desapontado e obviamente a culpa não será minha, mas sim da linguagem!!!!!!!!!!!!!!!', '{"0":"gandafixe", "1":"bimbas"}', 1, 'Open', '2022-06-28', 'RAM', 'Gaspar');

INSERT INTO Comment (id, ticketID, username, date, text) VALUES (1, 1, 'Gaspar', '2023-01-01', 'Olha é verdade, também me tinha esquecido que coisa e tal');