DELIMITER //

CREATE PROCEDURE proj.rent_vehicle (
    IN p_customer_id INT,
    IN p_vehicle_id INT,
    IN p_start_date DATETIME,
    IN p_end_date DATETIME,
    IN p_payment_amount DECIMAL(10,2),
    IN p_payment_method VARCHAR(50),
    OUT p_rental_id INT
)
BEGIN
    DECLARE payment_status_val VARCHAR(20);
    DECLARE new_payment_id INT;

    IF p_payment_amount >= 600 THEN
        SET payment_status_val = 'completed';
    ELSE
        SET payment_status_val = 'pending';
    END IF;

    SET new_payment_id = (SELECT IFNULL(MAX(payment_id), 2000) + 1 FROM proj.Payment);

    INSERT INTO proj.Payment (payment_id, payment_amount, payment_method, payment_status)
    VALUES (new_payment_id, p_payment_amount, p_payment_method, payment_status_val);

    SET p_rental_id = (SELECT IFNULL(MAX(rental_id), 1000) + 1 FROM proj.Rental);

    INSERT INTO proj.Rental (rental_id, start_date, end_date, rental_status)
    VALUES (p_rental_id, p_start_date, p_end_date, 'active');

    INSERT INTO proj.customer_has_rental (customer_id, rental_id)
    VALUES (p_customer_id, p_rental_id);

    INSERT INTO proj.vehicle_has_rental (vehicle_id, rental_id)
    VALUES (p_vehicle_id, p_rental_id);

    INSERT INTO proj.customer_rents_vehicle (customer_id, vehicle_id)
    VALUES (p_customer_id, p_vehicle_id);

    INSERT INTO proj.customer_makes_payment (customer_id, payment_id)
    VALUES (p_customer_id, new_payment_id);

    INSERT INTO proj.rental_has_payment (rental_id, payment_id)
    VALUES (p_rental_id, new_payment_id);

    UPDATE proj.Vehicle
    SET vehicle_status = 'rented'
    WHERE vehicle_id = p_vehicle_id;
END;
//

DELIMITER ; 