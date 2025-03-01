CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    gambar VARCHAR(150) NOT NULL,
    role ENUM('admin', 'karyawan') DEFAULT 'karyawan'
);

INSERT INTO users (id, email, password, nama, role, gambar) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin Buku', 'admin', 'gambar_admin/admin.jpg'),
(2, 'user@gmail.com', 'user', 'Jenifer', 'karyawan', 'gambar_admin/admin.jpg'),
(3, 'user2@gmail.com', 'user2', 'Marry Riana', 'karyawan', 'gambar_admin/admin.jpg'),
(4, 'user3@gmail.com', 'user3', 'Anthoni Salim', 'karyawan', 'gambar_admin/admin.jpg');

-- Membuat tabel karyawan
CREATE TABLE karyawan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jabatan VARCHAR(100),
    gaji DECIMAL(10,2),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert data ke tabel karyawan
INSERT INTO karyawan (id, nama, jabatan, gaji, user_id) VALUES
(1, 'Jenifer', 'Manager', 8000000.00, 2),
(2, 'Marry Riana', 'Supervisor', 6000000.00, 3),
(3, 'Anthoni Salim', 'Staff', 4500000.00, 4);

-- Membuat tabel gaji
CREATE TABLE gaji (
    id INT AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT,
    bulan VARCHAR(20),
    tahun INT,
    jumlah DECIMAL(10,2),
    FOREIGN KEY (karyawan_id) REFERENCES karyawan(id) ON DELETE CASCADE
);

-- Insert data ke tabel gaji
INSERT INTO gaji (id, karyawan_id, bulan, tahun, jumlah) VALUES
(1, 1, 'Januari', 2024, 8000000.00),
(2, 2, 'Januari', 2024, 6000000.00),
(3, 3, 'Januari', 2024, 4500000.00);
