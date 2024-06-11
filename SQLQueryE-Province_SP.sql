--Store Procedure Insert

--Tabel Penduduk
CREATE PROCEDURE InsertPenduduk
	@NIK VARCHAR(20),
	@nama VARCHAR(50),
	@alamat VARCHAR(255),
	@tanggal_lahir DATETIME,
	@nomor_telepon VARCHAR(20),
	@email VARCHAR(50)
AS
BEGIN
	IF EXISTS (SELECT 1 FROM Penduduk WHERE NIK = @NIK)
	BEGIN
    	PRINT 'NIK sudah terdaftar';
	END
	ELSE
	BEGIN
    	INSERT INTO Penduduk (NIK, nama, alamat, tanggal_lahir, nomor_telepon, email)
    	VALUES (@NIK, @nama, @alamat, @tanggal_lahir, @nomor_telepon, @email);

    	PRINT 'Data Penduduk berhasil ditambahkan';
	END
END;



--Tabel Sertifikat
CREATE PROCEDURE InsertSertifikat
    @id_sertifikat VARCHAR(12),
    @NIK VARCHAR(20),
    @id_instansi VARCHAR(8),
    @jenis_sertifikat VARCHAR(5),
    @tanggal_penerbitan DATETIME,
    @tanggal_kedaluwarsa DATETIME,
    @status_sertifikat VARCHAR(20)
AS
BEGIN
    INSERT INTO Sertifikat (id_sertifikat, NIK, id_instansi, jenis_sertifikat, tanggal_penerbitan, tanggal_kedaluwarsa, status_sertifikat)
    VALUES (@id_sertifikat, @NIK, @id_instansi, @jenis_sertifikat, @tanggal_penerbitan, @tanggal_kedaluwarsa, @status_sertifikat);
END;


--Tabel Pengajuan Sertifikat
CREATE PROCEDURE InsertPengajuanSertifikat
    @NIK VARCHAR(20),
    @id_instansi VARCHAR(8),
    @jenis_sertifikat VARCHAR(5),
    @request_date DATETIME,
    @status_sertifikat VARCHAR(20),
    @catatan VARCHAR(255)
AS
BEGIN
    DECLARE @id_pengajuan VARCHAR(30);
    DECLARE @currentDate DATETIME = GETDATE();
    DECLARE @requestCount INT;

    SELECT @requestCount = COUNT(*) + 1
    FROM PengajuanSertifikat
    WHERE CONVERT(VARCHAR(8), request_date, 112) = CONVERT(VARCHAR(8), @currentDate, 112);

    SET @id_pengajuan = 'P' + CONVERT(VARCHAR(8), @currentDate, 112) +
                        RIGHT('00000' + CAST(@requestCount AS VARCHAR(5)), 5);

    INSERT INTO PengajuanSertifikat (id_pengajuan, NIK, id_instansi, jenis_sertifikat, request_date, status_sertifikat, catatan)
    VALUES (@id_pengajuan, @NIK, @id_instansi, @jenis_sertifikat, @request_date, @status_sertifikat, @catatan);
END;


--Tabel Instansi Pemerintahan
CREATE PROCEDURE InsertInstansiPemerintah
    @id_instansi VARCHAR(8),
    @nama_instansi VARCHAR(50),
    @alamat_instansi VARCHAR(255),
    @nomor_telepon_instansi VARCHAR(20),
    @email_instansi VARCHAR(50)
AS
BEGIN
    INSERT INTO InstansiPemerintah (id_instansi, nama_instansi, alamat_instansi, nomor_telepon_instansi, email_instansi)
    VALUES (@id_instansi, @nama_instansi, @alamat_instansi, @nomor_telepon_instansi, @email_instansi);
END;


--Tabel Jenis Sertifikat
CREATE PROCEDURE InsertJenisSertifikat
    @id_jenis_sertifikat VARCHAR(5),
    @nama_jenis_sertifikat VARCHAR(50)

AS
BEGIN
    INSERT INTO JenisSertifikat (id_jenis_sertifikat, nama_jenis_sertifikat)
    VALUES (@id_jenis_sertifikat, @nama_jenis_sertifikat);
END;


--Store Procedure Update

--Tabel Penduduk
CREATE PROCEDURE UpdatePenduduk (
    @NIK VARCHAR(20),
    @nama VARCHAR(50),
    @alamat VARCHAR(255),
    @tanggal_lahir DATE,
    @nomor_telepon VARCHAR(20),
    @email VARCHAR(50)
)
AS
BEGIN
    UPDATE Penduduk
    SET nama = @nama, alamat = @alamat, tanggal_lahir = @tanggal_lahir, nomor_telepon = @nomor_telepon, email = @email, updated_at = GETDATE()
    WHERE NIK = @NIK;
