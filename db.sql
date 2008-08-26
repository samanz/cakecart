# CakeCart Database

# Categories Table

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NULL default NULL,
	`parent_id` INT(11) UNSIGNED default '0',
	`order` INT(3) default '0',
	`image` VARCHAR(50) NULL default NULL,
	PRIMARY KEY  (`id`),
  KEY `parent_id` (`parent_id`)
);

# Category test data 

INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (1, 'Telescopes', 0, 'telescope.jpg', 0);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (2, 'Binoculars', 0 , 'binos.jpg', 1);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (3, 'Accessories', 0, 'access.jpg', 2);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (4, 'Reflecting', 1, 'access.jpg', 2);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (5, 'Lenses', 3, 'lens.jpg', 1);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (6, 'Celestron', 5, 'celestron.jpg', 1);
INSERT INTO categories (`id`, `name`, `parent_id`, `image`, `order`)
	VALUES (7, 'Refracting', 1, 'refract.jpg', 1);

# Products table

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(225) NOT NULL,
	`model` VARCHAR(50) NULL,
	`category_id` INT(11) UNSIGNED NOT NULL,
	`order` INT(3) default '0',
	`image` VARCHAR(50) NULL default NULL,
	`description` TEXT NULL default NULL,
	`price` VARCHAR(20) NOT NULL default '0',
	`created` DATETIME default NULL,
	`modified` DATETIME default NULL,
	`pounds` INT(5) default '0',
	`ounces` INT(5) default '0',
	`status` ENUM('0','1','2') default `1`,
	PRIMARY KEY  (`id`),
	FOREIGN KEY (`category_id`) REFERENCES categories(id)
);

# Products test data

INSERT INTO products (`id`, `name`, `category_id`, `price`, `created`, `pounds`, `ounces`)
	VALUES (1, 'Celestron AstroMaster 114 EQ Reflector Telescope', 4, '149.99', NOW(), 2, 0);
INSERT INTO products (`id`, `name`, `image`, `description`, `category_id`, `price`, `created`)
	VALUES (2, 'Meade DS-2130LNT Reflector Telescope with LNT AutoAlign Technology', 'meade2130.jpg', '<p>
     <strong>Meade DS-2130ATS-LNT?</strong>
     127mm (5.1-inch) Altazimuth Reflector Telescope
  </p>
  <p>
     The DS-2130ATS-LNT is a fully equipped telescope. Its on-board computer knows the night sky. After a short alignment procedure, your telescope will be ready to take you on a tour of the universe. You will see more objects in one night than Galileo saw in a lifetime. See planets like Saturn and Jupiter, star clusters, nebulae, galaxies, and more.
  </p>
  <ul>
     <li>
       <strong>Large 127mm Aperture</strong><br></span><span class="text">Captures more light for brighter images and greater detail (469% more light than a 60mm telescope)
     </li>
     <li>
        <strong>2Premium 1.25-inch super Plössl eyepieces</strong><br></span><span class="text">For superior long eye relief and an expansive wide visual field
     </li>
     <li>
        <strong>SmartFinder</strong><br></span><span class="text">Electronic level sensor, electronic magnetic north sensor, high-precision internal clock, and red-dot projection finder all work together to get you aligned with the heavens
     </li>
     <li>
     <strong>AutoStar Suite Astronomer Edition Software</strong>
        Amazing planetarium software and instructional video will teach you the night sky and how to use your telescope
     </li>
     <li>
       <strong>Assembles in Minutes</strong>
        Includes everything you need to explore your universe
     </li>
  </ul>', 4, '399.99', NOW());
INSERT INTO products (`id`, `name`, `category_id`, `price`, `created`, `pounds`, `ounces`)
	VALUES (3, 'Meade DS-2080LNT Refractor Telescope with LNT AutoAlign Technology', 4, '349.00', NOW(), `pounds`, `ounces`);

# Cart Table

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`session` VARCHAR(225) NOT NULL,
	`created` DATETIME default null,
	PRIMARY KEY (`id`)
);

# Cart Items Table

DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`cart_id` INT(11) UNSIGNED NOT NULL,
	`product_id` INT(11) UNSIGNED NOT NULL,
	`price` VARCHAR(50) NOT NULL,
	`quantity` INT(11) NOT NULL,
	`created` DATETIME default NULL,
	`modified` DATETIME default NULL,
	PRIMARY KEY (`id`),
	FOREIGN KEY (`cart_id`) REFERENCES carts(`id`),
	FOREIGN KEY (`product_id`) REFERENCES products(`id`)
);

# Orders Table

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`first` VARCHAR(30) NOT NULL,
	`last` VARCHAR(50) NOT NULL,
	`company` VARCHAR(100) NOT NULL,
	`address` VARCHAR(225) NOT NULL,
	`address2` VARCHAR(225) NOT NULL,
	`city` VARCHAR(225) NOT NULL,
	`state` VARCHAR(2) NOT NULL,
	`zip` INT(5) NOT NULL,
	`shipping` VARCHAR(50) NOT NULL,
	`tax` VARCHAR(50) NOT NULL,
	`paid` ENUM ('0', '1') NOT NULL default '0',
	`shipping_method` VARCHAR(60) NOT NULL,
	`payment_method` INT(2) NOT NULL,
	`created` DATETIME default NULL,
	`status` int(2) default `0`,
	PRIMARY KEY (`id`)
);

# Order Items Table

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
	`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	`order_id` INT(11) UNSIGNED NOT NULL,
	`product_id` INT(11) UNSIGNED NOT NULL,
	`price` VARCHAR(50) NOT NULL,
	`quantity` INT(11) NOT NULL,
	PRIMARY KEY (`id`)
);