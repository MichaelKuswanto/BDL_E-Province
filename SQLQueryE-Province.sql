-- Create Table
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
	id_sertifikat VARCHAR(12) PRIMARY KEY NOT NULL,
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

-- Tambahan Revisi Atribut
ALTER TABLE Sertifikat
ADD tgl_pengambilan DATETIME NULL;

ALTER TABLE Sertifikat
ADD nama_pengambil VARCHAR(50) NULL;

ALTER TABLE Penduduk
ADD usia INT NULL;

ALTER TABLE Penduduk
ADD status_pengaju VARCHAR(20) NULL;

ALTER TABLE PengajuanSertifikat
ADD syarat_pengajuan VARCHAR(255) NULL;

ALTER TABLE InstansiPemerintah
ADD kota VARCHAR(50) NULL;

-- Tambah Foreign Keys
ALTER TABLE Sertifikat
ADD FOREIGN KEY (jenis_sertifikat) REFERENCES JenisSertifikat(id_jenis_sertifikat);

ALTER TABLE PengajuanSertifikat
ADD FOREIGN KEY (jenis_sertifikat) REFERENCES JenisSertifikat(id_jenis_sertifikat);


ALTER TABLE Sertifikat
ADD FOREIGN KEY (id_instansi) REFERENCES InstansiPemerintah(id_instansi);

ALTER TABLE PengajuanSertifikat
ADD FOREIGN KEY (id_instansi) REFERENCES InstansiPemerintah(id_instansi);

-- Data Penduduk
INSERT INTO Penduduk (NIK, nama, alamat, tanggal_lahir, nomor_telepon, email)
VALUES
  ('1234567890123456', 'John Doe', 'Jalan Anyar No 10', '1990-01-01', '022-12345678', 'john.doe@example.com'),
  ('9876543210987654', 'Jane Doe', 'Jalan Baru No 20', '1995-05-21', '022-87654321', 'jane.doe@example.com'),
  ('0000000000000000', 'Admin', 'Jalan Admin', '2000-01-01', '022-99999999', 'admin@localhost.com');

-- Data Instansi Pemerintah
INSERT INTO InstansiPemerintah (id_instansi, nama_instansi, alamat_instansi, nomor_telepon_instansi, email_instansi)
VALUES
  ('INST001', 'Kantor Imigrasi', 'Jalan Imigrasi No 1', '022-4567890', 'imigrasi@bandung.go.id'),
  ('INST002', 'Disdukcapil Kota Bandung', 'Jalan disdukcapil No 2', '022-1231234', 'disdukcapil@bandung.go.id'),
  ('INST003', 'Kantor Pos Indonesia', 'Jalan Pos No 3', '022-7897890', 'posindonesia@bandung.go.id');

-- Data Jenis Serfifikat
EXEC [dbo].[InsertJenisSertifikat] '001', 'Akta Kelahiran'
EXEC [dbo].[InsertJenisSertifikat] '002', 'Akta Kematian'
EXEC [dbo].[InsertJenisSertifikat] '003', 'Ijazah'
EXEC [dbo].[InsertJenisSertifikat] '004', 'Sertifikat Pelatihan';
EXEC [dbo].[InsertJenisSertifikat] '005', 'Sertifikat Keahlian';
EXEC [dbo].[InsertJenisSertifikat] '006', 'Surat Izin Usaha Perdagangan (SIUP)';
EXEC [dbo].[InsertJenisSertifikat] '007', 'Tanda Daftar Perusahaan (TDP)';
EXEC [dbo].[InsertJenisSertifikat] '008', 'Surat Izin Mengemudi (SIM)';
EXEC [dbo].[InsertJenisSertifikat] '009', 'Buku Pemilik Kendaraan Bermotor (BPKB)';
EXEC [dbo].[InsertJenisSertifikat] '010', 'Surat Tanda Nomor Kendaraan (STNK)';
EXEC [dbo].[InsertJenisSertifikat] '011', 'Kartu Keluarga';
EXEC [dbo].[InsertJenisSertifikat] '012', 'Kartu Tanda Penduduk';
EXEC [dbo].[InsertJenisSertifikat] '013', 'Surat Keterangan Tempat Tinggal';

-- Data Dummy Sertifikat
INSERT INTO Sertifikat (id_sertifikat, NIK, id_instansi, jenis_sertifikat, tanggal_penerbitan, tanggal_kedaluwarsa, status_sertifikat)
VALUES
  ('SERT0001', '1234567890123456', 'INST001', '001', '2024-05-21', '2029-05-21', 'Aktif'),
  ('SERT0002', '9876543210987654', 'INST002', '002', '2024-05-21', '2034-05-21', 'Aktif'),
  ('SERT0003', '1234567890123456', 'INST003', '003', '2024-05-21', '2039-05-21', 'Aktif'),
  ('SERT0004', '9876543210987654', 'INST001', '004', '2024-05-21', '2029-05-21', 'Aktif'),
  ('SERT0005', '1234567890123456', 'INST002', '005', '2024-05-21', '2034-05-21', 'Aktif');

-- Data Dummy Pengajuan Sertifikat
INSERT INTO PengajuanSertifikat (id_pengajuan, NIK, id_instansi, jenis_sertifikat, request_date, status_sertifikat, catatan)
VALUES
  ('PENGAJUAN0001', '1234567890123456', 'INST001', '001', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Surat Keterangan Tempat Tinggal'),
  ('PENGAJUAN0002', '9876543210987654', 'INST002', '002', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Keluarga'),
  ('PENGAJUAN0003', '1234567890123456', 'INST003', '003', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Tanda Penduduk'),
  ('PENGAJUAN0004', '9876543210987654', 'INST001', '004', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Surat Keterangan Tempat Tinggal'),
  ('PENGAJUAN0005', '1234567890123456', 'INST002', '005', '2024-05-21', 'Menunggu Verifikasi', 'Permohonan Kartu Keluarga');

EXEC [dbo].[InsertPenduduk] '1234567890123458', 'John Doe', 'Jalan Anyar No 10', '1990-01-01', '022-12345678', 'john.doe@example.com'

SELECT * FROM [dbo].[View_Jumlah_Pengerjaan_Instansi]
SELECT * FROM [dbo].[View_Pengajuan_Jenis_Sertifikat]
SELECT * FROM [dbo].[View_Pengajuan_Per_Periode]

SELECT * FROM PengajuanSertifikat
SELECT * FROM Sertifikat

UPDATE PengajuanSertifikat
SET finish_date = '2024-05-29'
WHERE id_pengajuan = 'PENGAJUAN0001'

SELECT * FROM PengajuanSertifikat

EXEC [dbo].[PengajuanPerPeriode] '2024-05-21', '2024-06-05'

SELECT * FROM Sertifikat

UPDATE Sertifikat
SET nama_pengambil = 'Michael'
WHERE id_sertifikat = 'SERT0003'

SELECT * FROM Sertifikat

EXEC [dbo].[InsertPenduduk] '1234567890123458', 'John Doe', 'Jalan Anyar No 10', '1990-01-01', '022-12345678', 'john.doe@example.com'
SELECT * FROM Penduduk