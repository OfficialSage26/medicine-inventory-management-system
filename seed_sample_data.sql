USE medicine_inventory;

-- Insert Categories (25 categories)
INSERT INTO categories (name) VALUES
  ('Antibiotic'),
  ('Painkiller'),
  ('Supplement'),
  ('Antiseptic'),
  ('Antihypertensive'),
  ('Antidiabetic'),
  ('Antiviral'),
  ('Vaccine'),
  ('Antifungal'),
  ('Antacid'),
  ('Antiemetic'),
  ('Antidepressant'),
  ('Antihistamine'),
  ('Steroid'),
  ('Respiratory'),
  ('Dermatological'),
  ('Gastrointestinal'),
  ('Cardiac'),
  ('Neurological'),
  ('Pediatric'),
  ('Ophthalmic'),
  ('Otic'),
  ('Anticoagulant'),
  ('Muscle Relaxant'),
  ('Hormonal'),
  ('Immunosuppressant'),
  ('Antiparasitic'),
  ('Urological'),
  ('Hematologic'),
  ('Anesthetic');

-- Insert Medicines (220 medicines)
INSERT INTO medicines (name, category_id, quantity, reorder_level, expiry_date) VALUES
  -- Antibiotics (1)
  ('Amoxicillin 500mg', 1, 5, 10, DATE_ADD(CURDATE(), INTERVAL 20 DAY)),
  ('Amoxicillin 250mg', 1, 45, 20, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Ciprofloxacin 250mg', 1, 15, 10, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Ciprofloxacin 500mg', 1, 32, 15, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Azithromycin 500mg', 1, 28, 15, DATE_ADD(CURDATE(), INTERVAL 150 DAY)),
  ('Azithromycin 250mg', 1, 41, 20, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Doxycycline 100mg', 1, 36, 18, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Clarithromycin 500mg', 1, 19, 12, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Cephalexin 500mg', 1, 55, 25, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Levofloxacin 500mg', 1, 24, 15, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Metronidazole 400mg', 1, 48, 20, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Clindamycin 300mg', 1, 17, 12, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('Moxifloxacin 400mg', 1, 8, 10, DATE_ADD(CURDATE(), INTERVAL 45 DAY)),
  ('Cefixime 200mg', 1, 31, 18, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Trimethoprim-Sulfamethoxazole', 1, 22, 15, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  
  -- Painkillers (2)
  ('Paracetamol 500mg', 2, 50, 10, DATE_ADD(CURDATE(), INTERVAL 400 DAY)),
  ('Paracetamol 650mg', 2, 78, 30, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  ('Ibuprofen 200mg', 2, 8, 10, DATE_ADD(CURDATE(), INTERVAL 10 DAY)),
  ('Ibuprofen 400mg', 2, 62, 25, DATE_ADD(CURDATE(), INTERVAL 320 DAY)),
  ('Diclofenac 50mg', 2, 3, 5, DATE_ADD(CURDATE(), INTERVAL 5 DAY)),
  ('Diclofenac 75mg SR', 2, 44, 20, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  ('Naproxen 500mg', 2, 29, 15, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Aspirin 100mg', 2, 88, 40, DATE_ADD(CURDATE(), INTERVAL 450 DAY)),
  ('Tramadol 50mg', 2, 34, 18, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Codeine 30mg', 2, 16, 12, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  ('Meloxicam 15mg', 2, 27, 15, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Celecoxib 200mg', 2, 19, 12, DATE_ADD(CURDATE(), INTERVAL 130 DAY)),
  ('Etoricoxib 90mg', 2, 22, 15, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  
  -- Supplements (3)
  ('Vitamin C 1000mg', 3, 2, 5, NULL),
  ('Vitamin C 500mg', 3, 65, 30, DATE_ADD(CURDATE(), INTERVAL 400 DAY)),
  ('Calcium + Vitamin D', 3, 25, 10, DATE_ADD(CURDATE(), INTERVAL 60 DAY)),
  ('Zinc Sulfate', 3, 6, 10, DATE_ADD(CURDATE(), INTERVAL 25 DAY)),
  ('Multivitamin Complex', 3, 72, 35, DATE_ADD(CURDATE(), INTERVAL 380 DAY)),
  ('Vitamin D3 1000 IU', 3, 41, 20, DATE_ADD(CURDATE(), INTERVAL 290 DAY)),
  ('Vitamin B Complex', 3, 58, 25, DATE_ADD(CURDATE(), INTERVAL 330 DAY)),
  ('Omega-3 Fish Oil', 3, 33, 18, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  ('Iron + Folic Acid', 3, 47, 22, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Magnesium 400mg', 3, 24, 15, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Biotin 10000mcg', 3, 19, 12, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Coenzyme Q10', 3, 14, 10, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  
  -- Antiseptics (4)
  ('Chlorhexidine Solution', 4, 18, 10, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Povidone-Iodine Ointment', 4, 9, 8, DATE_ADD(CURDATE(), INTERVAL 45 DAY)),
  ('Povidone-Iodine Solution', 4, 28, 15, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Hydrogen Peroxide 3%', 4, 35, 18, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Isopropyl Alcohol 70%', 4, 52, 25, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  ('Benzalkonium Chloride', 4, 21, 12, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  
  -- Antihypertensives (5)
  ('Lisinopril 10mg', 5, 60, 30, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Lisinopril 5mg', 5, 44, 25, DATE_ADD(CURDATE(), INTERVAL 230 DAY)),
  ('Amlodipine 5mg', 5, 18, 25, DATE_ADD(CURDATE(), INTERVAL 25 DAY)),
  ('Amlodipine 10mg', 5, 67, 30, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Losartan 50mg', 5, 71, 35, DATE_ADD(CURDATE(), INTERVAL 310 DAY)),
  ('Telmisartan 40mg', 5, 39, 20, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  ('Atenolol 50mg', 5, 48, 24, DATE_ADD(CURDATE(), INTERVAL 260 DAY)),
  ('Metoprolol 50mg', 5, 33, 18, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  ('Bisoprolol 5mg', 5, 26, 15, DATE_ADD(CURDATE(), INTERVAL 150 DAY)),
  ('Enalapril 10mg', 5, 42, 22, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  
  -- Antidiabetics (6)
  ('Metformin 500mg', 6, 120, 50, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Metformin 850mg', 6, 88, 40, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Gliclazide 80mg', 6, 40, 30, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Glimepiride 2mg', 6, 54, 28, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Insulin Glargine Vial', 6, 25, 20, DATE_ADD(CURDATE(), INTERVAL 15 DAY)),
  ('Insulin Aspart Vial', 6, 18, 15, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
  ('Sitagliptin 100mg', 6, 31, 18, DATE_ADD(CURDATE(), INTERVAL 185 DAY)),
  ('Empagliflozin 10mg', 6, 23, 15, DATE_ADD(CURDATE(), INTERVAL 145 DAY)),
  ('Pioglitazone 30mg', 6, 19, 12, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  
  -- Antivirals (7)
  ('Oseltamivir 75mg', 7, 12, 10, DATE_ADD(CURDATE(), INTERVAL 40 DAY)),
  ('Favipiravir 200mg', 7, 6, 8, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
  ('Acyclovir 400mg', 7, 27, 15, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Valacyclovir 500mg', 7, 19, 12, DATE_ADD(CURDATE(), INTERVAL 135 DAY)),
  ('Remdesivir Injection', 7, 8, 10, DATE_ADD(CURDATE(), INTERVAL 60 DAY)),
  
  -- Vaccines (8)
  ('Influenza Vaccine', 8, 35, 20, DATE_ADD(CURDATE(), INTERVAL 70 DAY)),
  ('Hepatitis B Vaccine', 8, 5, 10, DATE_ADD(CURDATE(), INTERVAL 5 DAY)),
  ('Pneumococcal Vaccine', 8, 12, 10, DATE_ADD(CURDATE(), INTERVAL 50 DAY)),
  ('Tetanus Toxoid', 8, 24, 15, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('MMR Vaccine', 8, 16, 12, DATE_ADD(CURDATE(), INTERVAL 65 DAY)),
  ('HPV Vaccine', 8, 9, 8, DATE_ADD(CURDATE(), INTERVAL 40 DAY)),
  
  -- Antifungals (9)
  ('Clotrimazole Cream 1%', 9, 14, 10, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  ('Fluconazole 150mg', 9, 22, 12, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('Terbinafine 250mg', 9, 18, 12, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Miconazole Cream', 9, 26, 15, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Itraconazole 100mg', 9, 15, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  
  -- Antacids (10)
  ('Omeprazole 20mg', 10, 80, 30, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Omeprazole 40mg', 10, 45, 22, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  ('Ranitidine 150mg', 10, 0, 10, DATE_SUB(CURDATE(), INTERVAL 10 DAY)),
  ('Pantoprazole 40mg', 10, 63, 28, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Esomeprazole 40mg', 10, 37, 20, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Lansoprazole 30mg', 10, 29, 16, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Aluminum Hydroxide', 10, 42, 20, DATE_ADD(CURDATE(), INTERVAL 320 DAY)),
  
  -- Antiemetics (11)
  ('Ondansetron 8mg', 11, 16, 12, DATE_ADD(CURDATE(), INTERVAL 12 DAY)),
  ('Ondansetron 4mg', 11, 33, 18, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Metoclopramide 10mg', 11, 28, 15, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Domperidone 10mg', 11, 41, 20, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  
  -- Antidepressants (12)
  ('Sertraline 50mg', 12, 44, 20, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  ('Sertraline 100mg', 12, 31, 18, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Amitriptyline 25mg', 12, 11, 10, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('Fluoxetine 20mg', 12, 38, 20, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Escitalopram 10mg', 12, 27, 15, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  ('Venlafaxine 75mg', 12, 19, 12, DATE_ADD(CURDATE(), INTERVAL 135 DAY)),
  ('Duloxetine 30mg', 12, 22, 14, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  
  -- Antihistamines (13)
  ('Cetirizine 10mg', 13, 22, 15, DATE_ADD(CURDATE(), INTERVAL 60 DAY)),
  ('Loratadine 10mg', 13, 35, 18, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Fexofenadine 120mg', 13, 29, 16, DATE_ADD(CURDATE(), INTERVAL 185 DAY)),
  ('Levocetirizine 5mg', 13, 41, 20, DATE_ADD(CURDATE(), INTERVAL 230 DAY)),
  ('Diphenhydramine 25mg', 13, 18, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Chlorpheniramine 4mg', 13, 34, 18, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  
  -- Steroids (14)
  ('Hydrocortisone Cream 1%', 14, 9, 12, DATE_ADD(CURDATE(), INTERVAL 20 DAY)),
  ('Prednisone 20mg', 14, 28, 15, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Prednisone 5mg', 14, 46, 22, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  ('Dexamethasone 4mg', 14, 21, 14, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Betamethasone Cream', 14, 17, 10, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  ('Methylprednisolone 16mg', 14, 14, 10, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  
  -- Respiratory (15)
  ('Salbutamol Inhaler', 15, 7, 15, DATE_ADD(CURDATE(), INTERVAL 45 DAY)),
  ('Budesonide Nebules', 15, 18, 10, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Montelukast 10mg', 15, 52, 25, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Ipratropium Inhaler', 15, 13, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Theophylline 200mg', 15, 24, 15, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('N-Acetylcysteine 600mg', 15, 31, 18, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  ('Dextromethorphan Syrup', 15, 28, 15, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  
  -- Dermatological (16)
  ('Ketoconazole Shampoo', 16, 11, 8, DATE_ADD(CURDATE(), INTERVAL 50 DAY)),
  ('Mupirocin Ointment', 16, 6, 6, DATE_ADD(CURDATE(), INTERVAL 75 DAY)),
  ('Tretinoin Cream 0.025%', 16, 19, 12, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Adapalene Gel 0.1%', 16, 24, 14, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Benzoyl Peroxide Gel', 16, 32, 18, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Calamine Lotion', 16, 37, 20, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  ('Silver Sulfadiazine Cream', 16, 15, 10, DATE_ADD(CURDATE(), INTERVAL 130 DAY)),
  
  -- Gastrointestinal (17)
  ('Loperamide 2mg', 17, 30, 15, DATE_ADD(CURDATE(), INTERVAL 400 DAY)),
  ('Oral Rehydration Salts', 17, 45, 20, NULL),
  ('Bisacodyl 5mg', 17, 27, 15, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Lactulose Syrup', 17, 19, 12, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Mebeverine 135mg', 17, 33, 18, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Simethicone 80mg', 17, 41, 20, DATE_ADD(CURDATE(), INTERVAL 350 DAY)),
  
  -- Cardiac (18)
  ('Atorvastatin 20mg', 18, 55, 40, DATE_ADD(CURDATE(), INTERVAL 320 DAY)),
  ('Atorvastatin 40mg', 18, 48, 25, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Clopidogrel 75mg', 18, 14, 15, DATE_ADD(CURDATE(), INTERVAL 35 DAY)),
  ('Rosuvastatin 10mg', 18, 39, 20, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Digoxin 0.25mg', 18, 22, 14, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Isosorbide Dinitrate 5mg', 18, 29, 16, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Nitroglycerin Spray', 18, 8, 8, DATE_ADD(CURDATE(), INTERVAL 80 DAY)),
  
  -- Neurological (19)
  ('Levetiracetam 500mg', 19, 20, 15, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Gabapentin 300mg', 19, 33, 18, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Carbamazepine 200mg', 19, 27, 16, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  ('Phenytoin 100mg', 19, 18, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Valproic Acid 500mg', 19, 24, 15, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Pregabalin 75mg', 19, 31, 18, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  
  -- Pediatric (20)
  ('Pediatric Multivitamin Drops', 20, 14, 10, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('Amoxicillin Suspension', 20, 9, 12, DATE_ADD(CURDATE(), INTERVAL 18 DAY)),
  ('Paracetamol Suspension 120mg/5ml', 20, 42, 20, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  ('Ibuprofen Suspension 100mg/5ml', 20, 38, 18, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  ('Cetirizine Drops', 20, 26, 15, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Zinc Drops', 20, 19, 12, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  
  -- Ophthalmic (21)
  ('Timolol Eye Drops 0.5%', 21, 16, 12, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Brimonidine Eye Drops', 21, 13, 10, DATE_ADD(CURDATE(), INTERVAL 75 DAY)),
  ('Artificial Tears', 21, 48, 22, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Gentamicin Eye Drops', 21, 22, 14, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('Prednisolone Eye Drops', 21, 18, 12, DATE_ADD(CURDATE(), INTERVAL 100 DAY)),
  ('Cyclopentolate Eye Drops', 21, 11, 8, DATE_ADD(CURDATE(), INTERVAL 85 DAY)),
  
  -- Otic (22)
  ('Ciprofloxacin Ear Drops', 22, 15, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Ofloxacin Ear Drops', 22, 19, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Wax Removal Drops', 22, 23, 14, DATE_ADD(CURDATE(), INTERVAL 250 DAY)),
  
  -- Anticoagulants (23)
  ('Warfarin 5mg', 23, 34, 18, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Rivaroxaban 20mg', 23, 21, 14, DATE_ADD(CURDATE(), INTERVAL 145 DAY)),
  ('Apixaban 5mg', 23, 27, 16, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Enoxaparin Injection', 23, 12, 10, DATE_ADD(CURDATE(), INTERVAL 60 DAY)),
  
  -- Muscle Relaxants (24)
  ('Cyclobenzaprine 10mg', 24, 19, 12, DATE_ADD(CURDATE(), INTERVAL 150 DAY)),
  ('Baclofen 10mg', 24, 24, 15, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Methocarbamol 500mg', 24, 28, 16, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Tizanidine 2mg', 24, 16, 10, DATE_ADD(CURDATE(), INTERVAL 125 DAY)),
  
  -- Hormonal (25)
  ('Levothyroxine 50mcg', 25, 47, 22, DATE_ADD(CURDATE(), INTERVAL 260 DAY)),
  ('Levothyroxine 100mcg', 25, 53, 25, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Estradiol 1mg', 25, 18, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Progesterone 200mg', 25, 14, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Testosterone Gel', 25, 9, 8, DATE_ADD(CURDATE(), INTERVAL 70 DAY)),
  
  -- Immunosuppressants (26)
  ('Azathioprine 50mg', 26, 16, 12, DATE_ADD(CURDATE(), INTERVAL 130 DAY)),
  ('Cyclosporine 100mg', 26, 11, 10, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Mycophenolate 500mg', 26, 13, 10, DATE_ADD(CURDATE(), INTERVAL 105 DAY)),
  
  -- Antiparasitics (27)
  ('Albendazole 400mg', 27, 32, 18, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  ('Mebendazole 100mg', 27, 28, 15, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Ivermectin 6mg', 27, 19, 12, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  ('Praziquantel 600mg', 27, 14, 10, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  
  -- Urological (28)
  ('Tamsulosin 0.4mg', 28, 37, 20, DATE_ADD(CURDATE(), INTERVAL 230 DAY)),
  ('Finasteride 5mg', 28, 29, 16, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  ('Tolterodine 2mg', 28, 22, 14, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Solifenacin 5mg', 28, 18, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  
  -- Hematologic (29)
  ('Ferrous Sulfate 325mg', 29, 51, 24, DATE_ADD(CURDATE(), INTERVAL 310 DAY)),
  ('Folic Acid 5mg', 29, 44, 20, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Vitamin B12 1000mcg', 29, 33, 18, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Erythropoietin Injection', 29, 7, 8, DATE_ADD(CURDATE(), INTERVAL 45 DAY)),
  
  -- Anesthetics (30)
  ('Lidocaine Injection 2%', 30, 24, 15, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Lidocaine Gel 2%', 30, 18, 12, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Bupivacaine Injection 0.5%', 30, 11, 10, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  ('Benzocaine Throat Spray', 30, 26, 15, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  
  -- Additional Antibiotics
  ('Erythromycin 500mg', 1, 21, 14, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  ('Gentamicin Injection 80mg', 1, 8, 8, DATE_ADD(CURDATE(), INTERVAL 65 DAY)),
  ('Vancomycin Injection 500mg', 1, 5, 6, DATE_ADD(CURDATE(), INTERVAL 40 DAY)),
  ('Tetracycline 250mg', 1, 26, 15, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  ('Nitrofurantoin 100mg', 1, 34, 18, DATE_ADD(CURDATE(), INTERVAL 225 DAY)),
  
  -- Additional Painkillers & NSAIDs
  ('Morphine 10mg', 2, 6, 8, DATE_ADD(CURDATE(), INTERVAL 55 DAY)),
  ('Ketorolac 10mg', 2, 18, 12, DATE_ADD(CURDATE(), INTERVAL 135 DAY)),
  ('Piroxicam 20mg', 2, 23, 14, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Indomethacin 25mg', 2, 15, 10, DATE_ADD(CURDATE(), INTERVAL 115 DAY)),
  
  -- Additional Supplements
  ('Vitamin E 400 IU', 3, 29, 16, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Vitamin K 100mcg', 3, 17, 12, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Selenium 200mcg', 3, 22, 14, DATE_ADD(CURDATE(), INTERVAL 245 DAY)),
  ('Glucosamine + Chondroitin', 3, 31, 18, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Probiotics Multi-strain', 3, 26, 15, DATE_ADD(CURDATE(), INTERVAL 120 DAY)),
  ('L-Carnitine 500mg', 3, 19, 12, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  
  -- Additional Antiseptics & Wound Care
  ('Fusidic Acid Cream', 4, 14, 10, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  ('Gentian Violet Solution', 4, 12, 8, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Boric Acid Powder', 4, 9, 8, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  
  -- Additional Antihypertensives
  ('Valsartan 80mg', 5, 41, 22, DATE_ADD(CURDATE(), INTERVAL 235 DAY)),
  ('Carvedilol 12.5mg', 5, 28, 16, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Hydralazine 50mg', 5, 17, 12, DATE_ADD(CURDATE(), INTERVAL 145 DAY)),
  ('Clonidine 0.1mg', 5, 13, 10, DATE_ADD(CURDATE(), INTERVAL 105 DAY)),
  
  -- Additional Antidiabetics
  ('Acarbose 50mg', 6, 27, 16, DATE_ADD(CURDATE(), INTERVAL 185 DAY)),
  ('Repaglinide 2mg', 6, 19, 12, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  ('Dapagliflozin 10mg', 6, 22, 14, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Liraglutide Injection', 6, 8, 8, DATE_ADD(CURDATE(), INTERVAL 50 DAY)),
  
  -- Additional Antivirals
  ('Ribavirin 200mg', 7, 11, 10, DATE_ADD(CURDATE(), INTERVAL 85 DAY)),
  ('Ganciclovir Injection', 7, 4, 6, DATE_ADD(CURDATE(), INTERVAL 35 DAY)),
  
  -- Additional Vaccines
  ('DPT Vaccine', 8, 18, 12, DATE_ADD(CURDATE(), INTERVAL 75 DAY)),
  ('Varicella Vaccine', 8, 11, 10, DATE_ADD(CURDATE(), INTERVAL 55 DAY)),
  ('Rabies Vaccine', 8, 7, 8, DATE_ADD(CURDATE(), INTERVAL 45 DAY)),
  
  -- Additional Antifungals
  ('Griseofulvin 500mg', 9, 13, 10, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  ('Nystatin Oral Suspension', 9, 21, 14, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Econazole Cream', 9, 17, 12, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  
  -- Additional Antacids & GI Protection
  ('Famotidine 40mg', 10, 33, 18, DATE_ADD(CURDATE(), INTERVAL 215 DAY)),
  ('Sucralfate 1g', 10, 25, 15, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Magnesium Hydroxide Suspension', 10, 38, 20, DATE_ADD(CURDATE(), INTERVAL 310 DAY)),
  
  -- Additional Antiemetics
  ('Prochlorperazine 5mg', 11, 19, 12, DATE_ADD(CURDATE(), INTERVAL 160 DAY)),
  ('Dimenhydrinate 50mg', 11, 27, 15, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  
  -- Additional Antidepressants & Anxiolytics
  ('Paroxetine 20mg', 12, 24, 15, DATE_ADD(CURDATE(), INTERVAL 185 DAY)),
  ('Citalopram 20mg', 12, 29, 16, DATE_ADD(CURDATE(), INTERVAL 205 DAY)),
  ('Mirtazapine 15mg', 12, 18, 12, DATE_ADD(CURDATE(), INTERVAL 145 DAY)),
  ('Alprazolam 0.5mg', 12, 21, 14, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Lorazepam 1mg', 12, 17, 12, DATE_ADD(CURDATE(), INTERVAL 135 DAY)),
  ('Diazepam 5mg', 12, 23, 14, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  
  -- Additional Antihistamines & Allergy
  ('Hydroxyzine 25mg', 13, 26, 15, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Promethazine 25mg', 13, 19, 12, DATE_ADD(CURDATE(), INTERVAL 155 DAY)),
  ('Desloratadine 5mg', 13, 31, 18, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  
  -- Additional Steroids & Anti-inflammatory
  ('Triamcinolone Cream', 14, 14, 10, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Clobetasol Cream 0.05%', 14, 11, 8, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Fluticasone Nasal Spray', 14, 22, 14, DATE_ADD(CURDATE(), INTERVAL 185 DAY)),
  
  -- Additional Respiratory
  ('Ambroxol 30mg', 15, 37, 20, DATE_ADD(CURDATE(), INTERVAL 255 DAY)),
  ('Guaifenesin Syrup', 15, 29, 16, DATE_ADD(CURDATE(), INTERVAL 210 DAY)),
  ('Formoterol Inhaler', 15, 9, 10, DATE_ADD(CURDATE(), INTERVAL 70 DAY)),
  ('Tiotropium Inhaler', 15, 11, 10, DATE_ADD(CURDATE(), INTERVAL 85 DAY)),
  
  -- Additional Dermatological
  ('Permethrin Cream 5%', 16, 18, 12, DATE_ADD(CURDATE(), INTERVAL 220 DAY)),
  ('Salicylic Acid Solution', 16, 23, 14, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Tacrolimus Ointment 0.1%', 16, 8, 8, DATE_ADD(CURDATE(), INTERVAL 90 DAY)),
  ('Coal Tar Ointment', 16, 13, 10, DATE_ADD(CURDATE(), INTERVAL 300 DAY)),
  ('Zinc Oxide Cream', 16, 31, 18, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  
  -- Additional Gastrointestinal
  ('Ranitidine 300mg', 17, 2, 10, DATE_ADD(CURDATE(), INTERVAL 15 DAY)),
  ('Psyllium Husk Powder', 17, 26, 15, DATE_ADD(CURDATE(), INTERVAL 280 DAY)),
  ('Sennosides 8.6mg', 17, 34, 18, DATE_ADD(CURDATE(), INTERVAL 320 DAY)),
  ('Activated Charcoal 250mg', 17, 22, 14, DATE_ADD(CURDATE(), INTERVAL 365 DAY)),
  
  -- Additional Cardiac
  ('Simvastatin 20mg', 18, 42, 22, DATE_ADD(CURDATE(), INTERVAL 260 DAY)),
  ('Pravastatin 40mg', 18, 27, 16, DATE_ADD(CURDATE(), INTERVAL 195 DAY)),
  ('Spironolactone 25mg', 18, 31, 18, DATE_ADD(CURDATE(), INTERVAL 215 DAY)),
  ('Furosemide 40mg', 18, 46, 24, DATE_ADD(CURDATE(), INTERVAL 270 DAY)),
  ('Hydrochlorothiazide 25mg', 18, 38, 20, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  
  -- Additional Neurological
  ('Topiramate 100mg', 19, 19, 12, DATE_ADD(CURDATE(), INTERVAL 150 DAY)),
  ('Lamotrigine 100mg', 19, 22, 14, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Memantine 10mg', 19, 16, 12, DATE_ADD(CURDATE(), INTERVAL 135 DAY)),
  ('Rivastigmine 3mg', 19, 13, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Donepezil 10mg', 19, 17, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY)),
  
  -- Additional Pediatric
  ('Vitamin D Drops 400 IU', 20, 33, 18, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  ('Gripe Water', 20, 28, 15, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Cefixime Suspension', 20, 16, 12, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  ('Ondansetron Syrup', 20, 12, 10, DATE_ADD(CURDATE(), INTERVAL 85 DAY)),
  
  -- Additional Ophthalmic
  ('Latanoprost Eye Drops', 21, 14, 10, DATE_ADD(CURDATE(), INTERVAL 80 DAY)),
  ('Dorzolamide Eye Drops', 21, 11, 8, DATE_ADD(CURDATE(), INTERVAL 70 DAY)),
  ('Ofloxacin Eye Drops', 21, 19, 12, DATE_ADD(CURDATE(), INTERVAL 105 DAY)),
  ('Chloramphenicol Eye Drops', 21, 16, 10, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  
  -- Additional Anticoagulants
  ('Heparin Injection 5000 IU', 23, 9, 8, DATE_ADD(CURDATE(), INTERVAL 55 DAY)),
  ('Dabigatran 150mg', 23, 18, 12, DATE_ADD(CURDATE(), INTERVAL 130 DAY)),
  
  -- Additional Muscle Relaxants
  ('Chlorzoxazone 500mg', 24, 21, 14, DATE_ADD(CURDATE(), INTERVAL 170 DAY)),
  ('Orphenadrine 100mg', 24, 14, 10, DATE_ADD(CURDATE(), INTERVAL 125 DAY)),
  
  -- Additional Hormonal
  ('Medroxyprogesterone 10mg', 25, 22, 14, DATE_ADD(CURDATE(), INTERVAL 175 DAY)),
  ('Clomiphene 50mg', 25, 11, 10, DATE_ADD(CURDATE(), INTERVAL 95 DAY)),
  ('Cabergoline 0.5mg', 25, 8, 8, DATE_ADD(CURDATE(), INTERVAL 65 DAY)),
  
  -- Additional Immunosuppressants
  ('Tacrolimus 1mg', 26, 9, 8, DATE_ADD(CURDATE(), INTERVAL 75 DAY)),
  ('Methotrexate 2.5mg', 26, 14, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  
  -- Additional Antiparasitics
  ('Pyrantel Pamoate 250mg', 27, 24, 14, DATE_ADD(CURDATE(), INTERVAL 200 DAY)),
  ('Metronidazole Gel', 27, 18, 12, DATE_ADD(CURDATE(), INTERVAL 165 DAY)),
  ('Permethrin Lotion 1%', 27, 16, 10, DATE_ADD(CURDATE(), INTERVAL 240 DAY)),
  
  -- Additional Urological
  ('Dutasteride 0.5mg', 28, 21, 14, DATE_ADD(CURDATE(), INTERVAL 180 DAY)),
  ('Oxybutynin 5mg', 28, 24, 15, DATE_ADD(CURDATE(), INTERVAL 190 DAY)),
  ('Alfuzosin 10mg', 28, 17, 12, DATE_ADD(CURDATE(), INTERVAL 145 DAY)),
  
  -- Additional Hematologic
  ('Iron Sucrose Injection', 29, 6, 8, DATE_ADD(CURDATE(), INTERVAL 50 DAY)),
  ('Cyanocobalamin Injection', 29, 11, 10, DATE_ADD(CURDATE(), INTERVAL 85 DAY)),
  ('Darbepoetin Injection', 29, 4, 6, DATE_ADD(CURDATE(), INTERVAL 40 DAY)),
  
  -- Additional Anesthetics
  ('Procaine Injection 2%', 30, 13, 10, DATE_ADD(CURDATE(), INTERVAL 110 DAY)),
  ('Tetracaine Eye Drops', 30, 9, 8, DATE_ADD(CURDATE(), INTERVAL 75 DAY)),
  ('Articaine Dental Cartridge', 30, 17, 12, DATE_ADD(CURDATE(), INTERVAL 140 DAY));