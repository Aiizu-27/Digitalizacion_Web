-- =========================
-- INSERTS PRODUCTOS DAILY DOSE (Stock y proveedor realista)
-- =========================

-- Espresso Bar (Proveedor 1, Stock alto)
INSERT INTO PRODUCTOS 
(NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) 
VALUES
('Espresso', 'Espresso Bar', 2.00, 100, 1, 'expresso.png'),
('Doppio', 'Espresso Bar', 2.60, 80, 1, 'doppio.png'),
('Americano', 'Espresso Bar', 2.20, 90, 1, 'americano.png'),
('Filtro del día (V60 / Chemex / Batch Brew)', 'Espresso Bar', 2.50, 70, 1, 'filtro-dia.png');

-- Cafés con leche (Proveedor 1, Stock alto)
INSERT INTO PRODUCTOS 
(NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) 
VALUES
('Cortado', 'Cafés con leche', 2.20, 90, 1, 'cortado.png'),
('Café con leche', 'Cafés con leche', 2.40, 90, 1, 'cafe_con_leche.png'),
('Capuccino', 'Cafés con leche', 2.80, 80, 1, 'capuccino.png'),
('Latte', 'Cafés con leche', 3.00, 70, 1, 'latte.png'),
('Flat White', 'Cafés con leche', 3.20, 60, 1, 'flat_white.png');


-- Leches alternativas (Proveedor 2, Stock medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Leche alternativa (Avena · Soja · Almendra)', 'Leches alternativas', 0.30, 50, 2);

-- Cafés de autor (Proveedor 1, Stock medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Vainilla Latte', 'Cafés de autor', 3.40, 50, 1),
('Caramel Latte', 'Cafés de autor', 3.40, 50, 1),
('Mocha 70%', 'Cafés de autor', 3.60, 40, 1),
('Honey Latte', 'Cafés de autor', 3.60, 40, 1),
('Seasonal Special', 'Cafés de autor', 3.80, 30, 1);

-- Cafés fríos (Proveedor 1, Stock medio-alto)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Iced Latte', 'Cafés fríos', 3.20, 60, 1),
('Cold Brew', 'Cafés fríos', 3.00, 50, 1),
('Cold Brew con leche', 'Cafés fríos', 3.40, 50, 1);

-- Té y otras bebidas (Proveedor 3, Stock medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Té negro / verde', 'Té y otras bebidas', 2.40, 40, 3),
('Rooibos / manzanilla', 'Té y otras bebidas', 2.30, 40, 3),
('Chai Latte', 'Té y otras bebidas', 3.60, 30, 3),
('Matcha Latte', 'Té y otras bebidas', 3.80, 30, 3);

-- Bakery artesanal (Proveedor 4, Stock medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Croissant de mantequilla', 'Bakery artesanal', 2.20, 50, 4),
('Croissant relleno', 'Bakery artesanal', 2.60, 50, 4),
('Cookie artesana', 'Bakery artesanal', 2.40, 50, 4),
('Muffin casero', 'Bakery artesanal', 2.80, 40, 4),
('Bizcocho del día', 'Bakery artesanal', 3.00, 30, 4);

-- Pastelería de autor (Proveedor 4, Stock bajo-medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Brownie de chocolate', 'Pastelería de autor', 3.50, 30, 4),
('Cheesecake', 'Pastelería de autor', 3.80, 25, 4),
('Tarta del día', 'Pastelería de autor', 4.00, 20, 4);

-- Brunch & Salado (Proveedor 5, Stock medio)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Tostada de masa madre (AOVE y tomate)', 'Brunch & Salado', 3.20, 40, 5),
('Tostada de aguacate', 'Brunch & Salado', 4.50, 30, 5),
('Sandwich artesanal', 'Brunch & Salado', 4.80, 30, 5),
('Quiche del día', 'Brunch & Salado', 5.20, 20, 5);

-- Extras (Proveedor 2, Stock bajo)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Shot extra de espresso', 'Extras', 0.60, 50, 2),
('Sirope natural', 'Extras', 0.40, 50, 2),
('Nata artesanal', 'Extras', 0.50, 50, 2),
('Upgrade grano premium', 'Extras', 0.80, 40, 2);