CREATE TABLE `billing_entity` (
  `billing_entity_id` MEDIUMINT(9) NOT NULL AUTO_INCREMENT,
  `billing_entity_name` VARCHAR(100) COLLATE latin1_swedish_ci NOT NULL,
  `company_id` MEDIUMINT(9) NOT NULL,
  `alias` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`billing_entity_id`),
  UNIQUE KEY `alias` (`alias`),
  UNIQUE KEY `alias_2` (`alias`),
  KEY `company_id` (`company_id`)
)ENGINE=InnoDB
AUTO_INCREMENT=3 AVG_ROW_LENGTH=8192 CHARACTER SET 'latin1' COLLATE 'latin1_swedish_ci';
COMMIT;



/* Data for the `billing_entity` table  (Records 1 - 2) */

INSERT INTO `billing_entity` (`billing_entity_id`, `billing_entity_name`, `company_id`, `alias`) VALUES 
  (1, 'Incwell LLC', 1983, 'LLC'),
  (2, 'Incwell SL', 1985, 'SL');


