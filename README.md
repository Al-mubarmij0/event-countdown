# Event Countdown Timer

This project features an **Event Countdown Timer** that allows users to view upcoming events with a countdown showing the time remaining until each event. The countdown is displayed in **days, hours, minutes, and seconds**. Additionally, the timer will indicate if the event is ongoing, ensuring that users are always informed about events they might be interested in.

## Features
- **Upcoming Events Countdown**: Displays a countdown to the event in days, hours, minutes, and seconds.
- **Event Status**: Displays whether an event is **ongoing** or not, based on the current date and time.
- **Event Display Order**: Events are displayed in chronological order.
- **User-friendly UI**: The events are styled to be clear and readable, with easy-to-interpret countdowns.

## Requirements
- **PHP 8.x** or higher
- **Laravel 8.x** or higher
- **Bootstrap 5.x** for styling (or any CSS framework of your choice)
- **Database**: MySQL (or compatible database)

## Setup Instructions

### Clone the repository
To get started with the Event Countdown Timer, clone the repository to your local machine.

```bash
git clone https://github.com/yourusername/event-countdown-timer.git
cd event-countdown-timer
```
## Install Dependencies
Make sure you have Composer installed. Run the following command to install PHP dependencies:


```bash
composer install
```
Then, install JavaScript and CSS dependencies using npm:

```bash
npm install
npm run dev
```
Environment Configuration
Create a .env file by copying from the .env.example file:

```bash
cp .env.example .env
```
Generate a new application key:

```bash
php artisan key:generate
```

###Database Configuration
Set up your database configuration in the .env file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

Run the migrations to create the necessary tables:

```bash
php artisan migrate
```

- Make sure to define your events in the events table with fields like:

- event_name (varchar)

- description (text)

- start_time (timestamp)

- end_time (timestamp)

- location (varchar)

- organizer (varchar)
format with the following columns:
        
Contributing
Feel free to open issues and submit pull requests for improvements or new features!

License
This project is licensed under the MIT License - see the LICENSE file for details.
## Author
- mohammedmubaraksani@gmail.com
