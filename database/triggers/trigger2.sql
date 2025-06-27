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