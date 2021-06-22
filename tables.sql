CREATE DATABASE Westrom;

CREATE TABLE Projects {
    ProjectID INT NOT NULL AUTO_INCREMENT,
    ProjectName VARCHAR(50) NOT NULL,
    CONSTRAINT PK_Projects PRIMARY KEY(ProjectID)
} Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;

CREATE TABLE Contributors {
    ContributorID INT NOT NULL AUTO_INCREMENT,
    ContributorName VARCHAR(50) NOT NULL,
    CONSTRAINT PK_Contributors PRIMARY KEY(ContributorID)
} Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;

CREATE TABLE Tasks {
    TaskID INT NOT NULL AUTO_INCREMENT,
    ProjectID INT NOT NULL,
    ContributorID INT,
    TaskName VARCHAR(50) NOT NULL,
    TaskDescription VARCHAR(1024) NOT NULL,
    TaskStatus CHAR(3) NOT NULL,
    DateAdded DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT PK_Tasks PRIMARY KEY(TaskID),
    CONSTRAINT FK_Tasks_ProjectID FOREIGN KEY(ProjectID) REFERENCES Projects(ProjectID),
    CONSTRAINT FK_Tasks_ContributorID FOREIGN KEY(ContributorID) REFERENCES Contributors(ContributorID)
} Engine = InnoDB CHARACTER SET = utf8 COLLATE = utf8_bin;