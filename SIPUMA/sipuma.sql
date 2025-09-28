-- Buat database SIPUMA
CREATE DATABASE
IF NOT EXISTS sipuma;
USE sipuma;

-- Tabel Users (User dan Admin)
CREATE TABLE users
(
    id INT
    AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR
    (100) NOT NULL,
    email VARCHAR
    (100) NOT NULL UNIQUE,
    password VARCHAR
    (255) NOT NULL,
    role ENUM
    ('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

    -- Tabel Usaha (Data UMKM)
    CREATE TABLE usaha
    (
        id INT
        AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,

    -- Data Pribadi
    nama_lengkap VARCHAR
        (100) NOT NULL,
    nik VARCHAR
        (20) NOT NULL UNIQUE,
    jenis_kelamin ENUM
        ('Laki-laki', 'Perempuan') NOT NULL,
    umur INT,
    pendidikan_terakhir VARCHAR
        (50),
    alamat TEXT,
    no_hp VARCHAR
        (20),
    email VARCHAR
        (100),

    -- Data Keluarga
    status_pernikahan ENUM
        ('Menikah', 'Belum Menikah', 'Cerai'),
    jumlah_tanggungan INT,
    keluarga_bantu_usaha ENUM
        ('Ya', 'Tidak'),

    -- Data Usaha
    nama_usaha VARCHAR
        (100) NOT NULL,
    jenis_usaha VARCHAR
        (100),
    lama_usaha INT,
    alamat_usaha TEXT,
    jumlah_karyawan INT,
    omset_per_bulan DECIMAL
        (15,2),
    modal_awal DECIMAL
        (15,2),
    media_pemasaran ENUM
        ('Offline', 'Online', 'Keduanya'),
    status_legalitas ENUM
        ('Sudah', 'Belum'),

    -- Checklist Tambahan
    memiliki_npwp BOOLEAN,
    memiliki_izin_usaha BOOLEAN,
    menggunakan_teknologi BOOLEAN,
    ekspor_produk BOOLEAN,

    -- Kategori hasil klasifikasi otomatis
    kategori_usaha ENUM
        ('Subsisten', 'Potensial', 'Digital', 'Ekspor'),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Foreign Key
    FOREIGN KEY
        (user_id) REFERENCES users
        (id) ON
        DELETE CASCADE
);

        -- Contoh Akun Admin (password = admin123)
        INSERT INTO users
            (nama_lengkap, email, password, role)
        VALUES
            ('Admin SIPUMA', 'admin@sipuma.local', '$2y$10$gDdRQj/0KYCT.r4WegY8x.jexLEqTRv1NBD1j5X0FOvvYHn/8AD7W', 'admin');
