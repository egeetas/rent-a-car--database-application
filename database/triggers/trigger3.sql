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