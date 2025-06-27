CREATE TABLE proj.Customer (
  customer_id INT PRIMARY KEY,
  customer_name VARCHAR(100) NOT NULL,
  licence_id VARCHAR(50) UNIQUE NOT NULL,
  licence_time INT NOT NULL,
  phone_number VARCHAR(20),
  email VARCHAR(100) UNIQUE
);

INSERT INTO proj.Customer (customer_id, customer_name, licence_id, licence_time, phone_number, email) VALUES
(1007, 'Rafa Silva', 'LIC10001', 5, '+351912345678', 'rafasilva27@gmail.com'),
(1032, 'Ricardo Quaresma', 'LIC10002', 8, '+351923456789', 'ricardo.q7@gmail.com'),
(1078, 'Muhammed Ali', 'LIC10003', 3, '+905312345678', 'muhammedali@gmail.com'),
(1056, 'Erol Çetin', 'LIC10004', 10, '+905422345678', 'erol.cetin@gmail.com'),
(1123, 'Olivia Bennett', 'LIC10005', 7, '+12025550123', 'olivia.bennett@hotmail.com'),
(1089, 'Ece Arslan', 'LIC10006', 6, '+905555678901', 'ecearslan@icloud.com'),
(1098, 'Lebron James', 'LIC10007', 4, '+13175551234', 'kingjames@hotmail.com'),
(1024, 'Lionel Messi', 'LIC10008', 9, '+5491167890123', 'leomessi10@gmail.com'),
(1102, 'Lina Karaca', 'LIC10009', 2, '+905312987654', 'linakaraca@hotmail.com'),
(1066, 'Isabella Rose', 'LIC10010', 5, '+14155552345', 'isabelllarose@icloud.com');


CREATE TABLE proj.Discount (
  discount_id INT PRIMARY KEY,
  discount_percentage DECIMAL(5,2) NOT NULL,
  discount_code VARCHAR(50) NOT NULL
);

INSERT INTO proj.Discount (discount_id, discount_percentage, discount_code) VALUES
(2007, 10.00, 'DISC10'),
(2011, 15.00, 'DISC15'),
(2033, 20.00, 'DISC20'),
(2045, 5.00, 'DISC05'),
(2078, 12.50, 'DISC12'),
(2099, 18.00, 'DISC18'),
(2056, 25.00, 'DISC25'),
(2087, 8.00, 'DISC08'),
(2023, 30.00, 'DISC30'),
(2101, 7.50, 'DISC07');



CREATE TABLE proj.Employee (
  employee_id INT  PRIMARY KEY,
  employee_name VARCHAR(100) NOT NULL,
  employee_position VARCHAR(50)
);

INSERT INTO proj.Employee (employee_id, employee_name, employee_position) VALUES
(1021, 'Laura Adams', 'Manager'),
(1033, 'Michael Baker', 'Sales Representative'),
(1078, 'Nancy Carter', 'Technician'),
(1045, 'Oscar Diaz', 'Sales Representative'),
(1099, 'Pamela Evans', 'Supervisor'),
(1082, 'Quentin Foster', 'Mechanic'),
(1103, 'Rachel Garcia', 'Customer Service'),
(1056, 'Steven Harris', 'Manager'),
(1071, 'Tina Irving', 'Technician'),
(1068, 'Uma Jenkins', 'Sales Representative');

CREATE TABLE proj.Insurance (
  insurance_id INT PRIMARY KEY,
  insurance_cost DECIMAL(10,2),
  insurance_status VARCHAR(20)
);

INSERT INTO proj.Insurance (insurance_id, insurance_cost, insurance_status) VALUES
(301, 200.00, 'active'),
(307, 150.00, 'active'),
(319, 300.00, 'expired'),
(325, 250.00, 'active'),
(331, 180.00, 'pending'),
(337, 220.00, 'active'),
(343, 275.00, 'active'),
(349, 190.00, 'expired'),
(355, 210.00, 'active'),
(361, 230.00, 'active');

