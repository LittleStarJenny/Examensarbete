



IF OBJECT_ID('dbo.Orderitem', 'U') IS NOT NULL
DROP TABLE dbo.Orderitem
GO

IF OBJECT_ID('dbo.Productvariations', 'U') IS NOT NULL
DROP TABLE dbo.Productvariations
GO

IF OBJECT_ID('dbo.Products', 'U') IS NOT NULL
DROP TABLE dbo.Products
GO

IF OBJECT_ID('dbo.Orders', 'U') IS NOT NULL
DROP TABLE dbo.Orders
GO

IF OBJECT_ID('dbo.Customers', 'U') IS NOT NULL
DROP TABLE dbo.Customers;
GO





-- Create the table in the specified schema
CREATE TABLE dbo.Products
(
    `ProductsId` INT NOT NULL PRIMARY KEY, -- primary key column
    ProductName [NVARCHAR](50) NOT NULL,
    [Description] [NVARCHAR](500) NOT NULL,
    Price  INT NOT NULL,
    Color [NVARCHAR](50) NOT NULL,
    Img  [NVARCHAR](500) NOT NULL
);
GO

-- Insert rows into table 'Products'
INSERT INTO Products
( -- columns to insert data into
 ProductsId, ProductName, [Description], Price, Color, Img
)
VALUES
( 1, 'Deco Vibe', 'Deco Vibe erbjuder ett fullständigt stöd och är dessutom en snygg bh. Med plunge-effekten får du ett diskret lyft och en perfekt rundning.', 599, 'Black', 'img/Deco-Vibe-black-front.jpg'),
( 2, 'Deco Vibe', 'Deco Vibe erbjuder ett fullständigt stöd och är dessutom en snygg bh. Med plunge-effekten får du ett diskret lyft och en perfekt rundning.', 599, 'Blush', 'img/Deco-vibe-blush-front.jpg' ),
( 3, 'Ciao Bella', 'En drömmig balkonett bh med en bas i rosa täckt av svart spets.', 349, 'Black', 'img/Ciaobella-front.jpg' ),
( 4, 'Deco Rebel', 'En gepardmönstrad bh med vaddering och den skönaste plunge-effekten på marknaden. Brösten får ett skönt stöd och en vacker rundning.', 559, 'Gepard', 'img/Deco-rebel-front.jpg'),
( 5, 'Full Bloom', 'En lätt drömmig bh från märket B´temptd med öppen detalj mellan brösten.', 239, 'Beige', 'img/Full-bloom-front.jpg'),
( 6, 'Rebecca', 'En fullsupport bh i ett superskönt material som är speciellt anpassad för att andas.', 659, 'White', 'img/Rebecca-white-front.jpg'),
( 7, 'Deco Rebel Hipster', 'En snygg hipster trosa från serien Deco från Freya. I härligt mjuk trikå som låter huden andas. Matcha gärna med bh:n från samma kollektion.', 129, 'Gepard', 'img/Deco-rebel-hipster.jpg'),
( 8, 'Deco Vibe Hipster', 'En snygg hipster trosa från serien Deco från Freya. Fronten i mjuk trikå som följs upp av spets i bak. Matchas gärna med bh från samma linje.', 139, 'Blush', 'img/Deco-vibe-blush-short-back.jpg'),
( 9, 'Lace Kiss Thong', 'En romantisk string i spets.', 99, 'Beige', 'img/Lace-kiss-natural-thong-back.jpg')

GO

-- Create a new table called 'Productvariations' in schema 'dbo'
-- Drop the table if it already exists

-- Create the table in the specified schema
CREATE TABLE dbo.Productvariations
(
    PVId INT NOT NULL PRIMARY KEY, -- primary key column
    [ArticleNr] [NVARCHAR](50) NOT NULL,
    [Size] [NVARCHAR](50) NOT NULL,
    [ProductId] INT NOT NULL

    constraint FK_ProductID foreign key(ProductId) references dbo.Products(ProductsId),

);
GO

