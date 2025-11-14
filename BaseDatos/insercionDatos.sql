-- =========================
-- INSERTS TABLA CLIENTES
-- =========================
INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA, TELEFONO, PUNTOS) VALUES
('Ana Pérez', 'ana.perez@mail.com', 'pass123', '612345678', 50),
('Luis García', 'luis.garcia@mail.com', '1234', '698765432', 20),
('Marta López', 'marta.lopez@mail.com', 'abcd', '677889900', 10),
('Pedro Sánchez', 'pedro.sanchez@mail.com', 'ps2025', '611223344', 15),
('Lucía Fernández', 'lucia.fernandez@mail.com', 'lfpass', '622334455', 5),
('Jorge Ruiz', 'jorge.ruiz@mail.com', 'jorge01', '633445566', 25),
('Carla Morales', 'carla.morales@mail.com', 'cmlove', '644556677', 30),
('Diego Torres', 'diego.torres@mail.com', 'dt2025', '655667788', 40),
('Sara Díaz', 'sara.diaz@mail.com', 'sdpw', '666778899', 60),
('Raúl Ortega', 'raul.ortega@mail.com', 'r2025', '677889900', 35);

-- =========================
-- INSERTS TABLA EMPLEADOS
-- =========================
INSERT INTO EMPLEADOS (NOMBRE, APELLIDOS, PUESTO, SALARIO, TURNO, FECHA_CONTRATACION) VALUES
('Carlos', 'Ramírez', 'Barista', 1500.00, 'Mañana', '2023-01-10'),
('Laura', 'Sánchez', 'Cocinera', 1600.00, 'Tarde', '2022-09-15'),
('Jorge', 'Hernández', 'Cajero', 1400.00, 'Mañana', '2023-03-01'),
('Elena', 'Gómez', 'Barista', 1500.00, 'Tarde', '2023-02-20'),
('Miguel', 'Vargas', 'Cocinero', 1600.00, 'Mañana', '2022-12-05');

-- =========================
-- INSERTS TABLA PROVEEDORES
-- =========================
INSERT INTO PROVEEDORES (NOMBRE, TELEFONO, EMAIL, DIRECCION) VALUES
('Café del Sur', '612345001', 'contacto@cafedelsur.com', 'Calle Sol 10'),
('Dulces y Más', '612345002', 'ventas@dulcesymas.com', 'Avenida Luna 5'),
('Frutas Frescas', '612345003', 'info@frutasfrescas.com', 'Calle Naranja 8'),
('Lácteos del Norte', '612345004', 'ventas@lacteosnorte.com', 'Avenida Leche 12'),
('Panadería Central', '612345005', 'contacto@panaderiacentral.com', 'Calle Pan 7');

-- =========================
-- INSERTS TABLA PRODUCTOS
-- =========================
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR) VALUES
('Café Latte', 'Bebida', 2.50, 50, 1),
('Té Verde', 'Bebida', 1.80, 30, 1),
('Cappuccino', 'Bebida', 2.70, 40, 1),
('Croissant', 'Pastelería', 1.20, 40, 2),
('Muffin Chocolate', 'Pastelería', 1.50, 25, 2),
('Zumo Naranja', 'Bebida', 2.00, 30, 3),
('Yogur Natural', 'Lácteo', 1.00, 20, 4),
('Pan Integral', 'Panadería', 1.50, 50, 5),
('Sándwich Jamón', 'Comida', 3.50, 30, 5),
('Tarta Manzana', 'Pastelería', 2.00, 15, 2),
('Smoothie Fresa', 'Bebida', 2.80, 20, 3),
('Bagel Salmón', 'Comida', 3.00, 15, 5),
('Leche Entera', 'Lácteo', 1.20, 25, 4),
('Galletas Avena', 'Pastelería', 1.50, 30, 2),
('Té Rojo', 'Bebida', 1.90, 25, 1);

-- =========================
-- INSERTS TABLA PEDIDOS
-- =========================
INSERT INTO PEDIDOS (FECHA, TOTAL, ID_EMPLEADO, ID_CLIENTE) VALUES
('2025-11-14', 6.70, 1, 1),
('2025-11-14', 3.00, 3, 2),
('2025-11-14', 5.50, 2, 3),
('2025-11-15', 4.80, 4, 4),
('2025-11-15', 7.20, 5, 5),
('2025-11-15', 6.00, 1, 6),
('2025-11-16', 8.50, 3, 7),
('2025-11-16', 9.20, 2, 8),
('2025-11-16', 5.00, 4, 9),
('2025-11-17', 4.50, 5, 10);