CREATE TABLE proj.Location (
  location_id INT  PRIMARY KEY,
  address VARCHAR(255) NOT NULL
);

INSERT INTO proj.Location (location_id, address) VALUES
('34000', 'İstiklal Caddesi No:5, Beyoğlu, İstanbul'),
('34100', 'Bağdat Caddesi No:120, Kadıköy, İstanbul'),
('34200', 'Bebek Caddesi No:22, Bebek, Beşiktaş, İstanbul'),
('34300', 'Nispetiye Caddesi No:88, Etiler, Beşiktaş, İstanbul'),
('34400', 'Zekeriyaköy Mahallesi No:10, Zekeriyaköy, Sarıyer, İstanbul'),
('34500', 'Abdi İpekçi Caddesi No:50, Nişantaşı, Şişli, İstanbul'),
('34600', 'Levazım Mahallesi No:14, Ulus, Beşiktaş, İstanbul'),
('34700', 'Fenerbahçe Mahallesi Kalamış Caddesi No:14, Kadıköy, İstanbul'),
('34800', 'Acıbadem Caddesi No:10, Üsküdar, İstanbul'),
('34900', 'Kartal Sahil Yolu No:99, Kartal, İstanbul');


CREATE TABLE proj.Maintenance (
  maintenance_id INT  PRIMARY KEY,
  maintenance_cost DECIMAL(10,2),
  maintenance_status VARCHAR(20)
);

INSERT INTO proj.Maintenance (maintenance_id, maintenance_cost, maintenance_status) VALUES
(1034, 100.00, 'completed'),
(1019, 120.00, 'pending'),
(1178, 90.00, 'completed'),
(1007, 150.00, 'in progress'),
(1153, 110.00, 'completed'),
(1098, 130.00, 'pending'),
(1190, 95.00, 'completed'),
(1076, 140.00, 'in progress'),
(1130, 105.00, 'completed'),
(1112, 115.00, 'pending');

CREATE TABLE proj.Payment (
  payment_id INT  PRIMARY KEY,
  payment_amount DECIMAL(10,2),
  payment_method VARCHAR(50),
  payment_status VARCHAR(20)
);

INSERT INTO proj.Payment (payment_id, payment_amount, payment_method, payment_status) VALUES
(2057, 500.00, 'credit card', 'pending'),
(2034, 600.00, 'cash', 'completed'),
(2089, 550.00, 'bank transfer', 'completed'),
(2071, 650.00, 'credit card', 'pending'),
(2045, 700.00, 'cash', 'pending'),
(2098, 520.00, 'bank transfer', 'completed'),
(2063, 580.00, 'credit card', 'pending'),
(2102, 630.00, 'cash', 'completed'),
(2028, 710.00, 'bank transfer', 'completed'),
(2081, 540.00, 'credit card', 'pending');

CREATE TABLE proj.Rental (
  rental_id INT PRIMARY KEY,
  start_date DATETIME,
  end_date DATETIME,
  rental_status VARCHAR(20)
);

INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status) VALUES
(1079, '2025-03-01 10:00:00', '2025-03-05 10:00:00', 'active'),
(1037, '2025-03-02 09:00:00', '2025-03-06 09:00:00', 'completed'),
(1092, '2025-03-03 08:00:00', '2025-03-07 08:00:00', 'cancelled'),
(1056, '2025-03-04 11:00:00', '2025-03-08 11:00:00', 'active'),
(1123, '2025-03-05 12:00:00', '2025-03-09 12:00:00', 'completed'),
(1048, '2025-03-06 13:00:00', '2025-03-10 13:00:00', 'active'),
(1102, '2025-03-07 14:00:00', '2025-03-11 14:00:00', 'active'),
(1086, '2025-03-08 15:00:00', '2025-03-12 15:00:00', 'completed'),
(1063, '2025-03-09 16:00:00', '2025-03-13 16:00:00', 'cancelled'),
(1117, '2025-03-10 17:00:00', '2025-03-14 17:00:00', 'active');


