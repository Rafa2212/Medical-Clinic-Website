
ALTER TABLE `patients` DROP FOREIGN KEY IF EXISTS `patients_ibfk_1`;
ALTER TABLE `doctors` DROP FOREIGN KEY IF EXISTS `doctors_ibfk_1`;

ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` 
  FOREIGN KEY (`user_id`) 
  REFERENCES `users` (`user_id`) 
  ON DELETE CASCADE;

ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` 
  FOREIGN KEY (`id_doctors`) 
  REFERENCES `doctors` (`id`) 
  ON DELETE CASCADE;

CREATE INDEX `idx_user_doctors` ON `doctors` (`user_id`); 