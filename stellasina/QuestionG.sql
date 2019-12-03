-- 1
SELECT * FROM dbo.Products
-- 2
SELECT PV.PVId, ProductName FROM dbo.Products AS P
JOIN dbo.Productvariations AS PV ON PV.PVId = P.ProductsId
-- 3
SELECT ProductName, Price FROM dbo.Products
WHERE Price > 100;
-- 4
SELECT OrderId, Date FROM 
dbo.Orders
WHERE DATE > '2018-01-29'
-- 5
SELECT  O.OrderId, O.Date FROM 
dbo.Customers AS C
JOIN dbo.Orders AS O ON O.CustomersId = C.CustomersId
JOIN dbo.Orderitem AS OI ON O.OrderId = OI.OrderId
JOIN dbo.Productvariations AS PV ON PV.PVId = OI.ProductvariationsId
GROUP BY O.OrderId, O.[Date]
ORDER BY O.Date DESC