CREATE TABLE proj.Review (
  review_id INT  PRIMARY KEY,
  rating INT CHECK (rating BETWEEN 1 AND 5),
  review_date DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO proj.Review (review_id, rating, review_date) VALUES
(205, 5, '2025-03-01 12:00:00'),
(198, 4, '2025-03-02 12:00:00'),
(312, 3, '2025-03-03 12:00:00'),
(276, 5, '2025-03-04 12:00:00'),
(150, 4, '2025-03-05 12:00:00'),
(389, 2, '2025-03-06 12:00:00'),
(222, 5, '2025-03-07 12:00:00'),
(310, 3, '2025-03-08 12:00:00'),
(175, 4, '2025-03-09 12:00:00'),
(260, 5, '2025-03-10 12:00:00');


CREATE TABLE proj.Vehicle (
  vehicle_id INT  PRIMARY KEY,
  licence_plate VARCHAR(20) UNIQUE NOT NULL,
  brand VARCHAR(50) NOT NULL,
  model VARCHAR(50) NOT NULL,
  segment VARCHAR(50),
  vehicle_status VARCHAR(20),
  vehicle_price DECIMAL(10,2),
  fuel_type CHAR(20)
);

INSERT INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type) VALUES
(3021, 'ABC123', 'Toyota', 'Corolla', 'Sedan', 'available', 120.00, 'Gas'),
(2987, 'DEF456', 'Honda', 'Civic', 'Sedan', 'rented', 120.00, 'Gas'),
(3154, 'GHI789', 'Ford', 'Bronco', 'SUV', 'maintenance', 80.00, 'Diesel'),
(2890, 'JKL012', 'BMW', 'iX3', 'SUV', 'available', 150.00, 'Electric'),
(3045, 'MNO345', 'Mercedes', 'E-Class', 'Sedan', 'available', 120.00, 'Diesel'),
(3112, 'PQR678', 'Audi', 'A6', 'Sedan', 'rented', 120.00, 'Gas'),
(2975, 'STU901', 'Volkswagen', 'Golf', 'Hatchback', 'available', 100.00, 'Gas'),
(3128, 'VWX234', 'Nissan', 'Sentra', 'Sedan', 'maintenance', 100.00, 'Gas'),
(3050, 'YZA567', 'BMW', 'i7', 'Sedan', 'available', 350.00, 'Electric'),
(2903, 'BCD890', 'Tesla', 'Model 3', 'Sedan', 'available', 120.00, 'Electric'),
(3201, 'TR1234', 'Mercedes', 'C200', 'Sedan', 'available', 200.00, 'Gas'),
(3202, 'TR5678', 'BMW', 'X5', 'SUV', 'available', 250.00, 'Diesel'),
(3203, 'TR9012', 'Audi', 'A4', 'Sedan', 'available', 180.00, 'Gas'),
(3204, 'TR3456', 'Tesla', 'Model Y', 'SUV', 'available', 300.00, 'Electric'),
(3205, 'TR7890', 'Volkswagen', 'Passat', 'Sedan', 'available', 150.00, 'Diesel'),
(3206, 'TR2345', 'Toyota', 'RAV4', 'SUV', 'available', 170.00, 'Hybrid'),
(3207, 'TR6789', 'Honda', 'Accord', 'Sedan', 'available', 160.00, 'Gas'),
(3208, 'TR0123', 'Hyundai', 'Tucson', 'SUV', 'available', 140.00, 'Gas'),
(3209, 'TR4567', 'Ford', 'Mustang', 'Sports', 'available', 280.00, 'Gas'),
(3210, 'TR8901', 'Porsche', 'Cayenne', 'SUV', 'available', 350.00, 'Gas');



