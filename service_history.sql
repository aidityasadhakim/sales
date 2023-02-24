DROP TABLE IF EXISTS `service_history`;
CREATE TABLE `service_history` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `tipe_hp` varchar(200) NOT NULL,
  `kerusakan` varchar(200) NOT NULL,
  `kelengkapan` varchar(200) NOT NULL,
  `keterangan` varchar(200),
  `penerima` varchar(200) NOT NULL,
  `status` varchar(100) NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
);