CREATE DATABASE hotel;
USE hotel;

/*==============================================================*/
/* Table: booking                                               */
/*==============================================================*/
create table booking
(
   no_booking           varchar(11) not null  comment '',
   nama_user            varchar(250)  comment '',
   no_customer          VARCHAR(65)  comment '',
   tgl_booking          date  comment '',
   primary key (no_booking)
);

/*==============================================================*/
/* Table: booking_detail                                        */
/*==============================================================*/
create table booking_detail
(
   no_booking           varchar(11)  comment '',
   kode_ruang           char(3)  comment '',
   tgl_penggunaan_ruang date  comment '',
   lama_booking         int  comment ''
);

/*==============================================================*/
/* Table: customer                                              */
/*==============================================================*/
create table customer
(
   no_customer          VARCHAR(6) not null  comment '',
   nama_customer        varchar(250)  comment '',
   alamat               varchar(250)  comment '',
   kota                 varchar(50)  comment '',
   email                varchar(50)  comment '',
   hp                   char(12)  comment '',
   primary key (no_customer)
);

/*==============================================================*/
/* Table: ruang                                                 */
/*==============================================================*/
create table ruang
(
   kode_ruang           char(3) not null  comment '',
   nama_ruang           varchar(50)  comment '',
   kapasitas_maks       int  comment '',
   lokasi_lantai        int  comment '',
   foto                 varchar(250)  comment '',
   primary key (kode_ruang)
);

/*==============================================================*/
/* Table: summary_booking                                       */
/*==============================================================*/
create table summary_booking
(
   kode_ruang           char(3)  comment '',
   jumlah_booking_ruang int  comment '',
   bulan_tahun          VARCHAR(50)  comment ''
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
   nama_user            varchar(250) not null  comment '',
   email                varchar(50)  comment '',
   password             varchar(250)  comment '',
   hp                   char(12)  comment '',
   primary key (nama_user)
);

alter table booking add constraint fk_booking_has1_user foreign key (nama_user)
      references user (nama_user) on delete restrict on update restrict;

alter table booking add constraint fk_booking_has2_customer foreign key (no_customer)
      references customer (no_customer) on delete restrict on update restrict;

alter table booking_detail add constraint fk_booking__has3_booking foreign key (no_booking)
      references booking (no_booking) on delete cascade on update RESTRICT;
      
/*alter table booking_detail add constraint fk_booking__has3_booking foreign key (no_booking)
      references booking (no_booking) on delete restrict on update restrict;*/

alter table booking_detail add constraint fk_booking__has4_ruang foreign key (kode_ruang)
      references ruang (kode_ruang) on delete restrict on update restrict;

alter table summary_booking add constraint fk_summary__has5_ruang foreign key (kode_ruang)
      references ruang (kode_ruang) on delete restrict on update restrict;


