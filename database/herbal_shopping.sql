CREATE DATABASE IF NOT EXISTS herbal_shopping CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE herbal_shopping;

CREATE TABLE IF NOT EXISTS customers (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE,
 username VARCHAR(60) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS admins (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 username VARCHAR(60) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS herbs (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 category VARCHAR(80) NOT NULL,
 short_description VARCHAR(255) NOT NULL,
 description TEXT NOT NULL,
 image_url VARCHAR(500) NOT NULL,
 price DECIMAL(10,2) NOT NULL,
 unit VARCHAR(40) NOT NULL DEFAULT '100 g',
 stock INT NOT NULL DEFAULT 0,
 is_active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS orders (
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_id INT NOT NULL,
 total_amount DECIMAL(10,2) NOT NULL,
 address TEXT NOT NULL,
 phone VARCHAR(30) NOT NULL,
 status ENUM('Pending','Processing','Shipped','Delivered','Cancelled') DEFAULT 'Pending',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_orders_customer FOREIGN KEY (customer_id) REFERENCES customers(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS order_items (
 id INT AUTO_INCREMENT PRIMARY KEY,
 order_id INT NOT NULL,
 herb_id INT NOT NULL,
 quantity INT NOT NULL,
 unit_price DECIMAL(10,2) NOT NULL,
 CONSTRAINT fk_items_order FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
 CONSTRAINT fk_items_herb FOREIGN KEY (herb_id) REFERENCES herbs(id)
) ENGINE=InnoDB;

INSERT INTO herbs(name,category,short_description,description,image_url,price,unit,stock) VALUES
('Turmeric','Roots & spices','Earthy golden turmeric powder.','Turmeric is a familiar kitchen spice with a warm, earthy flavour. Store in a cool, dry place away from direct sunlight.','https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=900&q=85',95,'100 g',40),
('Dried Tulsi','Leaves','Aromatic dried holy basil leaves.','Tulsi is an aromatic herb used in traditional food and beverage preparations. Keep sealed in a dry container.','https://images.unsplash.com/photo-1501004318641-b39e6451bec6?auto=format&fit=crop&w=900&q=85',80,'50 g',35),
('Ginger','Roots & spices','A warming kitchen essential.','Ginger has a distinctive warm, peppery flavour and is used in many everyday recipes. Store fresh ginger in a cool place.','https://images.unsplash.com/photo-1615485500704-8e990f9900f2?auto=format&fit=crop&w=900&q=85',65,'250 g',50),
('Neem Leaves','Leaves','Carefully dried neem leaves.','Neem is a botanical traditionally known in South Asian plant references. Use only for its intended labelled purpose and seek professional advice before medicinal use.','https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?auto=format&fit=crop&w=900&q=85',75,'50 g',20),
('Moringa Powder','Powders','Fine green moringa leaf powder.','Moringa leaf powder has a mild green flavour and is used in food preparations. Keep the pack sealed after opening.','https://images.unsplash.com/photo-1540420773420-3366772f4999?auto=format&fit=crop&w=900&q=85',140,'100 g',30),
('Amla','Fruits','Tangy dried amla pieces.','Amla is a sour fruit used in a range of culinary preparations. Store in an airtight container.','https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?auto=format&fit=crop&w=900&q=85',110,'100 g',25),
('Cinnamon','Barks & spices','Sweet and fragrant cinnamon sticks.','Cinnamon is a fragrant spice used in sweet and savoury recipes. Store in a dry, airtight container.','https://images.unsplash.com/photo-1603909223429-69bb7101f420?auto=format&fit=crop&w=900&q=85',120,'100 g',25),
('Hibiscus','Flowers','Dried hibiscus petals.','Hibiscus petals have a bright colour and tart flavour and are commonly used in infusions. Keep away from moisture.','https://images.unsplash.com/photo-1490750967868-88aa4486c946?auto=format&fit=crop&w=900&q=85',90,'50 g',20),
('Fenugreek','Seeds','A classic aromatic seed.','Fenugreek seeds have a slightly bitter, maple-like aroma and are used in spice blends.','https://images.unsplash.com/photo-1596040033229-a9821ebd058d?auto=format&fit=crop&w=900&q=85',55,'100 g',45),
('Rose Petals','Flowers','Fragrant dried rose petals.','Dried rose petals are used for culinary decoration and aromatic preparations. Store in an airtight container.','https://images.unsplash.com/photo-1494972308805-463bc619d34e?auto=format&fit=crop&w=900&q=85',130,'50 g',18),
('Brahmi','Leaves','Dried brahmi botanical leaves.','Brahmi is a traditional botanical name used in regional herb references. Product information is not a recommendation for treatment.','https://images.unsplash.com/photo-1530968464165-7a1861cbaf9f?auto=format&fit=crop&w=900&q=85',105,'50 g',16),
('Ashwagandha','Roots','Traditional dried ashwagandha root.','Ashwagandha is a plant used in some traditional preparations. It can interact with medicines and may not be suitable for everyone; seek qualified advice.','https://images.unsplash.com/photo-1547887538-e3a2f32cb1cc?auto=format&fit=crop&w=900&q=85',160,'100 g',15);
