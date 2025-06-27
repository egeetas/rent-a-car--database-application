DELIMITER //

CREATE TRIGGER trigger_4
AFTER INSERT ON proj.vehicle_has_maintenance
FOR EACH ROW
BEGIN
    DECLARE status_val VARCHAR(20);
    SELECT maintenance_status INTO status_val
    FROM proj.Maintenance
    WHERE maintenance_id = NEW.maintenance_id;

    IF status_val = 'completed' THEN
        UPDATE proj.Vehicle
        SET vehicle_status = 'available'
        WHERE vehicle_id = NEW.vehicle_id;
    END IF;
END;
//

DELIMITER ; 