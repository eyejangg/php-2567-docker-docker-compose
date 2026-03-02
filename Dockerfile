# 1. ใช้ Base Image PHP พร้อม Apache (เลือกเวอร์ชันที่ต้องการ เช่น 8.2 หรือ 8.3)
FROM php:8.2-apache

# 2. ติดตั้ง PHP Extensions ที่จำเป็น (เช่น pdo_mysql สำหรับเชื่อมต่อ Database)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# 3. เปิดใช้งาน Apache mod_rewrite (จำเป็นสำหรับ Framework อย่าง Laravel หรือปรับแต่ง URL)
RUN a2enmod rewrite

# 4. ตั้งค่า Working Directory ใน Container
WORKDIR /var/www/html

# 5. คัดลอกไฟล์ทั้งหมดจากโปรเจกต์ไปยัง Container
COPY . /var/www/html/

# 6. ตั้งค่า Permission ให้ Apache สามารถเขียนไฟล์ได้ (ถ้าจำเป็น)
RUN chown -R www-data:www-data /var/www/html

# 7. ระบุ Port ที่ Container จะใช้งาน
EXPOSE 80