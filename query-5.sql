USE hotel;

DELIMITER $$
CREATE TRIGGER `summary_in` 
AFTER INSERT ON `booking_detail` FOR EACH ROW 
BEGIN  
	DECLARE bulan VARCHAR (15);
	DECLARE tahun INT;
	DECLARE bulantahun VARCHAR (50);
	SET bulan = MONTHNAME(NEW.tgl_penggunaan_ruang);
	SET tahun = YEAR(NEW.tgl_penggunaan_ruang);
	SET bulantahun = CONCAT(bulan,' ',tahun);
	
   IF bulantahun = (SELECT bulan_tahun FROM summary_booking WHERE kode_ruang=NEW.kode_ruang)
	THEN
		UPDATE summary_booking
		SET jumlah_booking_ruang = jumlah_booking_ruang + NEW.lama_booking
		WHERE kode_ruang=NEW.kode_ruang AND bulan_tahun = bulantahun;
   ELSE
      INSERT INTO summary_booking (kode_ruang,jumlah_booking_ruang,bulan_tahun) 
		VALUES (NEW.kode_ruang, NEW.lama_booking,bulantahun);
	END IF;
END
$$ DELIMITER ;


summary_bookingINSERT INTO booking(no_booking,nama_user,no_customer,tgl_booking)
VALUES ('INV20229999','user1','CR0001','2022-11-27');
INSERT INTO booking_detail(no_booking,kode_ruang,tgl_penggunaan_ruang,lama_booking)
VALUES ('INV20229999','901','2022-12-31',1);ruang