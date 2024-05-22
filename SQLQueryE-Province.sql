CREATE TABLE Penduduk (
	NIK VARCHAR(20) PRIMARY KEY NOT NULL,
	nama VARCHAR(50) NOT NULL,
	alamat VARCHAR(255) NOT NULL,
	tanggal_lahir DATE NOT NULL, 
	nomor_telepon VARCHAR(20) NOT NULL,
	email VARCHAR(50) NOT NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE Sertifikat (
	id_sertifikat VARCHAR(8) PRIMARY KEY NOT NULL,
	NIK VARCHAR(20) NOT NULL,
	id_instansi VARCHAR(8) NOT NULL,
	jenis_sertifikat VARCHAR(5) NOT NULL,
	tanggal_penerbitan DATETIME NOT NULL,
	tanggal_kedaluwarsa DATETIME NOT NULL,
	status_sertifikat VARCHAR(20) NOT NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
	FOREIGN KEY (NIK) REFERENCES Penduduk(NIK)
);

CREATE TABLE PengajuanSertifikat (
	id_pengajuan VARCHAR(30) PRIMARY KEY NOT NULL,
	NIK VARCHAR(20) NOT NULL,
	id_instansi VARCHAR(8) NOT NULL,
	jenis_sertifikat VARCHAR(5) NOT NULL,
	request_date DATETIME NOT NULL,
	finish_date DATETIME,
	status_sertifikat VARCHAR(20) NOT NULL,
	catatan VARCHAR(255),
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE(),
	FOREIGN KEY (NIK) REFERENCES Penduduk(NIK)
);

CREATE TABLE InstansiPemerintah (
	id_instansi VARCHAR(8) PRIMARY KEY NOT NULL,
	nama_instansi VARCHAR(50) NOT NULL,
	alamat_instansi VARCHAR(255) NOT NULL,
	nomor_telepon_instansi VARCHAR(20) NOT NULL,
	email_instansi VARCHAR(50) NOT NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE()
);

CREATE TABLE JenisSertifikat (
	id_jenis_sertifikat VARCHAR(5) PRIMARY KEY NOT NULL,
	nama_jenis_sertifikat VARCHAR(50) NOT NULL,
	created_at DATETIME DEFAULT GETDATE(),
	updated_at DATETIME DEFAULT GETDATE()
);

ALTER TABLE Sertifikat
ADD FOREIGN KEY (jenis_sertifikat) REFERENCES JenisSertifikat(id_jenis_sertifikat);

ALTER TABLE PengajuanSertifikat
ADD FOREIGN KEY (jenis_sertifikat) REFERENCES JenisSertifikat(id_jenis_sertifikat);


ALTER TABLE Sertifikat
ADD FOREIGN KEY (id_instansi) REFERENCES InstansiPemerintah(id_instansi);

ALTER TABLE PengajuanSertifikat
ADD FOREIGN KEY (id_instansi) REFERENCES InstansiPemerintah(id_instansi);

-- Data Dummy Penduduk
INSERT INTO Penduduk (NIK, nama, alamat, tanggal_lahir, nomor_telepon, email)
VALUES
  ('1234567890123456', 'John Doe', 'Jalan Anyar No 10', '1990-01-01', '022-12345678', 'john.doe@example.com'),
  ('9876543210987654', 'Jane Doe', 'Jalan Baru No 20', '1995-05-21', '022-87654321', 'jane.doe@example.com'),
  ('0000000000000000', 'Admin', 'Jalan Admin', '2000-01-01', '022-99999999', 'admin@localhost.com');

-- Data Dummy Instansi Pemerintah
INSERT INTO InstansiPemerintah (id_instansi, nama_instansi, alamat_instansi, nomor_telepon_instansi, email_instansi)
VALUES
  ('INST001', 'Kantor Imigrasi', 'Jalan Imigrasi No 1', '022-4567890', 'imigrasi@bandung.go.id'),
  ('INST002', 'Disdukcapil Kota Bandung', 'Jalan disdukcapil No 2', '022-1231234', 'disdukcapil@bandung.go.id'),
  ('INST003', 'Kantor Pos Indonesia', 'Jalan Pos No 3', '022-7897890', 'posindonesia@bandung.go.id');

-- Data Dummy Jenis Serfifikat
INSERT INTO JenisSertifikat (id_jenis_sertifikat, nama_jenis_sertifikat)
VALUES
  ('SKTM', 'Surat Keterangan Tempat Tinggal'),
  ('KK', 'Kartu Keluarga'),
  ('KTP', 'Kartu Tanda Penduduk');

-- Data Dummy Sertifikat
INSERT INTO Sertifikat (id_sertifikat, NIK, id_instansi, jenis_sertifikat, tanggal_penerbitan, tanggal_kedaluwarsa, status_sertifikat)
VALUES
  ('SERT0001', '1234567890123456', 'INST001', 'SKTM', '2024-05-21', '2029-05-21', 'Aktif'),
  ('SERT0002', '9876543210987654', 'INST002', 'KK', '2024-05-21', '2034-05-21', 'Aktif'),
  ('SERT0003', '1234567890123456', 'INST003', 'KTP', '2024-05-21', '2039-05-21', 'Aktif'),
  ('SERT0004', '9876543210987654', 'INST001', 'SKTM', '2024-05-21', '2029-05-21', 'Aktif'),
  ('SERT0005', '1234567890123456', 'INST002', 'KK', '2024-05-21', '2034-05-21', 'Aktif');

-- Data Dummy Pengajuan Sertifikat
INSERT INTO PengajuanSertifikat (id_pengajuan, NIK, id_instansi, jenis_sertifikat, request_date, status_sertifikat, catatan)
VALUES
  ('PENGAJUAN0001', '1234567890123456', 'INST001', 'SKTM', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Surat Keterangan Tempat Tinggal'),
  ('PENGAJUAN0002', '9876543210987654', 'INST002', 'KK', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Keluarga'),
  ('PENGAJUAN0003', '1234567890123456', 'INST003', 'KTP', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Tanda Penduduk'),
  ('PENGAJUAN0004', '9876543210987654', 'INST001', 'SKTM', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Surat Keterangan Tempat Tinggal'),
  ('PENGAJUAN0005', '1234567890123456', 'INST002', 'KK', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Keluarga');
