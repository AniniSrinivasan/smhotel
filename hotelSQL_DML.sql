INSERT INTO HOTEL(HOTEL_NAME, HOTEL_ADDRESS, CITY,  POSTCODE, HOTEL_TELNO, HOTEL_EMAIL) 
VALUES	
('S&M Hotel London', 'Clydesdale Way', 'London', 'DA17 6FB', '+44 871 559 1220', 'sm_hotel_london@smh.co.uk'),
('S&M Hotel Liverpool', 'The Strand', 'Liverpool', ' L2 0PP', '+44 871 559 1221', 'sm_hotel_liverpool@smh.co.uk'),
('S&M Hotel Manchester', '31 Piccadilly', 'Manchester', 'M1 1LU', '+44 871 559 1222', 'sm_hotel_manchester@smh.co.uk'),
('S&M Hotel Leeds', 'Blayds Court', 'Leeds', 'LS1 4AD', '+44 871 559 1223', 'sm_hotel_leeds@smh.co.uk'),
('S&M Hotel Birmingham', '230 Broad St', 'Birmingham', ' B15 1AY', '+44 871 559 1224', 'sm_hotel_birmingham@smh.co.uk'),
('S&M Hotel Glasgow', '78 Queen St', 'Glasgow', ' G1 3DS', '+44 871 559 1225', 'sm_hotel_glasgow@smh.co.uk');

INSERT INTO ROOM_TYPE(ROOM_TYPE_NAME, ROOM_TYPE_DESCRIPTION)
VALUES
('Single', 'Designed for one guest, featuring comfortable single bed, modern decor, Freeview TV, and essential amenities like en-suite bathroom, desk, and complimentary Wi-Fi.'),
('Double', 'Ideal for couples or solo travellers seeking extra space and comfort. We offer double bed, en-suite bathroom, living area, desk  and complimentary Wi-Fi.'),
('Twin', 'Features two separate comfortable single beds, perfect for friends or colleagues sharing and includes essential amenities like en-suite bathroom, desk, and complimentary Wi-Fi.'),
('Family',  'Ideal for a family of four. We offer one Double bed and two single beds for the little ones. These rooms also have amenities like en-suite bathroom, desk, living area and complimentary Wi-Fi. '),
('Accessible', 'All the perfect features from S&M rooms, but with facilities designed to help our guests with mobility issues. Offers step-free entrance, wide doors, an accessible bathrooms and all standard amenities.'),
('Premium',  'A fancier option with king-sized bed, upgraded furnishings, larger living space, and premium features such as minibar and jacuzzi for extra comfort!');

INSERT INTO ROOM (ROOM_NO, ROOM_TYPE_ID, PRICE, HOTEL_ID)
VALUES
(101, 1, 85.99, 1),
(102, 2, 120.99, 1),
(103, 3, 110.99, 1),
(104, 6, 210.99, 1),

(201, 1, 80.99, 2),
(202, 2, 115.99, 2),
(203, 4, 155.99, 2),
(204, 5, 99.99, 2),

(301, 1, 90.99, 3),
(302, 2, 150.99, 3),
(303, 3, 120.99, 3),
(304, 6, 210.99, 3),

(401, 1, 99.99, 4),
(402, 2, 118.99, 4),
(403, 4, 150.99, 4),
(404, 5, 95.99, 4),

(501, 1, 99.99, 5),
(502, 2, 100.99, 5),
(503, 3, 115.99, 5),
(504, 6, 240.99, 5),

(601, 1, 78.99, 6),
(602, 2, 110.99, 6),
(603, 4, 145.99, 6),
(604, 5, 95.99, 6);


