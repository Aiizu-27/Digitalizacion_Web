-- ======================================================
-- INSERTS COMPLETOS PRODUCTOS DAILY DOSE
-- ======================================================

-- 1. Espresso Bar (Proveedor 1)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Espresso', 'Espresso Bar', 2.00, 100, 1, 'expresso.png'),
('Doppio', 'Espresso Bar', 2.60, 80, 1, 'doppio.png'),
('Americano', 'Espresso Bar', 2.20, 90, 1, 'americano.png'),
('Filtro del día (V60 / Chemex / Batch Brew)', 'Espresso Bar', 2.50, 70, 1, 'filtro-dia.png');

-- 2. Cafés con leche (Proveedor 1)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Cortado', 'Cafés con leche', 2.20, 90, 1, 'cortado.png'),
('Café con leche', 'Cafés con leche', 2.40, 90, 1, 'cafe_con_leche.png'),
('Capuccino', 'Cafés con leche', 2.80, 80, 1, 'capuccino.png'),
('Latte', 'Cafés con leche', 3.00, 70, 1, 'latte.png'),
('Flat White', 'Cafés con leche', 3.20, 60, 1, 'flat_white.png');

-- 3. Leches alternativas (Proveedor 2)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Leche alternativa (Avena · Soja · Almendra)', 'Leches alternativas', 0.30, 50, 2, NULL);

-- 4. Cafés de autor (Proveedor 1)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Vainilla Latte', 'Cafés de autor', 3.40, 50, 1, 'vainilla_latte.png'),
('Caramel Latte', 'Cafés de autor', 3.40, 50, 1, 'caramel_latte.png'),
('Mocha 70%', 'Cafés de autor', 3.60, 40, 1, 'mocha_70.png'),
('Honey Latte', 'Cafés de autor', 3.60, 40, 1, 'honey_latte.png'),
('Seasonal Special', 'Cafés de autor', 3.80, 30, 1, NULL);

-- 5. Cafés fríos (Proveedor 1)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Iced Latte', 'Cafés fríos', 3.20, 60, 1, 'iced_latte.png'),
('Cold Brew', 'Cafés fríos', 3.00, 50, 1, 'cold_brew.png'),
('Cold Brew con leche', 'Cafés fríos', 3.40, 50, 1, 'cold_brew_leche.png');

-- 6. Té y otras bebidas (Proveedor 3)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Té negro / verde', 'Té y otras bebidas', 2.40, 40, 3, NULL),
('Rooibos / manzanilla', 'Té y otras bebidas', 2.30, 40, 3, NULL),
('Chai Latte', 'Té y otras bebidas', 3.60, 30, 3, NULL),
('Matcha Latte', 'Té y otras bebidas', 3.80, 30, 3, NULL);

-- 7. Bakery artesanal (Proveedor 4)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Croissant de mantequilla', 'Bakery artesanal', 2.20, 50, 4, 'croissant_mantequilla.png'),
('Croissant relleno', 'Bakery artesanal', 2.60, 50, 4, 'croissant_relleno.png'),
('Cookie artesana', 'Bakery artesanal', 2.40, 50, 4, 'cookies.png'),
('Muffin casero', 'Bakery artesanal', 2.80, 40, 4, NULL),
('Bizcocho del día', 'Bakery artesanal', 3.00, 30, 4, NULL);

-- 8. Pastelería de autor (Proveedor 4)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Brownie de chocolate', 'Pastelería de autor', 3.50, 30, 4, 'brownie.png'),
('Cheesecake', 'Pastelería de autor', 3.80, 25, 4, 'cheesecake.png'),
('Tarta del día', 'Pastelería de autor', 4.00, 20, 4, NULL);

-- 9. Brunch & Salado (Proveedor 5)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Tostada de masa madre (AOVE y tomate)', 'Brunch & Salado', 3.20, 40, 5, NULL),
('Tostada de aguacate', 'Brunch & Salado', 4.50, 30, 5, NULL),
('Sandwich artesanal', 'Brunch & Salado', 4.80, 30, 5, NULL),
('Quiche del día', 'Brunch & Salado', 5.20, 20, 5, NULL);

-- 10. Extras (Proveedor 2)
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Shot extra de espresso', 'Extras', 0.60, 50, 2, NULL),
('Sirope natural', 'Extras', 0.40, 50, 2, NULL),
('Nata artesanal', 'Extras', 0.50, 50, 2, NULL),
('Upgrade grano premium', 'Extras', 0.80, 40, 2, NULL);