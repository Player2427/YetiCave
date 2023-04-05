-- Получить все категории
SELECT * FROM Category;
-- Получить самые новые, открытые лоты
SELECT Lot.LotID, LotName, LotPrice, LotPath, CategoryName, 
IF (LotBet IS NULL , 0 , LotBet) AS LotBet,
IF (BetPrice IS NULL , LotPrice , BetPrice) AS BetPrice
FROM (SELECT COUNT(BetID) AS LotBet, MAX(BetID) AS BetID, MAX(BetPrice) AS BetPrice, LotID FROM Bet GROUP by LotID) AS Lastbet
right JOIN Lot ON Lot.LotID=Lastbet.LotID
JOIN Category ON Lot.CategoryID=Category.CategoryID
WHERE Lot.LotOpen=1
ORDER BY Lot.LotTime DESC;
-- Показать лот по его id  и категорию к лоту
SELECT LotID, LotName, LotPath, LotPrice, LotStep, LotDate, LotTime, LotMessage, LotOpen, CategoryName FROM lot, category
WHERE LotID = 1 AND Lot.CategoryID=Category.CategoryID
-- обновить название лота по его идентифекатору
UPDATE Lot
SET LotName='new_name'
WHERE LotID=1;
-- получить список самых свежих  ставок для лота
SELECT * FROM Bet
WHERE LotID=1
ORDER BY BetID DESC;