INSERT INTO GUEST(F_NAME, M_NAME, L_NAME, GUEST_ADDRESS, CITY, POSTCODE, GUEST_EMAIL, GUEST_PHNO)
VALUES
('Anini',NULL,'Srinivasan','Flat 10, City Centre','Sheffield','S1 2AB','aninisrinivasan@gmail.com','+44 74073 26008'),
('Isla', 'Rose', 'James', '340 Prince of Wales Rd', 'Sheffield', 'S2 1FF', 'islarosejames@email.com', '+44 71234 87634'),
('Thea', 'Jewel', 'Edward', 'A1, Carcroft', 'Doncaster', 'DN6 8LR', 'theaedward@email.com', '+44 76434 65342'),
('Aaron', NULL, 'Blackford', '143 Wrights Ln', 'London', 'W8 5SP', 'aaron_blackford@email.com', '+44 76534 82634'),
('Travis', 'Barker', 'Jones', '03 Herbert Walker Ave', 'Southampton', 'SO15 1AG', 'travisjones@email.com', '+44 73542 54362'),
('Tara', NULL, 'Singh', '129 St Nicholas Cir', 'Leicester', 'LE1 5LX', 'tarasingh@email.com', '+44 73532 96342'),
('June', NULL, 'Smith', '12 Brayford Wharf N', 'Lincoln', 'LN1 1YW', 'junesmith@email.com', '+44 76429 00862'),
('Yassin', NULL, 'Ahmad', '56 North Humberside', 'Hull', 'HU1 2BX', 'yassinahmad@email.com', '+44 77798 97008'),
('Nahom', 'Eric', 'Abebe', '2 Irish Town Way', 'Manchester', 'M8 0AE', 'nahomeric@email.com', '+44 70042 52453'),
('Ji-yoo', NULL, 'Kang', '35 Argyle Rd', 'Ilford', 'IG1 3BQ', 'jiyookang@email.com', '+44 72543 12634'),
('Noah', 'Ray', 'Robinson', '43 Waterloo Square', 'Newcastle upon Tyne', 'NE1 4DN', 'noahrayrob@email.com', '+44 75276 24803');

INSERT INTO USER (USERNAME, USER_PASSWORD, ROLE, F_NAME, M_NAME, L_NAME, USER_EMAIL)
VALUES
('anini_admin','adminadmin','Admin','Anini',NULL,'Srinivasan','aninisrini@smh.co.uk'),
('aninisrinivasan@gmail.com','passpass','Guest','Anini',NULL,'Srinivasan','aninisrinivasan@gmail.com'),
('islarosejames@email.com',  'password123', 'Guest', 'Isla',  'Rose',  'James',     'islarosejames@email.com'),
('theaedward@email.com',     'password123', 'Guest', 'Thea',  'Jewel', 'Edward',    'theaedward@email.com'),
('aaron_blackford@email.com','password123', 'Guest', 'Aaron', NULL,    'Blackford', 'aaron_blackford@email.com'),
('travisjones@email.com',    'password123', 'Guest', 'Travis','Barker','Jones',     'travisjones@email.com'),
('tarasingh@email.com',      'password123', 'Guest', 'Tara',  NULL,    'Singh',     'tarasingh@email.com'),
('junesmith@email.com',      'password123', 'Guest', 'June',  NULL,    'Smith',     'junesmith@email.com'),
('yassinahmad@email.com',    'password123', 'Guest', 'Yassin',NULL,    'Ahmad',     'yassinahmad@email.com'),
('nahomeric@email.com',      'password123', 'Guest', 'Nahom', 'Eric',  'Abebe',     'nahomeric@email.com'),
('jiyookang@email.com',      'password123', 'Guest', 'Ji-yoo',NULL,    'Kang',      'jiyookang@email.com'),
('noahrayrob@email.com',     'password123', 'Guest', 'Noah',  'Ray',   'Robinson',  'noahrayrob@email.com');

INSERT INTO BOOKING (NO_OF_GUEST, DATE_IN, DATE_OUT, GUEST_ID, ROOM_ID)
VALUES
(1, '2026-03-10', '2026-03-12', 1, 1), 
(2, '2026-04-05', '2026-04-07', 2, 2),
(2, '2026-05-01', '2026-05-05', 3, 4),  
(1, '2026-02-18', '2026-02-19', 4, 5),   
(4, '2026-06-20', '2026-06-23', 5, 7), 
(1, '2026-01-10', '2026-01-12', 6, 9),  
(2, '2026-07-15', '2026-07-18', 7, 10), 
(1, '2026-08-02', '2026-08-04', 8, 13), 
(2, '2026-09-10', '2026-09-15', 9, 18), 
(2, '2026-10-01', '2026-10-03', 10, 22);

INSERT INTO PAYMENT_TYPE (DESCRIPTION)
VALUES
('Cash'),
('Credit Card'),
('Debit Card'),
('Bank Transfer'),
('Online Payment');

INSERT INTO PAYMENT (AMOUNT, TYPE, STATUS, BOOKING_ID)
VALUES
(171.98, 2, 1, 1), 
(241.98, 3, 1, 2), 
(843.96, 2, 1, 3), 
(80.99,  1, 1, 4), 
(467.97, 3, 1, 5),  
(181.98, 2, 1, 6),  
(452.97, 1, 1, 7), 
(199.98, 2, 1, 8), 
(504.95, 3, 1, 9), 
(221.98, 2, 1, 10);
