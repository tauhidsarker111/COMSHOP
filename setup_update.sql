-- ============================================================
--  Task 4 UPDATE Script — run in phpMyAdmin on database: wti
--  Safe to run even if tables already exist
-- ============================================================

USE wti;

-- Add extra spec columns to products (if not already there)
ALTER TABLE products
    ADD COLUMN IF NOT EXISTS brand       VARCHAR(100) DEFAULT 'Generic',
    ADD COLUMN IF NOT EXISTS category    VARCHAR(100) DEFAULT 'General',
    ADD COLUMN IF NOT EXISTS description TEXT,
    ADD COLUMN IF NOT EXISTS image_file  VARCHAR(255) DEFAULT '';

-- Make sure orders table has username column (not user_id) matching our code
ALTER TABLE orders MODIFY COLUMN username VARCHAR(100) NULL;

-- ── Clear old sample products and insert rich ones ────────────────
DELETE FROM order_items WHERE order_id IN (SELECT id FROM orders);
DELETE FROM orders;
DELETE FROM reviews;
DELETE FROM products;

INSERT INTO products (name, brand, category, price, stock, description, image_file) VALUES
('Intel Core i9-14900K Processor',  'Intel',   'Processor',
 589.99, 8,
 '24 cores (8P+16E), 6.0 GHz Max Turbo, 36MB Cache, LGA1700 socket, 125W TDP. Ideal for extreme gaming and content creation.',
 ''),

('AMD Ryzen 9 7950X Processor',     'AMD',     'Processor',
 499.99, 6,
 '16 cores / 32 threads, 5.7 GHz Max Boost, 64MB L3 Cache, AM5 socket, 170W TDP. Best for multithreaded workloads.',
 ''),

('NVIDIA GeForce RTX 4090',         'NVIDIA',  'Graphics Card',
 1599.99, 4,
 '16384 CUDA cores, 24GB GDDR6X VRAM, 384-bit bus, 2.52 GHz boost clock. Top-tier 4K gaming and AI rendering.',
 ''),

('NVIDIA GeForce RTX 4070 Ti',      'NVIDIA',  'Graphics Card',
 799.99, 7,
 '7680 CUDA cores, 12GB GDDR6X, 192-bit bus, 2.61 GHz boost. Excellent 1440p and 4K gaming performance.',
 ''),

('AMD Radeon RX 7900 XTX',          'AMD',     'Graphics Card',
 899.99, 5,
 '12288 stream processors, 24GB GDDR6, 384-bit bus, 355W TDP. AMD flagship for 4K gaming.',
 ''),

('Corsair Vengeance 32GB DDR5 RAM', 'Corsair', 'RAM',
 129.99, 20,
 '2×16GB kit, DDR5-6000 MHz, CL36, 1.35V, XMP 3.0 compatible. Blazing fast dual-channel memory.',
 ''),

('G.Skill Trident Z5 64GB DDR5',    'G.Skill', 'RAM',
 219.99, 10,
 '2×32GB kit, DDR5-6400 MHz, CL32, Intel XMP 3.0. Massive capacity for workstations and servers.',
 ''),

('Samsung 990 Pro 1TB NVMe SSD',    'Samsung', 'Storage',
 109.99, 18,
 'PCIe 4.0 M.2, Read 7450 MB/s, Write 6900 MB/s. Ultra-fast storage for OS and games.',
 ''),

('Seagate Barracuda 4TB HDD',       'Seagate', 'Storage',
 79.99, 25,
 '3.5" SATA 6Gb/s, 5400 RPM, 256MB cache. Reliable bulk storage for media and backups.',
 ''),

('ASUS ROG Swift 27" 4K Monitor',   'ASUS',    'Monitor',
 649.99, 6,
 '27" IPS, 3840×2160, 144Hz, 1ms GTG, HDR600, G-Sync Compatible, USB-C. Premium gaming display.',
 ''),

('LG UltraGear 32" QHD 165Hz',      'LG',      'Monitor',
 349.99, 9,
 '32" IPS, 2560×1440, 165Hz, 1ms, HDR10, AMD FreeSync Premium. Smooth 1440p gaming.',
 ''),

('ASUS ROG Strix Z790-E Motherboard','ASUS',   'Motherboard',
 449.99, 7,
 'LGA1700, DDR5, PCIe 5.0, 4×M.2, Wi-Fi 6E, 2.5G LAN, USB4. Premium Intel Z790 board.',
 ''),

('MSI MAG X670E Tomahawk',          'MSI',     'Motherboard',
 299.99, 8,
 'AM5, DDR5, PCIe 5.0, 3×M.2, 2.5G LAN, USB 3.2 Gen2. Solid AMD AM5 platform.',
 ''),

('Corsair RM1000x PSU',             'Corsair', 'Power Supply',
 179.99, 12,
 '1000W, 80+ Gold certified, fully modular, 135mm fan, 10-year warranty. Quiet and efficient.',
 ''),

('Noctua NH-D15 CPU Cooler',        'Noctua',  'Cooling',
 99.99, 14,
 'Dual-tower air cooler, 2× 140mm fans, 165mm height, 250W TDP, supports LGA1700/AM5.',
 '');
