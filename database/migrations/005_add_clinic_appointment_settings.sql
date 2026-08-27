ALTER TABLE clinics
    ADD COLUMN appointment_enabled TINYINT(1) NOT NULL DEFAULT 0 AFTER status,
    ADD COLUMN appointment_slot_quota SMALLINT UNSIGNED NOT NULL DEFAULT 25 AFTER appointment_enabled;