-- =========================
-- INSERTS TABLA DETALLE_PEDIDO
-- =========================
INSERT INTO DETALLE_PEDIDO (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO, SUBTOTAL) VALUES
(1, 1, 2, 2.50, 5.00),
(1, 4, 1, 1.20, 1.20),
(2, 2, 1, 1.80, 1.80),
(2, 5, 1, 1.50, 1.50),
(3, 3, 1, 2.70, 2.70),
(3, 10, 1, 2.00, 2.00),
(4, 4, 2, 1.20, 2.40),
(4, 6, 1, 2.00, 2.00),
(5, 7, 2, 1.00, 2.00),
(5, 8, 1, 1.50, 1.50),
(6, 9, 1, 3.50, 3.50),
(6, 12, 1, 3.00, 3.00),
(7, 11, 2, 2.80, 5.60),
(7, 13, 1, 1.20, 1.20),
(8, 1, 2, 2.50, 5.00),
(8, 14, 2, 1.50, 3.00),
(9, 15, 1, 1.90, 1.90),
(9, 2, 2, 1.80, 3.60),
(10, 4, 1, 1.20, 1.20),
(10, 5, 2, 1.50, 3.00);

-- =========================
-- INSERTS TABLA INVENTARIO
-- =========================
INSERT INTO INVENTARIO (ID_PRODUCTO, CANTIDAD, FECHA) VALUES
(1, 50, '2025-11-14'),
(2, 30, '2025-11-14'),
(3, 40, '2025-11-14'),
(4, 40, '2025-11-14'),
(5, 25, '2025-11-14'),
(6, 30, '2025-11-14'),
(7, 20, '2025-11-14'),
(8, 50, '2025-11-14'),
(9, 30, '2025-11-14'),
(10, 15, '2025-11-14'),
(11, 20, '2025-11-14'),
(12, 15, '2025-11-14'),
(13, 25, '2025-11-14'),
(14, 30, '2025-11-14'),
(15, 25, '2025-11-14');

-- =========================
-- INSERTS TABLA LOYALTY_TRANSACTIONS
-- =========================
INSERT INTO LOYALTY_TRANSACTIONS (ID_CLIENTE, ID_PEDIDO, TIPO, PUNTOS, DESCRIPCION) VALUES
(1,1,'GANADO',10,'Compra café y croissant'),
(2,2,'GANADO',5,'Compra té y muffin'),
(3,3,'GANADO',12,'Compra cappuccino y tarta'),
(4,4,'GANADO',8,'Compra croissant y zumo'),
(5,5,'GANADO',6,'Compra yogur y pan'),
(6,6,'GANADO',7,'Compra sándwich y bagel'),
(7,7,'GANADO',9,'Compra smoothie y leche'),
(8,8,'GANADO',11,'Compra café y galletas'),
(9,9,'GANADO',10,'Compra té y galletas'),
(10,10,'GANADO',5,'Compra croissant y muffin');

-- =========================
-- INSERTS TABLA RECOMPENSAS
-- =========================
INSERT INTO RECOMPENSAS (NOMBRE, DESCRIPCION, PUNTOS_REQUERIDOS) VALUES
('Bebida Gratis', 'Una bebida a elección', 20),
('Snack Gratis', 'Croissant o muffin gratis', 15),
('Smoothie Gratis', 'Smoothie a elección', 25),
('Descuento 5%', 'Descuento en el total', 10);

-- =========================
-- INSERTS TABLA CANJES
-- =========================
INSERT INTO CANJES (ID_CLIENTE, ID_RECOMPENSA) VALUES
(1,1),
(2,2),
(3,3),
(4,1),
(5,2),
(6,4),
(7,3),
(8,1),
(9,2),
(10,4);

-- =========================
-- INSERTS TABLA PAGOS
-- =========================
INSERT INTO PAGOS (ID_PEDIDO, TIPO_PAGO, MONTO) VALUES
(1,'TARJETA',6.70),
(2,'EFECTIVO',3.00),
(3,'PAYPAL',5.50),
(4,'BIZUM',4.80),
(5,'TARJETA',7.20),
(6,'EFECTIVO',6.00),
(7,'PAYPAL',8.50),
(8,'BIZUM',9.20),
(9,'TARJETA',5.00),
(10,'EFECTIVO',4.50);
