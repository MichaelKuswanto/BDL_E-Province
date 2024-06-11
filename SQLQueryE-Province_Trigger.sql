-- Trigger Update/Insert finish date
CREATE TRIGGER TriggerUpdatePengajuanSertifikat
  ON [dbo].[PengajuanSertifikat]
  FOR UPDATE, INSERT
AS
  BEGIN
    DECLARE @finish_date DATETIME
    DECLARE @NIK VARCHAR(20)
    DECLARE @id_instansi VARCHAR(8)
    DECLARE @jenis_sertifikat INT
    SELECT @finish_date = finish_date, @NIK = NIK, @id_instansi = id_instansi, @jenis_sertifikat = CAST(jenis_sertifikat AS INT)
    FROM inserted

    IF @finish_date IS NOT NULL
    BEGIN
      UPDATE PengajuanSertifikat
      SET status_sertifikat = 'Disetujui'
      WHERE NIK = @NIK AND id_instansi = @id_instansi AND CAST(jenis_sertifikat AS INT) = @jenis_sertifikat;

      DECLARE @currentDate DATETIME = GETDATE();
      DECLARE @newCertificateID VARCHAR(14);
      DECLARE @certificateCount INT;

      SELECT @certificateCount = COUNT(*) + 1
      FROM Sertifikat
      WHERE CONVERT(VARCHAR(8), tanggal_penerbitan, 112) = CONVERT(VARCHAR(8), @currentDate, 112);

      SET @newCertificateID = RIGHT('000' + CAST(@jenis_sertifikat AS VARCHAR(3)), 3) +
                              CONVERT(VARCHAR(8), @currentDate, 112) +
                              RIGHT('000' + CAST(@certificateCount AS VARCHAR(3)), 3);

      INSERT INTO Sertifikat (
        id_sertifikat,
        NIK,
        id_instansi,
        jenis_sertifikat,
        tanggal_penerbitan,
        tanggal_kedaluwarsa,
        status_sertifikat,
        created_at
      )
      VALUES (
        @newCertificateID,
        @NIK,
        @id_instansi,
        @jenis_sertifikat,
        @currentDate,
        DATEADD(YEAR, 5, @currentDate),
        'Aktif',
        @currentDate
      );
    END;
  END;

-- Trigger Record Pengambilan Sertifikat
CREATE TRIGGER RecordPengambilanSertifikat
	ON [dbo].[Sertifikat]
	FOR UPDATE
AS
BEGIN
  	declare @nama_pengambil varchar(50)
  	declare @id_sertifikat varchar(12)
  	select @nama_pengambil=nama_pengambil, @id_sertifikat=id_sertifikat from inserted
	
	IF @nama_pengambil IS NOT NULL
  	BEGIN
    	UPDATE Sertifikat
    	SET tgl_pengambilan = GETDATE()
    	WHERE id_sertifikat = @id_sertifikat;
  	END;
END

CREATE TRIGGER HitungUsia
	ON [dbo].[Penduduk]
	FOR INSERT
AS
BEGIN
	DECLARE @tanggal_lahir date
	DECLARE @tanggal_sekarang datetime = GETDATE()
	DECLARE @NIK varchar(20)

	select @tanggal_lahir=tanggal_lahir, @NIK=NIK from inserted

	BEGIN
		UPDATE Penduduk
        SET usia = DATEDIFF(YEAR, @tanggal_lahir, @tanggal_sekarang)
        WHERE NIK = @NIK;
	END
END