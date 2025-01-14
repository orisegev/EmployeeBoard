# EmployeeBoard

EmployeeBoard is an internal bulletin board system for employees. It allows users to post announcements and receive email confirmations upon successful posting. Users can delete only their own posts, and all data is stored in a MySQL database.

## Features
- Post announcements with name, content, email, and post date.
- Email confirmation sent after posting.
- Users can delete only their own posts.
- Data persistence using MySQL.
- Input validation for secure and accurate data entry.
- Built with accessibility in mind.

## Technologies Used
- **PHP**: Server-side scripting.
- **HTML/CSS**: Structure and styling.
- **JavaScript**: Client-side interactivity.
- **MySQL**: Database management.
- **Cookies**: Manage user session for post deletion.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/EmployeeBoard.git
   ```
2. Import the provided SQL file into your MySQL database:
   ```bash
   mysql -u your-username -p your-database < sql/hod.sql
   ```
3. Configure the database connection in `api/includes/db_config.php`:
   ```php
   $host = 'localhost';
   $user = 'your-username';
   $password = 'your-password';
   $database = 'your-database';
   ```
4. Configure email settings in `api/mail/sendmail.php`:
   - Replace the default Gmail app password and email address with your own.
5. Deploy the project on a server with PHP and MySQL support.

## Usage
- Open the main page.
- Fill in the form to post an announcement.
- Confirm the post via email.
- Delete your own posts if needed.

## Future Improvements
- Implement user authentication for enhanced security.
- Add a search feature for filtering announcements.
- Improve UI/UX design.

## License
This project is open-source and available under the MIT License.

