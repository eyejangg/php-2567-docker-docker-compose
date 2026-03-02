# ระบบบริหารจัดการบุคลากร (Personnel Management System) - NPRU

โปรเจกต์นี้ได้รับการ Containerized ด้วย **Docker Compose** เพื่อการจัดการที่ง่ายและเป็นระบบเดียว

## � วิธีการเริ่มใช้งาน (แนะนำ)

คุณสามารถรันทั้งระบบ (Web + Database + phpMyAdmin) ได้ด้วยคำสั่งเดียว:

```bash
docker-compose up -d
```

### � ช่องทางการเข้าใช้งาน:

- **เว็บไซต์หลัก**: [http://localhost:8080](http://localhost:8080)
- **phpMyAdmin**: [http://localhost:8888](http://localhost:8888)
  - **Username**: `root`
  - **Password**: `root`
  - **Server**: `db`

---

## 🔑 ข้อมูลการเข้าสู่ระบบ (Dashboard)

บัญชีตัวอย่างสำหรับทดสอบระบบ (จาก `person.sql`):

| ประเภทผู้ใช้งาน | Username  | Password    | สิทธิ์การใช้งาน        |
| :-------------- | :-------- | :---------- | :--------------------- |
| **Admin**       | `admin`   | `123456`    | จัดการข้อมูลได้ทั้งหมด |
| **Admin**       | `admin2`  | `admin123`  | จัดการข้อมูลได้ทั้งหมด |
| **Member**      | `member1` | `member123` | ดูและแก้ไขโปรไฟล์ตนเอง |

---

## � รายละเอียด Service ใน Docker Compose

1. **app**: PHP 8.2 + Apache (Port 8080) - ซิงค์โค้ดอัตโนมัติผ่าน Volume
2. **db**: MariaDB 10.11 (Port 3306) - พร้อมข้อมูลเริ่มต้นจาก `person.sql`
3. **phpmyadmin**: ระบบจัดการฐานข้อมูล (Port 8081)

---

## 🛠️ วิธีการ Build ใหม่ (หากมีการแก้ไข Dockerfile)

```bash
docker-compose up -d --build
```

---

_จัดทำขึ้นสำหรับการใช้งานใน Branch: feature/docker-compose_
