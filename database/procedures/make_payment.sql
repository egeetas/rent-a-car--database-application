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