-- Insert rows into table 'Productvariations'
INSERT INTO Productvariations
( -- columns to insert data into
 [PVId], [ArticleNr], [Size], [ProductId]
)
VALUES
( 1, 'AA14852', '75G', 1),
( 2, 'AA14853', '80J', 1),
( 3, 'AA14854', '75E', 1),
( 4, 'AA14955', '75E', 2),
( 5, 'AA14956', '75F', 2),
( 6, 'AA14957', '75G', 2),
( 7, 'CB14955', '75C', 3),
( 8, 'CB14956', '75D', 3),
( 9, 'CB14957', '80D', 3),
( 10, 'DR56048', '70G', 4),
( 11, 'DR56049', '75H', 4),
( 12, 'DR56050', '70I', 4),
( 13, 'FB45611', '75C', 5),
( 14, 'FB45612', '70D', 5),
( 15, 'FB45613', '75E', 5),
( 16, 'RW45698', '80F', 6),
( 17, 'RW45699', '80H', 6),
( 18, 'RW45700', '75F', 6),
( 19, 'DCH569', 'S', 7),
( 20, 'DCH570', 'M', 7),
( 21, 'DCH571', 'L', 7),
( 22, 'DVH548', 'S', 8),
( 23, 'DVH549', 'M', 8),
( 24, 'DVH550', 'L', 8),
( 25, 'LKT123', 'S', 9),
( 26, 'LKT124', 'M', 9),
( 27, 'LKT125', 'L', 9);
GO


-- Create a new table called 'Customers' in schema 'dbo'
-- Drop the table if it already exists

-- Create the table in the specified schema
CREATE TABLE dbo.Customers
(
    CustomersId INT NOT NULL PRIMARY KEY, -- primary key column
    [Firstname] [NVARCHAR](50) NOT NULL,
    [Lastname] [NVARCHAR](50) NOT NULL,
    [Birthday] [NVARCHAR](50) NOT NULL,
    [Address] [NVARCHAR](50) NOT NULL,
    [Zipcode] INT NOT NULL,
    [City] [NVARCHAR](50) NOT NULL,
    [Mail] [NVARCHAR](50) NOT NULL,
    [Phone] [NVARCHAR](50) NOT NULL,
);
GO

-- Insert rows into table 'Customers'
INSERT INTO Customers
( -- columns to insert data into
 [CustomersId], [Firstname], [Lastname], [Birthday], [Address], [Zipcode], [City], [Mail], [Phone])
VALUES
( 1, 'Jenny', 'Norén', '1986-01-09', 'Harpsundsvägen 125', 12458, 'Bandhagen', 'littlestarjenny6@gmail.com', '073-525 34 83'),
( 2, 'Britt-Karin', 'Göransson', '1956-04-05', 'Ottekilsvägen 13', 12430, 'Bandhagen', 'britt.karin@mail.com', '070-456 48 93'),
( 3, 'Ida', 'Aspnor', '1987-05-06', 'Skarplöts Allé 56', 19856, 'Haninge', 'ida1987@hotmail.com', '073-569 78 23'),
( 4, 'Ida', 'Holmström','1989-04-05', 'Fjärilsstigen 151', 14678, 'Salem', 'holmstrom.ida@live.com', '070-656 89 13'),
( 5, 'Clara', 'Delding', '1991-10-26', 'Testvägen 154', 12369, 'Farsta', 'clara.D@live.se', '073-450 15 98');
GO




-- Create a new table called 'Orders' in schema 'dbo'

-- Create the table in the specified schema
CREATE TABLE dbo.Orders
(
    OrderId INT NOT NULL PRIMARY KEY, -- primary key column
    [OrderitemId] INT NOT NULL,
    [CustomersId] INT NOT NULL,
    [Date] DATE,

constraint FK_Customers foreign key(CustomersId) references dbo.Customers(CustomersId),

);
GO
-- Insert rows into table 'Orders'
INSERT INTO Orders
( -- columns to insert data into
 [OrderId], [OrderitemId], [CustomersId], [Date]
)
VALUES
( -- first row: values for the columns in the list above
 1, 1, 3, '2019-01-10'
),
(2, 2, 4, '2018-01-11'),
( 3, 6, 1, '2018-06-05'),
(4, 3, 5, '2017-10-18'),
(5, 4, 2, '2018-11-26'),
(6, 5, 1, '2019-01-09');

-- add more rows here
GO

-- Create a new table called 'Orderitem' in schema 'dbo'
-- Drop the table if it already exists

-- Create the table in the specified schema
CREATE TABLE dbo.Orderitem
(
    OrderitemId INT NOT NULL PRIMARY KEY, -- primary key column
    [ProductvariationsId] INT NOT NULL,
    [Quantity] INT NOT NULL,
   [OrderId] INT NOT NULL, 

    constraint FK_PId foreign key(ProductvariationsId) references dbo.Productvariations(PVId),
    constraint FK_OrderId foreign key(OrderId) references dbo.Orders(OrderId)

);
GO


INSERT INTO Orderitem
( -- columns to insert data into
 [OrderitemId], [ProductvariationsId], [Quantity], [OrderId]
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
GO