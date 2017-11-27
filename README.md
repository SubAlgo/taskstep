# taskstep


# Start
หลังจาก clone มาให้
1. npm install
2. composer install
3. ไปที่ไฟล์ .env.example
  <br>3.1 แก้ส่วน DB_CONNECTION=mysql
        <br> DB_HOST=127.0.0.1
        <br>DB_PORT=3306
        <br> DB_DATABASE= //DB Name
        <br> DB_USERNAME= //Username login Database
        <br> DB_PASSWORD= //Password login Database<br>
  3.2 Save as -> เป็นชื่อไฟล์ .env
4. php artisan key:generate

# Set DB
1. ให้สร้าง Database MySQL เปล่า (ชื่อเดียวกับ DB_DATABASE=... )
2. php artisan migrate

# Run App
php artisan serv <br>
เปิด web browser ใส่ url: localhost:8000
