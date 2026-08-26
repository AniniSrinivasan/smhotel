# S&M Hotel Management System

S&M Hotel Management System is a PHP and SQLite web application for managing hotel branches, room types, rooms, guests, bookings, and booking payments. It is designed to run locally under XAMPP, with a bundled SQLite database file named `hotelSQL.db`.

## Project Structure

- `login.php` - login page and authentication entry point.
- `signup.php` - guest registration page.
- `dashboard.php` - landing page after login.
- `navbar.php` and `nav.js` - shared navigation, search filtering, delete confirmation, and double-click edit behavior.
- `functions.php` - database connection and shared CRUD functions.
- `hotel.php`, `hotel-add.php` - hotel branch list, edit, delete, and add screens.
- `room-type.php`, `room-type-add.php` - room type list, edit, delete, and add screens.
- `room.php`, `room-add.php` - room list, edit, delete, and add screens.
- `guest.php`, `guest-add.php` - guest list, edit, delete, and add screens.
- `booking.php`, `booking-add.php`, `booking-payment.php` - booking list, booking creation, availability filtering, and payment flow.
- `logout.php` - clears the user session and returns to login.
- `style.css`, `login.css` - application styling.
- `hotelSQL_DDL.sql` - database table definitions.
- `hotelSQL_DML.sql` - sample data inserts.
- `hotelSQL.db` - ready-to-use SQLite database.
- `img/` - logo, profile image, and hotel images.

## Requirements

- XAMPP installed.
- Apache enabled in XAMPP.
- PHP with the SQLite3 extension enabled.
- A browser.

This project was checked with XAMPP PHP 8.2.4, and the installed XAMPP PHP includes both `sqlite3` and `pdo_sqlite`.

## Setup With XAMPP

1. Place the project folder inside the XAMPP web root:

   ```text
   {XAMPP path}/htdocs/smhotel
   ```

2. Start Apache from the XAMPP control panel.

3. Open the application in a browser:

   ```text
   http://localhost/smhotel/login.php
   ```

4. Log in using one of the sample accounts below.

## Sample Login Accounts

Admin account:

```text
Username: anini_admin
Password: adminadmin
```

Guest account:

```text
Username: aninisrinivasan@gmail.com
Password: passpass
```

Other seeded guest accounts use their email address as the username. Many have this password:

```text
password123
```

## Optional: Run With PHP's Built-In Server

If PHP is available on your command line, you can also run the project without Apache:

```bash
cd {XAMPP path}/htdocs/smhotel
{XAMPP path}/bin/php -S localhost:8000
```

Then open:

```text
http://localhost:8000/login.php
```

## Database Setup

The project already includes a populated SQLite database:

```text
hotelSQL.db
```

The database connection is created in `functions.php`:

```php
$db = new SQLite3('hotelSQL.db');
```

Because the path is relative, run the app from the `smhotel` folder or keep the database file in the same directory as the PHP files.

To rebuild the database from the SQL files:

```bash
cd {XAMPP path}/htdocs/smhotel
sqlite3 hotelSQL.db < hotelSQL_DDL.sql
sqlite3 hotelSQL.db < hotelSQL_DML.sql
```

If you want a clean rebuild, rename or back up the current database first:

```bash
mv hotelSQL.db hotelSQL.backup.db
sqlite3 hotelSQL.db < hotelSQL_DDL.sql
sqlite3 hotelSQL.db < hotelSQL_DML.sql
```

## What You Can Do

As an admin user, you can:

- View the dashboard.
- Manage bookings.
- Add, edit, delete, search, and paginate hotel branches.
- Add, edit, delete, search, and paginate room types.
- Add, edit, delete, search, and paginate rooms.
- Add, edit, delete, search, and paginate guests.
- Create bookings for guests.
- Filter available rooms by check-in date, check-out date, and hotel branch.
- Take a booking through the payment screen.
- View whether a booking is paid or unpaid.

As a guest user, you can:

- Log in with a guest account.
- View only your own bookings.
- Create a booking.
- Select available rooms based on dates and hotel branch.
- Complete payment for a booking.

Guest users are restricted by `requireLogin()` in `functions.php`. If a guest tries to access admin-only pages directly through the URL, the app redirects them back to `booking.php`.

## Main Workflow

1. User logs in from `login.php`.
2. Login details are checked against the `USER` table.
3. Session values are stored for the user ID, username, role, and email.
4. The user is sent to `dashboard.php`.
5. Admin users can use the full management menu.
6. Guest users can manage only their own bookings.
7. New bookings are created in `booking-add.php`.
8. After a booking is created, the user is redirected to `booking-payment.php`.
9. Payment is saved in the `PAYMENT` table.
10. The user returns to `booking.php`.

## Existing Data

The bundled database currently contains:

- 6 hotel branches.
- 25 rooms.
- 13 guests.
- 18 bookings.
- Room types including Single, Double, Twin, Family, Accessible, and Premium.
- Payment types including Cash, Credit Card, Debit Card, Bank Transfer, and Online Payment.

## Notes For Development

- This is a local/demo project. Passwords are stored as plain text in the database.
- Many SQL queries directly interpolate form values. For production, use prepared statements throughout.
- Delete actions use a JavaScript confirmation popup from `nav.js`.
- List pages support pagination with 5 records per page.
- Some pages support double-clicking a table row to trigger edit mode.
- The navigation is loaded dynamically using `fetch("navbar.php", { cache: "no-store" })`.

## Troubleshooting

If the login page loads but data does not appear:

- Check that `hotelSQL.db` is in the project root.
- Check that PHP has the SQLite3 extension enabled.
- Check XAMPP Apache is running.

If Google Fonts do not load:

- The app still works, but it needs internet access to load the Source Sans Pro font.

If using the PHP built-in server fails with `command not found`:

- Use XAMPP Apache, or call XAMPP's PHP directly:

  ```bash
  {XAMPP path}/bin/php -S localhost:8000
  ```
