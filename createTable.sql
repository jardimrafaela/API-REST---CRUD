CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `completed` boolean NOT NULL,
  `createdAt` date NOT NULL,
  `updatedAt` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `products` ( `description`, `completed`, `createdAt`, `updatedAt`) VALUES
('Ford Ka', '0',  now(),now()),
('BMW 360', '0',  now(),now()),
('Fiat Premium', '0', now(),now()),
('VolksWagen Gol', '1', now(),now()),
('Renault Kwid', '1',  now(),now()),
('Renault Duster', '1',  now(),now()),
('Porche Cayenne', '1',  now(),now())