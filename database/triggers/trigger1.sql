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