## Budget Tracker

A simple web-based Budget Tracker application built with PHP, MySQL, HTML, CSS, and a touch of JavaScript.  
This app allows users to register, log in, add and view their expenses, see a summary of their spending, and print their expense records.

### **Features**
- **User Registration & Login:** Secure authentication with password hashing.
- **Dashboard:** View a summary of your total spending.
- **Expense Management:** Add new expenses with title, amount, category, and date.
- **View All Expenses:** See a table of all your expenses, filterable by user.
- **Print Option:** Print a clean version of your expenses table.
- **Responsive Navigation:** Navigation bar adapts based on login status.
- **Session Management:** Only logged-in users can access dashboard and expenses.
- **Clean UI:** Modern, responsive design with CSS.

### **How to Use**
1. **Clone or download this repository.**
2. **Import the database schema:**  
   Use the `database_schema.sql` file in phpMyAdmin or your MySQL tool to create the required tables.
3. **Move the `mybt` folder to your web server’s root directory:**  
   - For XAMPP: `C:/xampp/htdocs/mybt`
   - For WAMP: `C:/wamp/www/mybt`
4. **Configure your database credentials** in `db_actions.php` if needed.
5. **Start your web server** and visit `http://localhost/mybt/` in your browser.
6. **Register a new user, log in, and start tracking your expenses!**

### **Requirements**
- PHP 7.x or newer
- MySQL (or MariaDB)
- A local web server (XAMPP, WAMP, etc.)