CREATE TABLE proj.customer_rents_vehicle (
  customer_id INT,
  vehicle_id INT,
  PRIMARY KEY (vehicle_id),
  FOREIGN KEY (customer_id) REFERENCES proj.Customer(customer_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (vehicle_id) REFERENCES proj.Vehicle(vehicle_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.customer_rents_vehicle (customer_id, vehicle_id) VALUES
(1007, 3021),
(1032, 2987),
(1078, 3154),
(1056, 2890),
(1123, 3045),
(1089, 3112),
(1098, 2975),
(1024, 3128),
(1102, 3050),
(1066, 2903);

CREATE TABLE proj.customer_has_rental (
  customer_id INT,
  rental_id INT,
  PRIMARY KEY (rental_id),
  FOREIGN KEY (customer_id) REFERENCES proj.Customer(customer_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.customer_has_rental (customer_id, rental_id) VALUES
(1007, 1079),
(1032, 1037),
(1078, 1092),
(1056, 1056),
(1123, 1123),
(1089, 1048),
(1098, 1102),
(1024, 1086),
(1102, 1063),
(1066, 1117);

CREATE TABLE proj.customer_makes_payment (
  customer_id INT,
  payment_id INT,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (customer_id) REFERENCES proj.Customer(customer_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (payment_id) REFERENCES proj.Payment(payment_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.customer_makes_payment (customer_id, payment_id) VALUES
(1007, 2057),
(1032, 2034),
(1078, 2089),
(1056, 2071),
(1123, 2045),
(1089, 2098),
(1098, 2063),
(1024, 2102),
(1102, 2028),
(1066, 2081);

CREATE TABLE proj.customer_makes_review (
  customer_id INT,
  review_id INT,
  PRIMARY KEY (review_id),
  FOREIGN KEY (customer_id) REFERENCES proj.Customer(customer_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (review_id) REFERENCES proj.Review(review_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.customer_makes_review (customer_id, review_id) VALUES
(1007, 205),
(1032, 198),
(1078, 312),
(1056, 276),
(1123, 150),
(1089, 389),
(1098, 222),
(1024, 310),
(1102, 175),
(1066, 260);

CREATE TABLE proj.vehicle_has_rental (
  vehicle_id INT,
  rental_id INT,
  PRIMARY KEY (rental_id),
  FOREIGN KEY (vehicle_id) REFERENCES proj.Vehicle(vehicle_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id) VALUES
(3021, 1079),
(2987, 1037),
(3154, 1092),
(2890, 1056),
(3045, 1123),
(3112, 1048),
(2975, 1102),
(3128, 1086),
(3050, 1063),
(2903, 1117);

CREATE TABLE proj.vehicle_placed_location (
  vehicle_id INT,
  location_id INT,
  PRIMARY KEY (vehicle_id),
  FOREIGN KEY (vehicle_id) REFERENCES proj.Vehicle(vehicle_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (location_id) REFERENCES proj.Location(location_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.vehicle_placed_location (vehicle_id, location_id) VALUES
(3021, 34000),
(2987, 34100),
(3154, 34200),
(2890, 34300),
(3045, 34400),
(3112, 34500),
(2975, 34600),
(3128, 34700),
(3050, 34800),
(2903, 34900),
(3201, 34000),
(3202, 34100),
(3203, 34200),
(3204, 34300),
(3205, 34400),
(3206, 34500),
(3207, 34600),
(3208, 34700),
(3209, 34800),
(3210, 34900);

CREATE TABLE proj.vehicle_has_review (
  vehicle_id INT,
  review_id INT,
  PRIMARY KEY (review_id),
  FOREIGN KEY (vehicle_id) REFERENCES proj.Vehicle(vehicle_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (review_id) REFERENCES proj.Review(review_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.vehicle_has_review (vehicle_id, review_id) VALUES
(3021, 205),
(2987, 198),
(3154, 312),
(2890, 276),
(3045, 150),
(3112, 389),
(2975, 222),
(3128, 310),
(3050, 175),
(2903, 260);

CREATE TABLE proj.vehicle_has_maintenance (
  vehicle_id INT,
  maintenance_id INT,
  PRIMARY KEY (maintenance_id),
  FOREIGN KEY (vehicle_id) REFERENCES proj.Vehicle(vehicle_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (maintenance_id) REFERENCES proj.Maintenance(maintenance_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.vehicle_has_maintenance (vehicle_id, maintenance_id) VALUES
(3021, 1034),
(2987, 1019),
(3154, 1178),
(2890, 1007),
(3045, 1153),
(3112, 1098),
(2975, 1190),
(3128, 1076),
(3050, 1130),
(2903, 1112);

CREATE TABLE proj.rental_has_payment (
  rental_id INT,
  payment_id INT,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (payment_id) REFERENCES proj.Payment(payment_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.rental_has_payment (rental_id, payment_id) VALUES
(1079, 2057),
(1037, 2034),
(1092, 2089),
(1056, 2071),
(1123, 2045),
(1048, 2098),
(1102, 2063),
(1086, 2102),
(1063, 2028),
(1117, 2081);

CREATE TABLE proj.rental_arranges_employee (
  rental_id INT,
  employee_id INT,
  PRIMARY KEY (rental_id, employee_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (employee_id) REFERENCES proj.Employee(employee_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.rental_arranges_employee (rental_id, employee_id) VALUES
(1079, 1021),
(1079, 1033),
(1037, 1078),
(1092, 1045),
(1056, 1099),
(1123, 1082),
(1048, 1103),
(1102, 1056),
(1086, 1071),
(1117, 1068);

CREATE TABLE proj.rental_from_location (
  rental_id INT,
  location_id INT,
  PRIMARY KEY (rental_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (location_id) REFERENCES proj.Location(location_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.rental_from_location (rental_id, location_id) VALUES
(1079, 34000),
(1037, 34100),
(1092, 34200),
(1056, 34300),
(1123, 34400),
(1048, 34500),
(1102, 34600),
(1086, 34700),
(1063, 34800),
(1117, 34900);

CREATE TABLE proj.rental_has_review (
  rental_id INT,
  review_id INT,
  PRIMARY KEY (review_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (review_id) REFERENCES proj.Review(review_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.rental_has_review (rental_id, review_id) VALUES
(1079, 205),
(1037, 198),
(1092, 312),
(1056, 276),
(1123, 150),
(1048, 389),
(1102, 222),
(1086, 310),
(1063, 175),
(1117, 260);

CREATE TABLE proj.rental_has_insurance (
  rental_id INT,
  insurance_id INT,
  PRIMARY KEY (insurance_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (insurance_id) REFERENCES proj.Insurance(insurance_id)
    ON DELETE CASCADE ON UPDATE CASCADE
);
INSERT INTO proj.rental_has_insurance (rental_id, insurance_id) VALUES
(1079, 301),
(1037, 307),
(1092, 319),
(1056, 325),
(1123, 331),
(1048, 337),
(1102, 343),
(1086, 349),
(1063, 355),
(1117, 361);

CREATE TABLE proj.rental_has_discount (
  rental_id INT,
  discount_id INT,
  PRIMARY KEY (rental_id),
  FOREIGN KEY (rental_id) REFERENCES proj.Rental(rental_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (discount_id) REFERENCES proj.Discount(discount_id)
    ON DELETE SET NULL ON UPDATE CASCADE
);
INSERT INTO proj.rental_has_discount (rental_id, discount_id) VALUES
(1079, 2007),
(1037, 2011),
(1092, 2033),
(1056, 2045),
(1123, 2078),
(1048, 2099),
(1102, 2056),
(1086, 2087),
(1063, 2023),
(1117, 2101);

CREATE TABLE proj.payment_has_discount (
  payment_id INT,
  discount_id INT,
  PRIMARY KEY (payment_id),
  FOREIGN KEY (payment_id) REFERENCES proj.Payment(payment_id)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (discount_id) REFERENCES proj.Discount(discount_id)
    ON DELETE SET NULL ON UPDATE CASCADE
);
INSERT INTO proj.payment_has_discount (payment_id, discount_id) VALUES
(2057, 2007),
(2034, 2011),
(2089, 2033),
(2071, 2045),
(2045, 2078),
(2098, 2099),
(2063, 2056),
(2102, 2087),
(2028, 2023),
(2081, 2101);


DELIMITER //

CREATE TRIGGER trigger_1
BEFORE INSERT ON proj.Payment
FOR EACH ROW
BEGIN
  IF NEW.payment_amount >= 600 THEN
    SET NEW.payment_status = 'completed';
  ELSE
    SET NEW.payment_status = 'pending';
  END IF;
END;
//

DELIMITER ;

INSERT INTO proj.Payment (payment_id, payment_amount, payment_method)
VALUES
(3001, 500.00, 'cash'),     
(3002, 700.00, 'credit card'); 



DELIMITER //

CREATE TRIGGER trigger_2
AFTER INSERT ON proj.vehicle_has_rental
FOR EACH ROW
BEGIN
  UPDATE proj.Vehicle
  SET vehicle_status = 'rented'
  WHERE vehicle_id = NEW.vehicle_id;
END;
//

DELIMITER ;

INSERT INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type)
VALUES (5001, 'TR2025', 'Opel', 'Astra', 'Sedan', 'available', 105.00, 'Gas');



INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status)
VALUES (6001, '2025-04-10 09:00:00', '2025-04-15 09:00:00', 'active');

INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id)
VALUES (5001, 6001);







DELIMITER //

CREATE TRIGGER trigger_3
AFTER UPDATE ON proj.Rental
FOR EACH ROW
BEGIN
    IF NEW.rental_status = 'cancelled' THEN
        UPDATE proj.Vehicle
        SET vehicle_status = 'available'
        WHERE vehicle_id IN (
            SELECT vehicle_id
            FROM proj.vehicle_has_rental
            WHERE rental_id = NEW.rental_id
        );
    END IF;
END;
//

DELIMITER ;




INSERT INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type)
VALUES (5015, 'TR4356', 'BYD', 'Han', 'Sedan', 'rented', 100.00, 'Electric');

INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status)
VALUES (6442, '2025-05-01 10:00:00', '2025-05-05 10:00:00', 'active');

INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id)
VALUES (5015, 6442);



UPDATE proj.Rental
SET rental_status = 'cancelled'
WHERE rental_id = 6442;


SELECT vehicle_id, vehicle_status
FROM proj.Vehicle
WHERE vehicle_id = 5015;






DELIMITER //

CREATE TRIGGER trigger_4
AFTER INSERT ON proj.vehicle_has_maintenance
FOR EACH ROW
BEGIN
  UPDATE proj.Vehicle
  SET vehicle_status = (
    SELECT
      CASE
        WHEN m.maintenance_status = 'completed' THEN 'available'
        WHEN m.maintenance_status = 'in progress' THEN 'maintenance'
        ELSE vehicle_status
      END
    FROM proj.Maintenance m
    WHERE m.maintenance_id = NEW.maintenance_id
  )
  WHERE vehicle_id = NEW.vehicle_id;
END;
//

DELIMITER ;




INSERT INTO proj.Vehicle (vehicle_id, licence_plate, brand, model, segment, vehicle_status, vehicle_price, fuel_type)
VALUES (8001, 'TR8001', 'Hyundai', 'Elantra', 'Sedan', 'maintenance', 115.00, 'Gas');

INSERT INTO proj.Maintenance (maintenance_id, maintenance_cost, maintenance_status)
VALUES (9001, 130.00, 'completed');

INSERT INTO proj.vehicle_has_maintenance (vehicle_id, maintenance_id)
VALUES (8001, 9001);

SELECT vehicle_id, vehicle_status FROM proj.Vehicle WHERE vehicle_id = 8001;






DELIMITER //
CREATE PROCEDURE make_payment(
    IN p_customer_id INT,
    IN p_rental_id INT,
    IN p_amount DECIMAL(10,2),
    IN p_method VARCHAR(50),
    OUT p_payment_id INT
)
BEGIN
    DECLARE status_val VARCHAR(20);

    IF p_amount >= 600 THEN
        SET status_val = 'completed';
    ELSE
        SET status_val = 'pending';
    END IF;

    SET p_payment_id = (SELECT IFNULL(MAX(payment_id), 2000) + 1 FROM proj.Payment);

    INSERT INTO proj.Payment (payment_id, payment_amount, payment_method, payment_status)
    VALUES (p_payment_id, p_amount, p_method, status_val);

    INSERT INTO proj.customer_makes_payment (customer_id, payment_id)
    VALUES (p_customer_id, p_payment_id);

    INSERT INTO proj.rental_has_payment (rental_id, payment_id)
    VALUES (p_rental_id, p_payment_id);
END;
//
DELIMITER ;




DELIMITER //

CREATE PROCEDURE proj.submit_review (
    IN p_customer_id INT,
    IN p_vehicle_id INT,
    IN p_rating INT,
    OUT p_review_id INT
)
BEGIN
    SET p_review_id = (SELECT IFNULL(MAX(review_id), 100) + 1 FROM proj.Review);

    INSERT INTO proj.Review (review_id, rating, review_date)
    VALUES (p_review_id, p_rating, NOW());

    INSERT INTO proj.customer_makes_review (customer_id, review_id)
    VALUES (p_customer_id, p_review_id);

    INSERT INTO proj.vehicle_has_review (vehicle_id, review_id)
    VALUES (p_vehicle_id, p_review_id);
END;
//

DELIMITER ;



DELIMITER //

DROP PROCEDURE IF EXISTS proj.rent_vehicle //

CREATE PROCEDURE proj.rent_vehicle (
    IN p_customer_id INT,
    IN p_vehicle_id INT,
    IN p_start_date DATETIME,
    IN p_end_date DATETIME,
    OUT p_rental_id INT
)
BEGIN
    -- Create new rental record
    SET p_rental_id = (SELECT IFNULL(MAX(rental_id), 1000) + 1 FROM proj.Rental);

    -- Insert rental record
    INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status)
    VALUES (p_rental_id, p_start_date, p_end_date, 'active');

    -- Link customer with rental
    INSERT INTO proj.customer_has_rental (customer_id, rental_id)
    VALUES (p_customer_id, p_rental_id);

    -- Link vehicle with rental
    INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id)
    VALUES (p_vehicle_id, p_rental_id);

    -- Link customer with vehicle
    INSERT INTO proj.customer_rents_vehicle (customer_id, vehicle_id)
    VALUES (p_customer_id, p_vehicle_id);

    -- Update vehicle status
    UPDATE proj.Vehicle
    SET vehicle_status = 'rented'
    WHERE vehicle_id = p_vehicle_id;
END //

DELIMITER ;





DELIMITER //

CREATE PROCEDURE proj.add_vehicle_maintenance(
    IN p_vehicle_id INT,
    IN p_cost DECIMAL(10,2),
    IN p_status VARCHAR(20)
)
BEGIN
    DECLARE m_id INT;

    INSERT INTO proj.Maintenance (maintenance_cost, maintenance_status)
    VALUES (p_cost, p_status);

    SET m_id = LAST_INSERT_ID();

    INSERT INTO proj.vehicle_has_maintenance (vehicle_id, maintenance_id)
    VALUES (p_vehicle_id, m_id);

    IF p_status = 'completed' THEN
        UPDATE proj.Vehicle
        SET vehicle_status = 'available'
        WHERE vehicle_id = p_vehicle_id;
    ELSEIF p_status = 'in progress' THEN
        UPDATE proj.Vehicle
        SET vehicle_status = 'maintenance'
        WHERE vehicle_id = p_vehicle_id;
    END IF;
END;
//

DELIMITER ;



