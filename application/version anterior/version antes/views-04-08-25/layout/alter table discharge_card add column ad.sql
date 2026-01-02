alter table discharge_card add column admitting_diagnosis text null
alter table discharge_card add column discharge_diagnosis text null
alter table discharge_card add column performed_procedures text null
alter table discharge_card add column findings text null
alter table discharge_card add column treatment text null
alter table discharge_card add column case_death text null
alter table discharge_card add column treatment_appointment text null

alter table hoja_ingreso add column visit_details_id text null
alter table hoja_ingreso add column admitting_diagnosis text null
alter table hoja_ingreso add column diagnostico text null

alter table hoja_ingreso add column date datetime null
alter table hoja_ingreso add column generated_by integer null
alter table hoja_ingreso add column prescribe_by integer null

create table formulario_interconsulta (
id INT NOT NULL AUTO_INCREMENT,
admitting_diagnosis text null,
motivo_interconsulta text null,
servicio_solicita text null,
servicio_interconsulta text null,
evaluacion_interconsulta text null,
recomendaciones text null,
date datetime null,
generated_by integer null,
prescribe_by integer null
visit_details_id integer null
)

alter table purchase_order add column documents text null
alter table purchase_order add column generated_by INT null

create table purchase_order (
  id INT NOT NULL AUTO_INCREMENT,
  purchase_order_date date null,
  reference_number varchar(255) null,
  purchase_order_description varchar(255) null,  
  supplier_id INT null,
  purchase_status INT null,
  total_expenditure FLOAT(10, 2) null,
  documents_other  text null,
  payment_date date null,
  PRIMARY KEY (`id`)
);

create table purchase_order_item_store (
 id INT NOT NULL AUTO_INCREMENT,
purchase_order_id  integer,
item_store_id integer,
amount float null,
cost float null,
PRIMARY KEY (`id`)
);

create table purchase_status (
    id INT NOT NULL AUTO_INCREMENT,
    purchase_status_name varchar(255) null,
  PRIMARY KEY (`id`)
);

alter table purchase_order add column documents_other  text null
alter table purchase_order add column payment_date date null

alter table purchase_order_item_store add column amount float null
alter table purchase_order_item_store add column cost float null

create table purchase_status (
    id INT NOT NULL AUTO_INCREMENT,
    purchase_status_name varchar(255) null,
  PRIMARY KEY (`id`)
);

insert into purchase_status (purchase_status_name) values 
('Pendiente'),
('Recibido'),
('Solicitado'),
('Pagado')

create table admission_note (
    id INT NOT NULL AUTO_INCREMENT,
    ipd_id int null,
    staff_id int null,
    note text null,
    updated_at datetime null,
    date datetime null,
  PRIMARY KEY (`id`)
);
-- alter table admission_note add column date datetime null


create table type_description(
    id INT NOT NULL AUTO_INCREMENT,
    type_description_name varchar(255) null,
    PRIMARY KEY (`id`)
);

insert into type_description (type_description_name) values
('Recibimineto Corto'),
('Recibimineto Largo'),
('Nota Prequirúrgica'),
('Descripción del Parto'),
('Descripción de Salpingoclasia Vaginal'),
('Descripción de Salpingoclasia Adominal'),
('Descripción de Cesaría'),
('Descripción de Colpoperineorrafia Posterior'),
('Descripción de Colpoperineorrafia Anterior '),
('Descripción de Colpoperineorrafia Anterior y posterior'),
('Descripción de Histerectomia Abdominal'),
('Descripción de Histerectomia Vaginal'),
('Descripción de Degrado')

create table description_comment (
    id INT NOT NULL AUTO_INCREMENT,
    ipd_id int null,
    staff_id int null,
    type_description_id int null,
    note text null,
    updated_at datetime null,
    date datetime null,
  PRIMARY KEY (`id`)
);

delete_description_comment
add_description_comment