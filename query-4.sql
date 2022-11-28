USE hotel;

/*FUNCTION*/
delimiter $$
CREATE FUNCTION generateNoCust(nama_customer VARCHAR(250))
RETURNS CHAR(6)
BEGIN
	DECLARE firstalphaname CHAR(1);
	DECLARE lastnum INT;
	SET firstalphaname = LEFT(nama_customer,1);
	SET lastnum = (
		SELECT RIGHT(MAX(no_customer),4)
		FROM customer
		WHERE no_customer LIKE CONCAT('C',firstalphaname,'%')
		);

	if (lastnum IS NULL) then
		SET lastnum = 1;
	else
		SET lastnum = lastnum + 1;
	END if;
	
	RETURN CONCAT('C',firstalphaname,LPAD(lastnum,4,'0'));
END
$$ delimiter;

/*PROCEDURE*/
delimiter $$
CREATE PROCEDURE insertCustomers2(nama_c VARCHAR(250),a_c VARCHAR(250),k_c VARCHAR(50),e_c VARCHAR(50),hp_c CHAR(12))
BEGIN
	INSERT INTO customer(no_customer,nama_customer,alamat,kota,email,hp) VALUES (generateNoCust(nama_c),nama_c,a_c,k_c,e_c,hp_c);
END
$$ delimiter;

CALL insertCustomers2('Jennie','Mojokerto','Kota Mojokerto','jennie@live.com','000000000004');
CALL insertCustomers2('Lisa','Blitar','Kota Blitar','lisa@live.com','000000000005');
SELECT * FROM customer;



