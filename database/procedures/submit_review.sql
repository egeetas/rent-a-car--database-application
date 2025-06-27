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