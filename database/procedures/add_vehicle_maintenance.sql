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