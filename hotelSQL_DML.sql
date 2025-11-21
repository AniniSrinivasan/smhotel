INSERT INTO HOTEL(HOTEL_NAME, HOTEL_ADDRESS, CITY,  POSTCODE, HOTEL_TELNO, HOTEL_EMAIL) 
VALUES	
('S&M Hotel London', 'Clydesdale Way', 'London', 'DA17 6FB', '+44 871 559 1220', 'sm_hotel_london@smh.co.uk'),
('S&M Hotel Liverpool', 'The Strand', 'Liverpool', ' L2 0PP', '+44 871 559 1221', 'sm_hotel_liverpool@smh.co.uk'),
('S&M Hotel Manchester', '31 Piccadilly', 'Manchester', 'M1 1LU', '+44 871 559 1222', 'sm_hotel_manchester@smh.co.uk'),
('S&M Hotel Leeds', 'Blayds Court', 'Leeds', 'LS1 4AD', '+44 871 559 1223', 'sm_hotel_leeds@smh.co.uk'),
('S&M Hotel Birmingham', '230 Broad St', 'Birmingham', ' B15 1AY', '+44 871 559 1224', 'sm_hotel_birmingham@smh.co.uk'),
('S&M Hotel Glasgow', '78 Queen St', 'Glasgow', ' G1 3DS', '+44 871 559 1225', 'sm_hotel_glasgow@smh.co.uk');

INSERT INTO USER(USERNAME, USER_PASSWORD, ROLE, F_NAME, M_NAME, L_NAME, USER_EMAIL)
VALUES
('anini_admin', 'password@1234', 'Admin', 'Anini', NULL, 'Srinivasan', 'aninisrini@smh.co.uk');

INSERT INTO ROOM_TYPE(ROOM_TYPE_NAME, PRICE, ROOM_TYPE_DESCRIPTION)
VALUES
('Single', 78.99, 'Designed for one guest, featuring comfortable single bed, modern decor, Freeview TV, and essential amenities like en-suite bathroom, desk, and complimentary Wi-Fi.'),
('Double', 88.99, 'Ideal for couples or solo travellers seeking extra space and comfort. We offer double bed, en-suite bathroom, living area, desk  and complimentary Wi-Fi.'),
('Twin', 98.99, 'Features two separate comfortable single beds, perfect for friends or colleagues sharing and includes essential amenities like en-suite bathroom, desk, and complimentary Wi-Fi.'),
('Family', 108.99, 'Ideal for a family of four. We offer one Double bed and two single beds for the little ones. These rooms also have amenities like en-suite bathroom, desk, living area and complimentary Wi-Fi. '),
('Accessible', 88.99, 'All the perfect features from S&M rooms, but with facilities designed to help our guests with mobility issues. Offers step-free entrance, wide doors, an accessible bathrooms and all standard amenities.'),
('Premium', 120.99, 'A fancier option with king-sized bed, upgraded furnishings, larger living space, and premium features such as minibar and jacuzzi for extra comfort!');

INSERT INTO ROOM(ROOM_NO, ROOM_AVAILABILITY)
VALUES
('101', '1'),
('102', '1'),
('103', '0'),
('104', '1'),
('105', '1'),
('106', '0'),
('107', '1'),
('108', '1'),
('109', '0'),
('110', '1');

INSERT INTO GUEST(F_NAME, M_NAME, L_NAME, GUEST_ADDRESS, CITY, POSTCODE, GUEST_EMAIL, GUEST_PHNO)
VALUES
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

-- INSERT INTO BOOKING(N0_OF_GUEST, DATE_IN, DATE_OUT)
-- VALUES
-- not sure about the dates and stuff

--not sure about some details in payment table and stuff

-- please fix the erd.. multiple changes have been made










	