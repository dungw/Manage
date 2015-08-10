ALTER TABLE `dc_equipment`
ADD COLUMN `unit_voltage`  varchar(10) NULL DEFAULT NULL AFTER `name`,
ADD COLUMN `unit_amperage`  varchar(10) NULL DEFAULT NULL AFTER `unit_voltage`,
ADD COLUMN `active`  int(3) NULL DEFAULT 1 COMMENT '0: inactive | 1:active' AFTER `unit_amperage`;

