SELECT O.OrderId, C.Firstname, C.Lastname, O.Date, count(O.OrderId) AS TotalProductrows FROM 
dbo.Customers AS C
JOIN dbo.Orders AS O ON O.CustomersId = C.CustomersId
JOIN dbo.Orderitem AS OI ON O.OrderId = OI.OrderId
JOIN dbo.Productvariations AS PV ON PV.PVId = OI.ProductvariationsId
GROUP BY O.OrderId, C.Firstname, C.Lastname, O.[Date]
ORDER BY O.OrderId

SELECT P.ProductName, C.Firstname, C.Lastname FROM 
dbo.Customers AS C
JOIN dbo.Orders AS O ON O.CustomersId = C.CustomersId
JOIN dbo.Orderitem AS OI ON O.OrderId = OI.OrderId
JOIN dbo.Productvariations AS PV ON PV.PVId = OI.ProductvariationsId
JOIN dbo.Products AS P ON P.ProductsId = PV.ProductId

SELECT O.OrderId, C.Firstname, C.Lastname, SUM(OI.Quantity) AS TotalProdPerOrder FROM 
dbo.Customers AS C
JOIN dbo.Orders AS O ON O.CustomersId = C.CustomersId
JOIN dbo.Orderitem AS OI ON O.OrderId = OI.OrderId
JOIN dbo.Productvariations AS PV ON PV.PVId = OI.ProductvariationsId
JOIN dbo.Products AS P ON P.ProductsId = PV.ProductId
GROUP BY O.OrderId, C.Firstname, C.Lastname

SELECT C.Firstname, SUM(OI.Quantity * P.Price) AS TotalSpent FROM 
dbo.Customers AS C
JOIN dbo.Orders AS O ON O.CustomersId = C.CustomersId
JOIN dbo.Orderitem AS OI ON O.OrderId = OI.OrderId
JOIN dbo.Productvariations AS PV ON PV.PVId = OI.ProductvariationsId
JOIN dbo.Products AS P ON P.ProductsId = PV.ProductId
GROUP BY C.Firstname
ORDER BY TotalSpent DESC

