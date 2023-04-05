USE yeticave;
INSERT INTO User (UserName, UserEmail, UserPassword)
VALUES 
    ('Игнат', 'ignat.v@gmail.com', '$2y$10$Tt9P1p4/m3AB4X3v9AkhIeIhzaly3aSsFhE8y46sqROHgqcimYvvq'),
    ('Константин', 'kitty_93@li.ru', '$2y$10$6Uq/HOlhzhLzZjTgSOn17ukNWYnls.4pWyOrd550pfU6.cszwTzdi'),
    ('Даниил', 'warrior07@mail.ru', '$2y$10$jax.lrjrM1NOJHItWwaxVuPlJXvGUa/B7Z6sqqaVzqPAVgpGYIFjK');
INSERT INTO Category (CategoryName, CategoryClass)
VALUES 
    ('Доски и лыжи', 'boards'),
    ('Крепления', 'attachment'),
    ('Ботинки', 'boots'),
    ('Одежда', 'clothing'),
    ('Инструменты', 'tools'),
    ('Разное', 'other');
INSERT INTO Lot (LotName, LotPath, LotPrice, LotStep, LotDate, LotMessage, CategoryID, UserID)
VALUES 
    ('2014 Rossignol District Snowboard', 'img/lot-1.jpg', '10999', '1', '2023-03-26', 'Легкий маневренный сноуборд, готовый дать жару в&nbsp;любом парке, растопив снег мощным щелчком и&nbsp;четкими дугами. Стекловолокно Bi-Ax, уложенное в&nbsp;двух направлениях, наделяет этот снаряд отличной гибкостью и&nbsp;отзывчивостью, а&nbsp;симметричная геометрия в&nbsp;сочетании с&nbsp;классическим прогибом кэмбер позволит уверенно держать высокие скорости. А&nbsp;если к&nbsp;концу катального дня сил совсем не&nbsp;останется, просто посмотрите на&nbsp;Вашу доску и&nbsp;улыбнитесь, крутая графика от&nbsp;Шона Кливера еще никого не&nbsp;оставляла равнодушным.', '1', '1'),
    ('DC Ply Mens 2016/2017 Snowboard', 'img/lot-2.jpg', '15999', '1', '2023-03-24', 'Легкий маневренный сноуборд, готовый дать жару в&nbsp;любом парке, растопив снег мощным щелчком и&nbsp;четкими дугами. Стекловолокно Bi-Ax, уложенное в&nbsp;двух направлениях, наделяет этот снаряд отличной гибкостью и&nbsp;отзывчивостью, а&nbsp;симметричная геометрия в&nbsp;сочетании с&nbsp;классическим прогибом кэмбер позволит уверенно держать высокие скорости. А&nbsp;если к&nbsp;концу катального дня сил совсем не&nbsp;останется, просто посмотрите на&nbsp;Вашу доску и&nbsp;улыбнитесь, крутая графика от&nbsp;Шона Кливера еще никого не&nbsp;оставляла равнодушным.', '1', '1'),
    ('Крепления Union Contact Pro 2015 года размер L/XL', 'img/lot-3.jpg', '8000', '1', '2023-03-25', 'Описание товара', '2', '1'),
    ('Ботинки для сноуборда DC Mutiny Charocal', 'img/lot-4.jpg', '10999', '1', '2023-03-25', 'Описание товара', '3', '1'),
    ('Куртка для сноуборда DC Mutiny Charocal', 'img/lot-5.jpg', '10999', '1', '2023-03-25', 'Описание товара', '4', '1'),
    ('Маска Oakley Canopy', 'img/lot-6.jpg', '5500', '1', '2023-03-25', 'Описание товара', '6', '1');
INSERT INTO Bet (BetPrice, LotID, UserID)
VALUES 
    ('11000', '1', '2'),
    ('11200', '1', '3'),
    ('11500', '1', '2');