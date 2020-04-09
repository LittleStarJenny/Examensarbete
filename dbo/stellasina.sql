CREATE DATABASE stellasina
DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

CREATE TABLE categorys
(   CategoryId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    CategoryName VARCHAR(550) NOT NULL
);

INSERT INTO categorys
(
    CategoryId, CategoryName
)

VALUES
(1, 'BH'),
(2, 'Trosor');


CREATE TABLE sizechart 
(
    SizeId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Size VARCHAR(50) NOT NULL
);

INSERT INTO sizechart
( 
    SizeId, Size
)
VALUES
(1, '60A'),
(2, '65A'),
(3, '70A'),
(4, '75A'),
(5, '80A'),
(6, '85A'),
(7, '60B'),
(8, '65B'),
(9, '70B'),
(10, '75B'),
(11, '80B'),
(12, '85B'),
(13, '60C'),
(14, '65C'),
(15, '70C'),
(16, '75C'),
(17, '80C'),
(18, '85C'),
(19, '60D'),
(20, '65D'),
(21, '70D'),
(22, '75D'),
(23, '80D'),
(24, '85D'),
(25, '60E'),
(26, '65E'),
(27, '70E'),
(28, '75E'),
(29, '80E'),
(30, '85E'),
(31, '60F'),
(32, '65F'),
(33, '70F'),
(34, '75F'),
(35, '80F'),
(36, '85F'),
(37, '60G'),
(38, '65G'),
(39, '70G'),
(40, '75G'),
(41, '80G'),
(42, '85G'),
(43, '60H'),
(44, '65H'),
(45, '70H'),
(46, '75H'),
(47, '80H'),
(48, '85H'),
(49, '60I'),
(50, '65I'),
(51, '70I'),
(52, '75I'),
(53, '80I'),
(54, '85I'),
(55, '60J'),
(56, '65J'),
(57, '70J'),
(58, '75J'),
(59, '80J'),
(60, '85J'),
(61, 'S'),
(62, 'M'),
(63, 'L');


-- Create the table in the specified schema
CREATE TABLE Products
(
    ProductsId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    ProductName VARCHAR(50) NOT NULL,
    Description VARCHAR(500) NOT NULL,
    Price  INT NOT NULL,
    Color VARCHAR(50) NOT NULL,
    Img  VARCHAR(500) NOT NULL,
    CategoryId INT NOT NULL,

    constraint FK_catID foreign key(CategoryId) references categorys(CategoryId)
);

-- Insert rows into table 'Products'
INSERT INTO Products
( -- columns to insert data into
 ProductsId, ProductName, Description, Price, Color, Img, CategoryId
)
VALUES
( 1, 'Deco Vibe', 'Deco Vibe erbjuder ett fullständigt stöd och är dessutom en snygg bh. Med plunge-effekten får du ett diskret lyft och en perfekt rundning.', 599, 'Black', 'img/Deco-Vibe-black-front.jpg', 1),
( 2, 'Deco Vibe', 'Deco Vibe erbjuder ett fullständigt stöd och är dessutom en snygg bh. Med plunge-effekten får du ett diskret lyft och en perfekt rundning.', 599, 'Blush', 'img/Deco-vibe-blush-front.jpg',  1),
( 3, 'Ciao Bella', 'En drömmig balkonett bh med en bas i rosa täckt av svart spets.', 349, 'Black', 'img/Ciaobella-front.jpg', 1 ),
( 4, 'Deco Rebel', 'En gepardmönstrad bh med vaddering och den skönaste plunge-effekten på marknaden. Brösten får ett skönt stöd och en vacker rundning.', 559, 'Gepard', 'img/Deco-rebel-front.jpg', 1),
( 5, 'Full Bloom', 'En lätt drömmig bh från märket B´temptd med öppen detalj mellan brösten.', 239, 'Beige', 'img/Full-bloom-front.jpg', 1),
( 6, 'Rebecca', 'En fullsupport bh i ett superskönt material som är speciellt anpassad för att andas.', 659, 'White', 'img/Rebecca-white-front.jpg', 1),
( 7, 'Deco Rebel Hipster', 'En snygg hipster trosa från serien Deco från Freya. I härligt mjuk trikå som låter huden andas. Matcha gärna med bh:n från samma kollektion.', 129, 'Gepard', 'img/Deco-rebel-hipster.jpg', 2),
( 8, 'Deco Vibe Hipster', 'En snygg hipster trosa från serien Deco från Freya. Fronten i mjuk trikå som följs upp av spets i bak. Matchas gärna med bh från samma linje.', 139, 'Blush', 'img/Deco-vibe-blush-short-back.jpg', 2),
( 9, 'Lace Kiss Thong', 'En romantisk string i spets.', 99, 'Beige', 'img/Lace-kiss-natural-thong-back.jpg', 2);

-- Create a new table called 'Productvariations' in schema 'stellasina'
-- Drop the table if it already exists

-- Create the table in the specified schema
CREATE TABLE Productvariations
(
    PVId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    Size INT NOT NULL,
    ProductId INT NOT NULL,

    constraint FK_ProductID foreign key(ProductId) references Products(ProductsId),
    constraint FK_size_id foreign key(Size) references sizechart(SizeId)
);