END;

--Tabel Sertifikat
CREATE PROCEDURE UpdateSertifikat (
    @id_sertifikat VARCHAR(12),
    @NIK VARCHAR(20),
    @id_instansi VARCHAR(8),
    @jenis_sertifikat VARCHAR(5),
    @tanggal_penerbitan DATETIME,
    @tanggal_kedaluwarsa DATETIME,
    @status_sertifikat VARCHAR(20)
)
AS
BEGIN
    UPDATE Sertifikat
    SET NIK = @NIK, id_instansi = @id_instansi, jenis_sertifikat = @jenis_sertifikat, tanggal_penerbitan = @tanggal_penerbitan, tanggal_kedaluwarsa = @tanggal_kedaluwarsa, status_sertifikat = @status_sertifikat, updated_at = GETDATE()
    WHERE id_sertifikat = @id_sertifikat;
END;

--Tabel Pengajuan Sertifikat
CREATE PROCEDURE UpdatePengajuanSertifikat (
    @id_pengajuan VARCHAR(30),
    @NIK VARCHAR(20),
    @id_instansi VARCHAR(8),
    @jenis_sertifikat VARCHAR(5),
    @request_date DATETIME,
    @finish_date DATETIME,
    @status_sertifikat VARCHAR(20),
    @catatan VARCHAR(255)
)
AS
BEGIN
    UPDATE PengajuanSertifikat
    SET NIK = @NIK, id_instansi = @id_instansi, jenis_sertifikat = @jenis_sertifikat, request_date = @request_date, finish_date = @finish_date, status_sertifikat = @status_sertifikat, catatan = @catatan, updated_at = GETDATE()
    WHERE id_pengajuan = @id_pengajuan;
END;

--Tabel Instansi Pemerintahan
CREATE PROCEDURE UpdateInstansiPemerintah (
    @id_instansi VARCHAR(8),
    @nama_instansi VARCHAR(50),
    @alamat_instansi VARCHAR(255),
    @nomor_telepon_instansi VARCHAR(20),
    @email_instansi VARCHAR(50)
)
AS
BEGIN
    UPDATE InstansiPemerintah
    SET nama_instansi = @nama_instansi, alamat_instansi = @alamat_instansi, nomor_telepon_instansi = @nomor_telepon_instansi, email_instansi = @email_instansi, updated_at = GETDATE()
    WHERE id_instansi = @id_instansi;
END;

--Tabel Jenis Sertifikat
CREATE PROCEDURE UpdateJenisSertifikat (
    @id_jenis_sertifikat VARCHAR(5),
    @nama_jenis_sertifikat VARCHAR(50)
)
AS
BEGIN
    UPDATE JenisSertifikat
    SET nama_jenis_sertifikat = @nama_jenis_sertifikat, updated_at = GETDATE()
    WHERE id_jenis_sertifikat = @id_jenis_sertifikat;
END;


--Store Procedure Delete

--Tabel Penduduk
CREATE PROCEDURE DeletePenduduk (
    @NIK VARCHAR(20)
)
AS
BEGIN
    DELETE FROM Penduduk
    WHERE NIK = @NIK;
END;

--Tabel Sertifikat
CREATE PROCEDURE DeleteSertifikat (
    @id_sertifikat VARCHAR(8)
)
AS
BEGIN
    DELETE FROM Sertifikat
    WHERE id_sertifikat = @id_sertifikat;
END;

--Tabel Pengajuan Sertifikat
CREATE PROCEDURE DeletePengajuanSertifikat (
    @id_pengajuan VARCHAR(30)
)
AS
BEGIN
    DELETE FROM PengajuanSertifikat
    WHERE id_pengajuan = @id_pengajuan;
END;

-- Tabel Instansi Pemerintahan
CREATE PROCEDURE DeleteInstansiPemerintah (
    @id_instansi VARCHAR(8)
)
AS
BEGIN
    DELETE FROM InstansiPemerintah
    WHERE id_instansi = @id_instansi;
END;

-- Tabel Jenis Sertifikat
CREATE PROCEDURE DeleteJenisSertifikat (
    @id_jenis_sertifikat VARCHAR(5)
)
AS
BEGIN
    DELETE FROM JenisSertifikat
    WHERE id_jenis_sertifikat = @id_jenis_sertifikat;
END;


CREATE PROCEDURE PengajuanPerPeriode (
	@tgl_awal DATETIME,
	@tgl_akhir DATETIME
)
AS
BEGIN
	SELECT * FROM View_Pengajuan_Per_Periode
	WHERE request_date BETWEEN @tgl_awal AND @tgl_akhir
END