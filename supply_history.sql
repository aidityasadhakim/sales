DROP TABLE IF EXISTS `supply_history`;
CREATE TABLE `supply_history` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `warehouse_id` int(11) NOT NULL,
  `qty` int(30) NOT NULL,
  `status` varchar(200) NOT NULL,
  `keterangan` varchar(200),
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`warehouse_id`)
);