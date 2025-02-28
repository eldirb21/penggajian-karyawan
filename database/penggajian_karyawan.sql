CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    gambar varchar(150) NOT NULL,
    role ENUM('admin', 'karyawan') DEFAULT 'karyawan'
);
INSERT INTO `users` (`id`, `email`, `password`, `nama`, `level`, `gambar`, password) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin Buku', 'admin', 'gambar_admin/admin.jpg'),
(2, 'user@gmail.com', 'user', 'Jenifer', 'user', 'gambar_admin/admin.jpg'),
(3, 'user2@gmail.com', 'user2', 'Marry Riana', 'user', 'gambar_admin/admin.jpg'),
(4, 'user3@gmail.com', 'user3', 'Anthoni salim', 'user', 'gambar_admin/admin.jpg');


CREATE TABLE karyawan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100),
    jabatan VARCHAR(100),
    gaji DECIMAL(10,2),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE gaji (
    id INT AUTO_INCREMENT PRIMARY KEY,
    karyawan_id INT,
    bulan VARCHAR(20),
    tahun INT,
    jumlah DECIMAL(10,2),
    FOREIGN KEY (karyawan_id) REFERENCES karyawan(id) ON DELETE CASCADE
);