ALTER TABLE `dc_equipment_status` DROP FOREIGN KEY `FkEquipment`;
ALTER TABLE `dc_equipment_status` DROP INDEX `FkEquipment`;
ALTER TABLE `power_status` DROP FOREIGN KEY `FkItem`;
ALTER TABLE `power_status` DROP INDEX `FkItem`;
ALTER TABLE `sensor_status` DROP FOREIGN KEY `FkSensor`;
ALTER TABLE `sensor_status` DROP INDEX `FkSensor`;
ALTER TABLE `station` DROP FOREIGN KEY `FkArea`;
ALTER TABLE `station` DROP FOREIGN KEY `FkCenter`;
ALTER TABLE `station` DROP INDEX `FkCenter`;
ALTER TABLE `station` DROP INDEX `FkArea`;
ALTER TABLE `station` DROP INDEX `UniqueCode`;
ALTER TABLE `station` DROP INDEX `code`;
ALTER TABLE `warning_picture` DROP FOREIGN KEY `PkWarning`;
ALTER TABLE `warning_picture` DROP INDEX `PkWarning`;

