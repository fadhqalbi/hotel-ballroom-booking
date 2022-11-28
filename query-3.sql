USE hotel;

/*customer*/
delimiter $$
CREATE PROCEDURE selectCustomers()
BEGIN
	SELECT * FROM customer;
END
$$

CREATE PROCEDURE insertCustomers(no_c CHAR(6),nama_c VARCHAR(250),a_c VARCHAR(250),k_c VARCHAR(50),e_c VARCHAR(50),hp_c CHAR(12))
BEGIN
	INSERT INTO customer(no_customer,nama_customer,alamat,kota,email,hp) VALUES (no_c,nama_c,a_c,k_c,e_c,hp_c);
END
$$

CREATE PROCEDURE updateCustomers(no_c CHAR(6),nama_c VARCHAR(250),a_c VARCHAR(250),k_c VARCHAR(50),e_c VARCHAR(50),hp_c CHAR(12))
BEGIN
	UPDATE customer 
	SET nama_customer=nama_c, alamat=a_c,kota=k_c,email=e_c,hp=hp_c
	WHERE no_customer=no_c;
END
$$

CREATE PROCEDURE deleteCustomers(no_c CHAR(6))
BEGIN
	DELETE from customer
	WHERE no_customer=no_c;
END
$$ delimiter;

CALL insertCustomers('CJ0001','Jennie','Ketintang','Kota Surabaya','jennie@live.com','000000000001');
CALL insertCustomers('CJ0002','Jisoo','Jiwan','Kota Madiun','jisoo@live.com','000000000002');
CALL insertCustomers('CR0001','Rose','Pare','Kota Kediri','cust@live.com','000000000003');
CALL updateCustomers('CR0001','Rose','Pare','Kota Kediri','rose@live.com','000000000033');
CALL deleteCustomers('CJ0001');
CALL selectCustomers();
