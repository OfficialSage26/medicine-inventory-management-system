USE medicine_inventory;

INSERT INTO categories (name) VALUES
  ('Antibiotic'),
  ('Painkiller'),
  ('Supplement');

INSERT INTO medicines (name, category_id, quantity, reorder_level, expiry_date) VALUES
  ('Amoxicillin 500mg', 1, 5, 10, DATE_ADD(CURDATE(), INTERVAL 20 DAY)),
  ('Ciprofloxacin 250mg', 1, 15, 10, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Paracetamol 500mg', 2, 50, 10, DATE_ADD(CURDATE(), INTERVAL 400 DAY)),
  ('Ibuprofen 200mg', 2, 8, 10, DATE_ADD(CURDATE(), INTERVAL 10 DAY)),
  ('Diclofenac 50mg', 2, 3, 5, DATE_ADD(CURDATE(), INTERVAL 5 DAY)),
  ('Vitamin C 1000mg', 3, 2, 5, NULL),
  ('Calcium + Vitamin D', 3, 25, 10, DATE_ADD(CURDATE(), INTERVAL 60 DAY)),
  ('Zinc Sulfate', 3, 6, 10, DATE_ADD(CURDATE(), INTERVAL 25 DAY));
