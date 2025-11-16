-- CLIENTES
INSERT INTO CLIENTES (NOMBRE, CORREO, CONTRASENA, TELEFONO, PUNTOS) VALUES
('Ana García', 'ana@dailydose.com', '$2b$12$SgQEOccvjzLbse0jAKIC0.QQclCO2e0I0VSFaJwJVLilMj.mg7EqK', '600123456', 50),
('Luis Fernández', 'luis@dailydose.com', '$2b$12$X0lnD6Tr1ChL3.LkDK.y2uHwhzJHYQCkXyAiKi07HFd3hUlPBEIt.', '600654321', 30),
('Marta López', 'marta@dailydose.com', '$2b$12$97FpOdEtC9GRDQqePFsdwOzzTK.kczE4YQ1hOTG8kndGLcazmQriK', '600987654', 20),
('Carlos Ruiz', 'carlos@dailydose.com', '$2b$12$rCyjQTlyf2Tt7GfH8UDLxO3RHpGRdPFgm7g9l/zDhBO2LDeZ9YXm2', '600456789', 40);


-- EMPLEADOS
INSERT INTO EMPLEADOS (NOMBRE, APELLIDOS, PUESTO, SALARIO, TURNO, FECHA_CONTRATACION) VALUES
('Lucía', 'Campos', 'Gerente', 1800.00, 'Mañana', '2024-01-10'),
('Rubén', 'Sacristán', 'Jefe de Operaciones', 1500.00, 'Tarde', '2024-02-15'),
('Adrián', 'Donoso', 'Barista', 1200.00, 'Mañana', '2024-03-20'),
('Marcos', 'Borrego', 'Marketing', 1300.00, 'Tarde', '2024-04-01');

-- PROVEEDORES
INSERT INTO PROVEEDORES (NOMBRE, TELEFONO, EMAIL, DIRECCION) VALUES
('Proveedor Café', '911123456', 'contacto@cafesupreme.com', 'Calle Aroma 12, Madrid'),
('Proveedor Pastelería', '911654321', 'info@dulcesymas.com', 'Calle Dulce 5, Madrid');

-- PRODUCTOS
INSERT INTO PRODUCTOS (NOMBRE, CATEGORIA, PRECIO, STOCK, ID_PROVEEDOR, RUTA_IMAGEN) VALUES
('Café Latte', 'Bebida', 2.50, 50, 1, 'images/cafe_latte.jpg'),
('Capuccino', 'Bebida', 2.80, 40, 1, 'images/capuccino.jpg'),
('Croissant', 'Pastelería', 1.50, 30, 2, 'images/croissant.jpg'),
('Muffin Chocolate', 'Pastelería', 1.80, 25, 2, 'images/muffin_choco.jpg');

-- PEDIDOS
INSERT INTO PEDIDOS (FECHA, TOTAL, ID_EMPLEADO, ID_CLIENTE) VALUES
('2025-11-01', 6.80, 3, 1),
('2025-11-02', 4.30, 4, 2),
('2025-11-03', 4.30, 3, 3);

-- DETALLE_PEDIDO
INSERT INTO DETALLE_PEDIDO (ID_PEDIDO, ID_PRODUCTO, CANTIDAD, PRECIO_UNITARIO, SUBTOTAL) VALUES
(1, 1, 1, 2.50, 2.50),
(1, 3, 1, 1.50, 1.50),
(1, 4, 1, 1.80, 1.80),
(2, 2, 1, 2.80, 2.80),
(2, 3, 1, 1.50, 1.50),
(3, 2, 1, 2.80, 2.80),
(3, 4, 1, 1.50, 1.50);

-- INVENTARIO
INSERT INTO INVENTARIO (ID_PRODUCTO, CANTIDAD, FECHA) VALUES
(1, 50, '2025-11-01'),
(2, 40, '2025-11-01'),
(3, 30, '2025-11-01'),
(4, 25, '2025-11-01');

-- LOYALTY_TRANSACTIONS
INSERT INTO LOYALTY_TRANSACTIONS (ID_CLIENTE, ID_PEDIDO, TIPO, PUNTOS, DESCRIPCION) VALUES
(1, 1, 'GANADO', 10, 'Compra de productos'),
(2, 2, 'GANADO', 8, 'Compra de productos'),
(3, 3, 'GANADO', 9, 'Compra de productos');

-- RECOMPENSAS
INSERT INTO RECOMPENSAS (NOMBRE, DESCRIPCION, PUNTOS_REQUERIDOS) VALUES
('Café Gratis', 'Un café a elegir', 50),
('Descuento 10%', 'Descuento en la próxima compra', 30);

-- CANJES
INSERT INTO CANJES (ID_CLIENTE, ID_RECOMPENSA) VALUES
(1, 1),
(2, 2);

-- PAGOS
INSERT INTO PAGOS (ID_PEDIDO, TIPO_PAGO, MONTO) VALUES
(1, 'TARJETA', 6.80),
(2, 'PAYPAL', 4.30),
(3, 'EFECTIVO', 4.30);
