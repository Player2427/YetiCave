CREATE DATABASE yeticave;
CREATE USER 'yeticave'@'localhost' IDENTIFIED BY 'timitimi';
GRANT ALL PRIVILEGES ON yeticave.* TO 'yeticave'@'localhost';
FLUSH PRIVILEGES;
USE yeticave;
CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY, 
    CategoryName VARCHAR(128),
    CategoryClass VARCHAR(128)
);
CREATE TABLE User (
    UserID INT AUTO_INCREMENT PRIMARY KEY, 
    UserName VARCHAR(128) NOT NULL,
    UserEmail VARCHAR(128) NOT NULL,
    UserPassword VARCHAR(128) NOT NULL,
    UserMessage VARCHAR(1024),
    UserPath VARCHAR(128),
    UserTime DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Lot (
    LotID INT AUTO_INCREMENT PRIMARY KEY, 
    LotName VARCHAR(128) NOT NULL,
    LotPath VARCHAR(128) NOT NULL,
    LotPrice INT NOT NULL,
    LotStep INT DEFAULT 1,
    LotDate VARCHAR(128) NOT NULL,
    LotTime DATETIME DEFAULT CURRENT_TIMESTAMP,
    LotMessage VARCHAR(2048),
    LotOpen BOOLEAN DEFAULT 1,
    CategoryID INT NOT NULL,
    FOREIGN KEY (CategoryID) REFERENCES Category(CategoryID),
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    WinUserID INT,
    FOREIGN KEY (WinUserID) REFERENCES User(UserID)
);
CREATE TABLE Bet (
    BetID INT AUTO_INCREMENT PRIMARY KEY, 
    BetTime DATETIME DEFAULT CURRENT_TIMESTAMP,
    BetPrice INT NOT NULL,
    UserID INT NOT NULL,
    FOREIGN KEY (UserID) REFERENCES User(UserID),
    LotID INT NOT NULL,
    FOREIGN KEY (LotID) REFERENCES Lot(LotID)
);
INSERT INTO Category (CategoryName, CategoryClass)
VALUES 
    ('Доски и лыжи', 'boards'),
    ('Крепления', 'attachment'),
    ('Ботинки', 'boots'),
    ('Одежда', 'clothing'),
    ('Инструменты', 'tools'),
    ('Разное', 'other');