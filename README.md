# ระบบบริหารจัดการบุคลากร (Personnel Management System) - NPRU

โปรเจกต์นี้ได้รับการ Containerized ด้วย Docker เพื่อความสะดวกในการติดตั้งและพัฒนา

## 🐳 การเริ่มใช้งานด้วย Docker (คำสั่งที่คุณใช้งาน)

หากต้องการรันระบบด้วยคำสั่ง Docker CLI ทีละขั้นตอน ให้ทำตามลำดับดังนี้:

### 1. สร้างเครือข่าย (Network)

```bash
docker network create my-network
```

### 2. รันฐานข้อมูล MySQL

```bash
docker run -d --name my-mysql --network my-network -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 mysql:latest
```

### 3. รัน phpMyAdmin (เข้าใช้งานที่ http://localhost:8080)

```bash
docker run -d --name my-phpmyadmin --network my-network -p 8080:80 -e PMA_HOST=my-mysql phpmyadmin
```

### 4. การ Build และรันแอปพลิเคชัน (เวอร์ชัน 2.0.0)

```bash
# Build Image
docker build -t php-app:2.0.0 .

# Run Container (เข้าเว็บไซต์ที่ http://localhost)
docker run --name php-app --network my-network -d -p 80:80 -e DB_HOST=my-mysql -e DB_PASSWORD=root php-app:2.0.0
```

---

## 🚀 วิธีที่แนะนำ (Docker Compose)

เพื่อความรวดเร็ว คุณสามารถรันทุกอย่างพร้อมกันด้วยคำสั่งเดียว:

```bash
docker-compose up -d
```

- **เว็บไซต์หลัก**: [http://localhost:8080](http://localhost:8080)
- **phpMyAdmin**: [http://localhost:8081](http://localhost:8081)

---

## 🔑 ข้อมูลการเข้าสู่ระบบ (Dashboard)

ในโปรเจกต์นี้มีบัญชีตัวอย่างที่สร้างไว้ให้ใน `person.sql` แล้ว:

| ประเภทผู้ใช้งาน | Username  | Password    | สิทธิ์การใช้งาน                     |
| :-------------- | :-------- | :---------- | :---------------------------------- |
| **Admin**       | `admin`   | `123456`    | จัดการข้อมูลได้ทั้งหมด              |
| **Admin**       | `admin2`  | `admin123`  | จัดการข้อมูลได้ทั้งหมด              |
| **Member**      | `member1` | `member123` | ดูข้อมูลส่วนตัวและแก้ไขโปรไฟล์ตนเอง |

---

## 🛠️ โครงสร้างฐานข้อมูล

- **Host**: `my-mysql` (เมื่อรันใน Docker) หรือ `localhost` (เมื่อรันใน XAMPP)
- **User**: `root`
- **Password**: `root`
- **Database Name**: `person`

---

_จัดทำขึ้นสำหรับการใช้งานใน Branch ใหม่_
