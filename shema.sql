CREATE DATABASE yeticave;
USE yeticave;
CREATE TABLE User (
    UserID INT AUTO_INCREMENT PRIMARY KEY, 
    UserName CHAR(128),
    UserEmail CHAR(128),
    UserPassword CHAR(128),
    UserMessage CHAR(255),
    UserPath CHAR(128),
    UserTime TIMESTAMP
);
CREATE TABLE Lot (
    LotID INT AUTO_INCREMENT PRIMARY KEY, 
    LotName CHAR(128),
    LotPath CHAR(128),
    LotBets INT,
    LotRate INT,
    LotStep INT,
    LotDate CHAR(128),
    LotTime TIMESTAMP,
    LotMessage CHAR(255),
    LotFavorites CHAR(128),
    CategoryID INT,
    UserID INT,
    WinUserID int
);
CREATE TABLE Bet (
    BetID INT AUTO_INCREMENT PRIMARY KEY, 
    BetTime TIMESTAMP,
    UserID INT,
    LotID INT,
    LotRate INT
);
CREATE TABLE Category (
    CategoryID INT AUTO_INCREMENT PRIMARY KEY, 
    CategoryName CHAR(128),
    CategoryClass CHAR(128)
);