-- Insert rows into table 'Productvariations'
INSERT INTO Productvariations
( -- columns to insert data into
 PVId, Size, ProductId
)
VALUES
( 1, '40', 1),
( 2, '59', 1),
( 3, '28', 1),
( 4, '28', 2),
( 5, '34', 2),
( 6, '40', 2),
( 7, '16', 3),
( 8, '22', 3),
( 9, '23', 3),
( 10, '39', 4),
( 11, '46', 4),
( 12, '51', 4),
( 13, '16', 5),
( 14, '21', 5),
( 15, '28', 5),
( 16, '35', 6),
( 17, '47', 6),
( 18, '34', 6),
( 19, '61', 7),
( 20, '62', 7),
( 21, '63', 7),
( 22, '61', 8),
( 23, '62', 8),
( 24, '63', 8),
( 25, '61', 9),
( 26, '62', 9),
( 27, '63', 9);

CREATE TABLE images
(   ImageId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    ProductsId INT NOT NULL,
    Image VARCHAR(550) NOT NULL,

    constraint FK_prodimgId foreign key(ProductsId) references Products(ProductsId)
  );


INSERT INTO images
( -- columns to insert data into
 ImageId, ProductsId, Image
)
VALUES
( 1, 1, 'img/Deco-vibe-black-back.jpg'),
( 2, 1, 'img/Deco-vibe-black-back-closed.jpg'),
( 3, 2, 'img/Deco-vibe-blush-back.jpg'),
( 4, 2, 'img/Deco-vibe-blush-back-closed.jpg'),
( 5, 3, 'img/ciaobella-back.jpg'),
( 6, 4, 'img/Deco-rebel-back.jpg'),
( 7, 5, 'img/Full-bloom-back.jpg'),
( 8, 6, 'img/Rebecca-red-back.jpg');


-- Create a new table called 'Customers' in schema 'dbo'
-- Drop the table if it already exists

-- Create the table in the specified schema
CREATE TABLE Customers
(
    CustomersId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    Firstname VARCHAR(50) NOT NULL,
    Lastname VARCHAR(50) NOT NULL,
    Address VARCHAR(50) NOT NULL,
    Zipcode VARCHAR(6) NOT NULL,
    City VARCHAR(50) NOT NULL,
    Mail VARCHAR(50) NOT NULL,
    Phone VARCHAR(50) NOT NULL,
    Password VARCHAR(500) NOT NULL
);


-- Insert rows into table 'Customers'
INSERT INTO Customers
( -- columns to insert data into
 CustomersId, Firstname, Lastname, Address, Zipcode, City, Mail, Phone, Password)
VALUES
( 1, 'Jenny', 'Norén', 'Harpsundsvägen 125', 12458, 'Bandhagen', 'test@mail.com', '073-525 34 83', '$2y$10$qzQXEhQ4T375Nq8LzuyYP.rJvphi7gT6pjp8WP/kSdoazwD7XZQki'),
( 2, 'Britt-Karin', 'Göransson', 'Ottekilsvägen 13', 12430, 'Bandhagen', 'britt.karin@mail.com', '070-456 48 93', 'morris'),
( 3, 'Ida', 'Aspnor', 'Skarplöts Allé 56', 19856, 'Haninge', 'ida1987@hotmail.com', '073-569 78 23', 'ellen'),
( 4, 'Ida', 'Holmström', 'Fjärilsstigen 151', 14678, 'Salem', 'holmstrom.ida@live.com', '070-656 89 13', 'micke'),
( 5, 'Clara', 'Delding', 'Testvägen 154', 12369, 'Farsta', 'clara.D@live.se', '073-450 15 98', 'musik');

-- Create a new table called 'Orders' in schema 'dbo'

CREATE TABLE Orders
(
    OrderId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    CustomersId INT NOT NULL,
    Date DATE,

constraint FK_Customers foreign key(CustomersId) references Customers(CustomersId)

);

-- Insert rows into table 'Orders'
INSERT INTO Orders
( -- columns to insert data into
 OrderId, CustomersId, Date
)
VALUES
( -- first row: values for the columns in the list above
 1, 3, '2019-01-10'),
(2, 4, '2018-01-11'),
( 3, 1, '2018-06-05'),
(4, 5, '2017-10-18'),
(5, 2, '2018-11-26'),
(6, 1, '2019-01-09');

CREATE TABLE Orderitem
(
    OrderitemId INT NOT NULL AUTO_INCREMENT PRIMARY KEY, -- primary key column
    ProductvariationsId INT NOT NULL,
    Quantity INT NOT NULL,
    OrderId INT NOT NULL, 

    constraint FK_PId foreign key(ProductvariationsId) references Productvariations(PVId),
    constraint FK_OrderId foreign key(OrderId) references Orders(OrderId)
);

INSERT INTO Orderitem
( -- columns to insert data into
 OrderitemId, ProductvariationsId, Quantity, OrderId
)
VALUES
( 1, 26, 2, 1),
( 2, 5, 1, 1),
( 3, 26, 1, 2),
( 4, 6, 1, 3),
( 5, 8, 3, 4),
( 6, 5, 1, 4),
( 7, 25, 3, 5),
(8, 13, 4, 6);


CREATE TABLE admins 
(
    adminId INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    Firstname VARCHAR(50) NOT NULL,
    Password VARCHAR(500) NOT NULL
);

INSERT INTO admins
(
    adminId, username, Firstname, Password
)
VALUES
( 1, 'admin', 'admin', '$2y$10$hPoqvmjraRLxpOMALqAhle58SI9q6L.yJi57dgu21TKDpKkVMP4wS');
-- Testlösen = admin --