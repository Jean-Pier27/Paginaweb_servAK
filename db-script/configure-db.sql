CREATE DATABASE IF NOT EXISTS ak_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ak_limpieza;

DROP TABLE IF EXISTS services;
CREATE TABLE services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(120) NOT NULL,
  description TEXT NOT NULL,
  price DECIMAL(10,2) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS portfolio;
CREATE TABLE portfolio (
  id INT AUTO_INCREMENT PRIMARY KEY,
  type ENUM('image','video') NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  caption VARCHAR(255) NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  phone VARCHAR(40) NULL,
  email VARCHAR(180) NULL,
  message TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS settings;
CREATE TABLE settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  business_name VARCHAR(160) NOT NULL,
  hero_title VARCHAR(300) NOT NULL,
  hero_subtitle VARCHAR(400) NULL,
  address VARCHAR(240) NULL,
  whatsapp VARCHAR(60) NULL,
  facebook VARCHAR(200) NULL,
  instagram VARCHAR(200) NULL,
  tiktok VARCHAR(200) NULL,
  yape VARCHAR(100) NULL,
  plin VARCHAR(100) NULL
);

DROP TABLE IF EXISTS admins;
CREATE TABLE admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(80) UNIQUE NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO settings (business_name, hero_title, hero_subtitle, address, whatsapp, facebook, instagram, tiktok, yape, plin) VALUES
('SERVICIO DE LIMPIEZA AK',
 'Limpieza y desinfección profesional\nde tapicerías, muebles, colchones y vehículos',
 'Calidad, eficiencia y confianza. Recuperamos el aspecto y la higiene de tus espacios con equipos y productos de grado profesional',
 'Lima, Perú',
 '+51 996 792 766',
 'https://www.facebook.com/profile.php?id=61558376477467',
 'https://www.instagram.com/service_limpieza_ak',
 'https://www.tiktok.com/@service_limpieza_ak',
 '+51 996 792 766',
 '+51 996 792 766'
);

INSERT INTO services (title, description, price) VALUES
('Limpieza de casas', 'Servicio completo para hogares con insumos incluidos.', 120.00),
('Limpieza de oficinas', 'Mantenimiento y limpieza profunda para oficinas.', 250.00),
('Pulido de pisos', 'Pulido y abrillantado con maquinaria profesional.', 180.00);

INSERT INTO portfolio (type, file_path, caption) VALUES
('image','assets/img/3.jpg','Imagen principal'),
('image','assets/img/logo.png','Logo');
