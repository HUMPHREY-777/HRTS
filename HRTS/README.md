# 🌴 HRTS – Hotel & Ride Transport System

**HRTS** (Hotel & Ride Transport System) is a beginner-friendly, fully functional web-based system designed for a beach-front resort in Mombasa. It seamlessly integrates **hotel room reservations** with **transport booking** to offer guests a hassle-free experience from arrival to check-in.

## 🚀 Features

- 🏠 **Landing Page**
  - Elegant landing page with navigation and footer
  - Buttons to direct users to **Register** or **Log in**

- 👤 **User Authentication**
  - User Registration (Name, Email, Password)
  - Secure Login (No admin users)

- 🛏️ **Room Booking**
  - View available rooms categorized as **Basic**, **Normal**, and **Deluxe**
  - Each room displays image, details, and price
  - Booking form includes:
    - Check-in and Check-out
    - Number of guests (Max 2)
    - Auto-suggested email & name
    - Selection of **transport option**: Medium, Large, or Luxury
    - Choice of **pickup location** (e.g., Mombasa Airport, SGR Terminus, Bus Stations)

- 🚖 **Transport Integration**
  - Auto-calculates transport cost based on vehicle and pickup point
  - Combines room and ride in final price
  - Simulated payment button

- 🧾 **Booking Confirmation**
  - View summary with:
    - Room & Transport Details
    - Driver Info & Vehicle Plate Number
    - Pickup Date/Time

- 📜 **Booking History**
  - Logged-in users can view their past bookings for future reference

## 🛠️ Technologies Used

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP (Beginner-Friendly, with inline comments)
- **Database**: MySQL
- **Styling**: Minimalist UI inspired by Booking.com

## 📂 Folder Structure

```
/hrts
│
├── index.php                 # Landing page
├── login.php                 # User login
├── register.php              # User registration
├── dashboard.php             # Shows room list
├── room_detail.php           # Detailed room info
├── booking.php               # Room + transport booking form
├── booking_confirmation.php  # Booking confirmation page
├── booking_history.php       # User booking history
├── logout.php                # User log out
│
├── /css                      # Custom stylesheets
│   └── style.css
│
├── /js                       # JavaScript files
│   └── script.js
│
├── /images                   # Room images
│   └── deluxe.jpg, normal.jpg, basic.jpg, etc.
│
├── /includes                 # Reusable components
│   ├── db.php                # DB connection
│   ├── header.php
│   ├── footer.php
│   └── functions.php         # Helper functions
│
└── /sql                      # Database structure
    └── schema.sql
```

## 💽 Database Schema

Make sure to import the `schema.sql` file into your MySQL database. It contains all required tables:

- `users` – stores user accounts
- `rooms` – stores room details
- `bookings` – stores user booking records

> ✅ **Note:** Uses modern SQL practices, primary/foreign keys, indexing, and data validation.

## 🖼️ Adding Room Images (Manual Method)

1. Place your images inside the `images/` folder.
2. Reference them directly in PHP/HTML like:
   ```php
   <img src="images/deluxe.jpg" alt="Deluxe Room">
   ```
3. Ensure your folder has the correct permissions:
   - Use FTP or Hosting File Manager
   - Recommended: `chmod 755 images/`

## 💡 How It Works

Once a user books a room:
1. The system checks availability.
2. The user selects check-in/out dates, ride category, and pickup location.
3. System auto-calculates price.
4. Upon booking, the user gets confirmation with transport details.
5. Booking is saved in the database and can be viewed under **Booking History**.

## 🎯 Goal

To provide a **seamless guest experience** from arrival to check-in, removing the stress of finding a ride in Mombasa by automating room and ride bookings in one smooth process.

## 🇰🇪 Currency & Location

- All prices are in **Kenyan Shillings (KES)**
- Pickup points include popular **Mombasa** locations like:
  - Moi International Airport
  - SGR Terminus Miritini
  - Mombasa Bus Terminal

## 📌 Developer Notes

- Designed for **students, beginners, and small resorts**
- Inline comments make it easy to understand and extend
- No frameworks used – pure PHP, HTML, CSS, and JS
- Simulated payment system – no real payment integration

---

## 🧠 Credits

Developed with ❤️ by GROUP-A software eng.  
Project maintained and updated via GitHub or local server.

---

Enjoy your stress-free hotel and transport booking experience with HRTS! 🌅🚕🏨
```
