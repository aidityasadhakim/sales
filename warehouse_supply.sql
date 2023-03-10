DROP TABLE IF EXISTS `warehouse_supply`;
CREATE TABLE `warehouse_supply` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `stockInside` int(30) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY (`item_id`)
);

INSERT INTO warehouse_supply ( item_id, stockInside, updated_at )
SELECT  items.id, 0, DATE(NOW())
FROM    items;