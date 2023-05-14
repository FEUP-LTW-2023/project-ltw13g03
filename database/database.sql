DROP TABLE IF EXISTS Client;
DROP TABLE IF EXISTS Agent;
DROP TABLE IF EXISTS Admin;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS Modification;
DROP TABLE IF EXISTS Status;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS FAQ;
DROP TABLE IF EXISTS AgentDepartment;

CREATE TABLE Client (
    userId INTEGER PRIMARY KEY AUTOINCREMENT,
    username NVAR(25) UNIQUE,
    name NVARCHAR(120) NOT NULL,
    email NVARCHAR(60) NOT NULL,
    password NVARCHAR(40) NOT NULL
);

CREATE TABLE Agent (
    isAgent BOOLEAN NOT NULL,
    userId INTEGER PRIMARY KEY,
    FOREIGN KEY (userId) REFERENCES Client(userId) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE AgentDepartment (
    userId INTEGER,
    departmentId INTEGER,
    FOREIGN KEY (userId) REFERENCES Agent(userId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (departmentID) REFERENCES Department(departmentID) ON DELETE NO ACTION ON UPDATE NO ACTION,
    UNIQUE (userId, departmentId)
);

CREATE TABLE Admin (
    isAdmin BOOLEAN NOT NULL,
    userId INTEGER PRIMARY KEY,
    FOREIGN KEY (userId) REFERENCES Agent(userId) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE Ticket (
    ticketId INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    body TEXT NOT NULL,
    department INTEGER,
    hashtags TEXT NOT NULL, /* Aqui vamos guardar um JSON com uma lista */
    priority INTEGER NOT NULL,
    status NVARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    client INTEGER NOT NULL,
    agent INTEGER,

    FOREIGN KEY (status) REFERENCES Status(name) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (department) REFERENCES Department(departmentID) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (client) REFERENCES Client(userId) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (agent) REFERENCES Agent(userId) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE FAQ (
    faqId INTEGER PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

CREATE TABLE Comment (
  id INTEGER PRIMARY KEY,
  ticketId INTEGER,
  userId INTEGER NOT NULL,
  date DATE NOT NULL,
  text TEXT,
  faqId INTEGER,

  FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID),
  FOREIGN KEY (userId) REFERENCES Client(userId),
  FOREIGN KEY (faqId) REFERENCES FAQ(faqId)
);

CREATE TABLE Department (
    departmentId INTEGER PRIMARY KEY,
    name NVARCHAR(20) NOT NULL
);

CREATE TABLE Hashtag (
    name NVARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE Status (
    name NVARCHAR(20) NOT NULL PRIMARY KEY
);

CREATE TABLE Modification (
    modificationID INTEGER PRIMARY KEY,
    field NVARCHAR(30) NOT NULL,
    old NVARCHAR(60) NOT NULL,
    new NVARCHAR(60) NOT NULL,
    date DATE NOT NULL,
    ticketID INTEGER NOT NULL,
    userId INTEGER NOT NULL,
    FOREIGN KEY (ticketID) REFERENCES Ticket(ticketID) ON DELETE NO ACTION ON UPDATE NO ACTION,
    FOREIGN KEY (userId) REFERENCES Client(userId) ON DELETE NO ACTION ON UPDATE NO ACTION
);

INSERT INTO Client (name, username, email, password) VALUES ('Pedro Madureira', 'RAM', 'pedro@gmail.com', '$2y$10$s.G6lPMGoZcvm3G7LApaf.9LORZhyIXc0dZWPjj4kS9dEkRQRwcGW'); --passwordsecreta
INSERT INTO Client (name, username, email, password) VALUES ('Tomas Gaspar', 'Gaspar', 'tomasgaspar@gmail.com', '$2y$10$Uv/ibRHkpx1s4oo1Z3266O092xnAtGclVXFnNghcqo7J2COHUOfm2'); --1234567
INSERT INTO Client (name, username, email, password) VALUES ('Daniel Gago', 'Gago', 'danielgago@gmail.com', '$2y$10$gH3zCEroF5d9xvxI3CBLjOATRvGOHr16gyPVz8t0x8FJgo/UZjMgC '); --daniel_faro123


INSERT INTO Agent (isAgent, userId) VALUES (true, 1);
INSERT INTO Agent (isAgent, userId) VALUES (true, 2);
INSERT INTO Agent (isAgent, userId) VALUES (true, 3);


INSERT INTO Admin (isAdmin, userId) VALUES (true, 1);
INSERT INTO Admin (isAdmin, userId) VALUES (true, 2);
INSERT INTO Admin (isAdmin, userId) VALUES (true, 3);


INSERT INTO Department (departmentId, name) VALUES (1, 'Human Resources');
INSERT INTO Department (departmentId, name) VALUES (2, 'Information Technology');
INSERT INTO Department (departmentId, name) VALUES (3, 'Sales');
INSERT INTO Department (departmentId, name) VALUES (4, 'Finance');

INSERT INTO Status (name) VALUES ('Open');
INSERT INTO Status (name) VALUES ('Assigned');
INSERT INTO Status (name) VALUES ('Closed');

INSERT INTO Hashtag (name) VALUES ('login issues');
INSERT INTO Hashtag (name) VALUES('payment problems');
INSERT INTO Hashtag (name) VALUES('bug report');
INSERT INTO Hashtag (name) VALUES('feature request');
INSERT INTO Hashtag (name) VALUES('account help');
INSERT INTO Hashtag (name) VALUES('billing inquiry');
INSERT INTO Hashtag (name) VALUES('technical support');
INSERT INTO Hashtag (name) VALUES('installation issues');
INSERT INTO Hashtag (name) VALUES('performance problems');
INSERT INTO Hashtag (name) VALUES('product feedback');
INSERT INTO Hashtag (name) VALUES('general inquiry');
INSERT INTO Hashtag (name) VALUES('cancellation request');
INSERT INTO Hashtag (name) VALUES('upgrades and downgrades');
INSERT INTO Hashtag (name) VALUES('website navigation issues');
INSERT INTO Hashtag (name) VALUES('mobile app issues');
INSERT INTO Hashtag (name) VALUES('product usage questions');
INSERT INTO Hashtag (name) VALUES('account security');
INSERT INTO Hashtag (name) VALUES('data privacy concerns');
INSERT INTO Hashtag (name) VALUES('server downtime');
INSERT INTO Hashtag (name) VALUES('product integration issues');
INSERT INTO Hashtag (name) VALUES('user interface feedback');

INSERT INTO AgentDepartment (userId, departmentID) VALUES (1, 1);
INSERT INTO AgentDepartment (userId, departmentID) VALUES (1, 2);
INSERT INTO AgentDepartment (userId, departmentID) VALUES (3, 3);

INSERT INTO Ticket (ticketID, title, body, department, hashtags, priority, status, date, client) VALUES (1, 'Não sei fazer isto', 'Não sei fazer aquilo. Afinal até sei, só que mais ou menos, na verdade isto é ganda palha, porque estou a testar se o código de php está a funcionar. CAso não esteja ficarei bastante desapontado e obviamente a culpa não será minha, mas sim da linguagem!!!!!!!!!!!!!!!', 1, '["login issues","bug report"]', 1, 'Open', '2022-06-28', 1);

INSERT INTO Comment (id, ticketID, userId, date, text) VALUES (1, 1, 3, '2023-01-01', 'Olha é verdade, também me tinha esquecido que coisa e tal');

INSERT INTO Modification (modificationID, field, old, new, date, ticketID, userId) VALUES (1, 'Hashtag', '', 'bug report', '2023-01-01', 1, 3);

INSERT INTO FAQ (faqId, question, answer) VALUES (1, 'Como posso criar um ticket?', 'Criar um ticket é mesmo fácil, é só fazer isto e pronto lol');
INSERT INTO FAQ (faqId, question, answer) VALUES (2, 'O que é que esta empresa vende?', 'Estás no site e não sabes? xd');
INSERT INTO FAQ (faqId, question, answer) VALUES (3, 'Estou com problemas no login.', 'Como é que estás a ver isto então?');