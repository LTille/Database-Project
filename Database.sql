#create database dbfinal;
use dbfinal;

create table Location( ##how detail the location
            locationId INT AUTO_INCREMENT,
            state VARCHAR(20),
            city VARCHAR(20),
            street VARCHAR(100),
            zip_code INT(5),
            PRIMARY KEY(locationId));

INSERT INTO Location VALUES (1,"Connacht","Galway","420-1002 Molestie Ave","59641"),
                            (2,"Quebec","Trois-Rivires","4859 Elit, Rd.","96730"),
                            (3,"SJ","San Rafael Abajo","Ap #287-5400 Egestas Av.","41626"),
                            (4,"South Island","Nelson","553-1416 Nec St.","23632"),
                            (5,"Tasmania","Devonport","574-7554 Semper Ave","67650"),
                            (6,"SI","Alexandra","6504 Leo, St.","89108"),
                            (7,"Wie","Vienna","P.O. Box 972, 5485 Integer St.","12514"),
                            (8,"Victoria","Geelong","P.O. Box 465, 3661 Sed, Avenue","36008"),
                            (9,"Ankara","Ankara","153-1525 Orci. Street","68091"),
                            (10,"LU","Chełm","900-8420 Enim, St.","45971"),
                            (11,"Madrid","Alcalá de Henares","7016 Sem, Road","58610"),
                            (12,"Kano","Kano","Ap #154-7034 Porttitor Road","28501"),
                            (13,"LX","Bovigny","5583 Facilisis Ave","34828"),
                            (14,"NA","Floreffe","409-5763 Augue St.","66400"),
                            (15,"FL","Orlando","699-598 Rutrum Av.","69393"),
                            (16,"Mer","Silifke","864-3084 Massa. Road","69190"),
                            (17,"NSW","Grafton","7423 Eros. Road","94175"),
                            (18,"Wiltshire","Devizes","4198 Phasellus Av.","24235"),
                            (19,"Emilia-Romagna","Bazzano","Ap #241-3965 Nullam Ave","32140"),
                            (20,"Connacht","Galway","4592 Eu Rd.","45481");

create table Customer(
            accountId VARCHAR(20),
            password VARCHAR (20) NOT NULL,
            name VARCHAR(20) NOT NULL,
            kind enum('H', 'B'),
            address_location INT, ##Does every user have to specify a location?
            PRIMARY KEY (accountId),
        	UNIQUE KEY (accountId, kind),
            FOREIGN KEY (address_location)
            REFERENCES Location(locationId)
            ON DELETE NO ACTION);

INSERT INTO Customer VALUES ("aliquet","UBT44ZPI3XI","Chiquita","H",1),
                            ("in","MQV37CBD7MO","Jacqueline","H",2),
                            ("luctus","FTD67GJN0IO","Sybill","B",3),
                            ("Aenean","LLO94BVB0KH","Justina","B",4),
                            ("ipsum","DPZ03UGM2RN","Lunea","H",5),
                            ("gravida","PPJ25EAK0ON","Kameko","H",6),
                            ("at","WQB51OKN5SV","Otto","H",7),
                            ("erat","TVF72OLO3EW","Orlando","H",8),
                            ("Proin","MYQ14EYK9SU","Miranda","B",9),
                            ("tincidunt","QAJ12JPW4OB","Whoopi","B",10),
                            ("scelerisque","FET39PMN9LT","Lance","H",11),
                            ("Maecenas","GBB73AYH0PY","Tatiana","H",12),
                            ("hendrerit","NHM33KLL7OO","Blake","H",13),
                            ("nec","RCH02ZJF7MZ","Dana","B",14),
                            ("a","DRS66QYS8DD","Quynn","B",15),
                            ("Nunc","FZW44HSC4CB","Colton","H",16),
                            ("eu","FUS12ZKM1QJ","Flavia","B",17),
                            ("elit","UJR90OUD4SE","Lynn","H",18),
                            ("risus","UXJ44ZCI9WU","Cameran","H",19),
                            ("nibh","EAY96VQJ9OY","Marshall","B",20);


create table Business_Customer(
            businessId VARCHAR(20),
        	kind enum('H', 'B'),
            bCategory VARCHAR(30),
            income DOUBLE,
            PRIMARY KEY(businessId),
        	Check (kind=’B’),
            FOREIGN KEY(businessId,kind)
            REFERENCES Customer(accountId,kind)
            ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO Business_Customer VALUES 
                            ("luctus","B","Beauty Supplies",250000),
                            ("Aenean","B","Barber Salons",43000),
                            ("Proin","B","Nail Salon",50000),
                            ("tincidunt","B","Body Works",100000),
                            ("nec","B","Miscellaneous",140000),
                            ("a","B","Cosmetic",150000),
                            ("eu","B","Face care",170000),
                            ("nibh","B","Body Care",200000);

create table Home_Customer(
            homeId VARCHAR(20),
        	kind enum('H', 'B'),
            marriageStatus enum('Single', 'Married', 'Divorced', 'Separated'),
            gender enum('Male', 'Female'),
            age INT,
            income DOUBLE,
            PRIMARY KEY(homeId),
        	Check (kind=’H’),
            FOREIGN KEY (homeId,kind)
            REFERENCES Customer(accountId,kind)
            ON DELETE CASCADE ON UPDATE CASCADE);

INSERT INTO Home_Customer VALUES 
                            ("aliquet","H","Single","Female",25,50000),
                            ("in","H","Divorced","Female",50,35000),
                            ("ipsum","H","Separated","Male",40,80000),
                            ("gravida","H","Married","Female",35,100000),
                            ("at","H","Married","Male",42,150000),
                            ("erat","H","Single","Female",18,25000),
                            ("scelerisque","H","Single","Female",24,45000),
                            ("Maecenas","H","Single","Male",23,70000),
                            ("hendrerit","H","Divorced","Male",43,200000),
                            ("Nunc","H","Single","Female",21,75000),
                            ("elit","H","Separated","Female",29,120000),
                            ("risus","H","Single","Male",30,250000);

Create Table Category(
        categoryID CHAR(10),
		cname Varchar(20) Not Null,
        detail Varchar(50),
		PRIMARY KEY(categoryID));

INSERT INTO Category VALUES ("0000000001","Makeup","It includes face makeup, eye makeup, lips, etc."),
("0000000002","Skin Care","It includes cleanse, moisturize, masks, etc."),
("0000000003","Fragrance","There are two types: for women and for men."),
("0000000004","Bath&Body","It includes body care, bath&shower, etc."),
("0000000005","Nails","It includes nail polish, nail kits, etc."),
("0000000006","Hair","It includes shampoo&conditioner, treatment, etc."),
("0000000007","Tools&Brushes","It includes hair tools, makeup brushes, etc.");

Create Table Product(
        productID CHAR(10),
		pname Varchar(40) Not Null,
        price float Not Null,
        cost float Not Null,
        category_id CHAR(10) Not Null,
	    PRIMARY KEY(productID),
		FOREIGN KEY (category_id) REFERENCES Category (categoryID) On Delete No Action
);

INSERT INTO Product VALUES 
("m000000001","Urban Decay Naked Smoky",54,37.5,"0000000001"),
("m000000002","Waterproof Liquid Eye Liner",22,18.8,"0000000001"),
("m000000003","Fresh Sugar Lip Delight",77,44.4,"0000000001"),
("m000000004","Viseart Eyeshadow Palette",88,50.3,"0000000001"),
("m000000005","Surratt Beauty Prismatique Lips",36,23.7,"0000000001"),
("m000000006","Dior Couture Creations Palette",101.5,79,"0000000001"),
("m000000007","COVER FX Custom Cover Drops",44,28.3,"0000000001"),
("s000000001","Fresh Soy Face Cleanser",38,17.7,"0000000002"),
("s000000002","Philosophy Purity Made Simple",24,18.4,"0000000002"),
("s000000003","SUPERMUD Clearing Treatment",69,48.1,"0000000002"),
("s000000004","SK-II Facial Treatment Essence",321,230.2,"0000000002"),
("s000000005","Black Tea Instant Perfecting Mask",92,68.4,"0000000002"),
("s000000006","Abeille Royale Up-Lifting Eye Care",120,89.6,"0000000002"),
("f000000001","BURBERRY My Burberry Festive",125.5,99.9,"0000000003"),
("f000000002","Gucci Bamboo",70,55.5,"0000000003"),
("f000000003","Prada Candy",104,75.7,"0000000003"),
("f000000004","Dior J'adore Eau de Parfum",92,65.6,"0000000003"),
("f000000005","TOM FORD Oud Wood",220,182.8,"0000000003"),
("b000000001","Fresh Brown Sugar Body Polish",38,31.5,"0000000004"),
("b000000002","L'Occitane Hand Creams",12,4.8,"0000000004"),
("b000000003","Clarins Body Lift Cellulite Control",138,93.9,"0000000004"),
("b000000004","Korres Showergels",19.5,13.4,"0000000004"),
("b000000005","Dior J'adore Soap",26,11.7,"0000000004"),
("b000000006","Jurlique Rose Hand Cream",25,16.3,"0000000004"),
("n000000001","Eve Snow Super-Food Nail Mask",22,12.1,"0000000005"),
("n000000002","Dior Nail Glow",27,19.9,"0000000005"),
("n000000003","BURBERRY Nail Polish",24,16.8,"0000000005"),
("n000000004","Formula X Happy Hour",18,13.3,"0000000005"),
("n000000005","Julep Oxygen Nail Treatment",18,11.4,"0000000005"),
("h000000001","Agave Oil Treatment",40,30.8,"0000000006"),
("h000000002","Josie Maran Argan Oil Hair Serum",31,25.1,"0000000006"),
("h000000003","Verb Ghost Oil",14,6.6,"0000000006"),
("h000000004","Living Proof Restore Conditioner",28.5,20.8,"0000000006"),
("h000000005","Bumble Thickening Shampoo",25,11.7,"0000000006"),
("h000000006","Deva Curl Styling Cream",50,36.3,"0000000006"),
("t000000001","Tria Hair Removal Laser 4X",449,320,"0000000007"),
("t000000002","Foreo LUNA mini",139,72.2,"0000000007"),
("t000000003","Ghd Curve Creative Curl Wand",199,108,"0000000007"),
("t000000004","Amika Movos Wireless Styler",149,98.7,"0000000007"),
("t000000005","The Original Beauty Blender",20,14.5,"0000000007");

create table Employee
(empID CHAR(10) NOT NULL,
 password VARCHAR(16),
 name VARCHAR(20),
 empaddress INT,
 email VARCHAR(30),
 jobTitle VARCHAR(15),
 salary int(10),
 age int(3),
 phone int(10),
 PRIMARY KEY(empID),
 FOREIGN KEY (empaddress) REFERENCES Location (locationId));
 
 INSERT INTO Employee VALUES 
	('777001', '1234567', 'Jane', '1', 'Jane@gmail.com', 
		'Region manager', '100000', '30', '1236662233'
	), 
	(
		'777002', '1234567', 'Mike', '2', 'Mike@gmail.com', 
		'Store manager', '80000', '29', '1234442367'
	), 
	(
		'777003', '1233567', 'Anne', '5', 'Anne@gmail.com', 
		'Store manager', '80000', '28', '1237684499'
	), 
	(
		'777004', '1234667', 'Mary', '16', 
		'Mary@gmail.com', 'Store manager', 
		'85000', '28', '1235556666'
	), 
	(
		'777005', '1334567', 'Jerry', '8', 
		'Jerry@gmail.com', 'Region manager', '50000', 
		'25', '1234567777'
	), 
	(
		'777006', '3234567', 'Taylor', '5', 
		'Taylor@gmail.com', 'Staff', '50000', 
		'27', '1237778888'
	), 
	(
		'777007', '1234563', 'Jason', '15', 
		'Jason@gmail.com', 'Staff', '50000', 
		'34', '1237898888'
	), 
	(
		'777008', '1234564', 'Amy', '17', 'Amy@gmail.com', 
		'Staff', '50000', '26', '1236665544'
	), 
	(
		'777009', '1234565', 'Peter', '10', 
		'Peter@gmail.com', 'Staff', '50000', 
		'24', '1234236666'
	), 
	(
		'777010', '1234569', 'Kevin', '15', 
		'Kevin@gmail.com', 'Staff', '50000', 
		'28', '1982227777'
	),	
    ('777011', '1234567', 'Tom', '3', 'Tom@gmail.com',
		'Store manager', '80000', '33', '1232222222'),
	('777012', '1234567', 'Katy', '4', 'Katy@gmail.com',
		'Store manager', '80000', '32', '3212224571'),
	('777013', '1234567', 'Megan', '7','Megan@gmail.com', 
        'Staff', '49000','21', '7876465771'),
	('777014', '1234567', 'Evan', '9', 'Evan@gmail.com',
		'Staff', '550000', '28', '2138788888'),
	('777015', '1234567', 'Thomas', '16','Thomas@gmail.com', 
       'Staff', '540000','29', '3226667657');
 
create table Region
(regionID CHAR(5) NOT NULL,
regionName VARCHAR(20),
rg_manager CHAR(10) NOT NULL,
PRIMARY KEY(regionID),
FOREIGN KEY (rg_manager) REFERENCES Employee (empID));


INSERT INTO Region VALUES 
	('1001', 'East', '777001'), 
	('1002', 'West', '777005');


CREATE TABLE C_Order(
orderID INT AUTO_INCREMENT,
customer_id CHAR(10) NOT NULL,
em_id CHAR(10) NOT NULL,
ostate ENUM('Confirmed','Shipped','Completed'),
submitTime DATETIME,
PRIMARY KEY(orderID),
FOREIGN KEY(customer_id) REFERENCES Customer(accountID) ON DELETE NO ACTION,
FOREIGN KEY(em_id) REFERENCES Employee(empID) ON DELETE NO ACTION ON UPDATE CASCADE);

Create Table Payment (
order_id int,
method enum('Cash', 'Credit', 'Debit'),
pmstatus enum('Failed', 'Success'),
PRIMARY KEY(order_id),
FOREIGN KEY(order_id) REFERENCES C_Order(orderID) On Delete Cascade
);

Create Table OPDetail (
order_id int,
product_id CHAR(10),
amount int Not Null,
PRIMARY KEY(order_id, product_id),
FOREIGN KEY(order_id) REFERENCES C_Order(orderID) On Delete Cascade,
FOREIGN KEY(product_id) REFERENCES Product(productID) On Delete No Action
);

create TABLE Store
(storeID CHAR(10) NOT NULL,
address INT,
EmployeeNumber INT(4),
regionID CHAR(5) NOT NULL,
st_manager CHAR(10) NOT NULL,
PRIMARY KEY(storeID),
FOREIGN KEY (address) REFERENCES Location (locationId),
FOREIGN KEY (regionID) REFERENCES Region(regionID),
FOREIGN KEY (st_manager) REFERENCES Employee(empID));

INSERT INTO Store VALUES 
	('s001', '5', '10', '1001', '777002'), 
	('s002', '4', '15', '1001', '777003'), 
	('s003', '20', '19', '1002', '777004'),
	('s004', '8', '11', '1001', '777011'),
    ('s005', '18', '21', '1002', '777012');


Create Table CEDetail (
category_id CHAR(10),
store_id CHAR(10),
em_id CHAR(10) NOT NULL,
PRIMARY KEY(category_id, store_id),
FOREIGN KEY(category_id) REFERENCES Category(categoryID) On Delete Cascade,
FOREIGN KEY(store_id) REFERENCES Store(storeID) On Delete Cascade,
FOREIGN KEY(em_id) REFERENCES Employee(empID) On Delete Cascade
);

INSERT INTO CEDetail 
VALUES 
	(
		'0000000001', 's001', '777001'
	), 
	(
		'0000000002', 's001', '777001'
	), 
	(
		'0000000003', 's001', '777002'
	), 
	(
		'0000000004', 's001', '777002'
	), 
	(
		'0000000005', 's001', '777006'
	), 
	(
		'0000000006', 's001', '777006'
	), 
	(
		'0000000007', 's001', '777006'
	), 
	(
		'0000000001', 's002', '777003'
	), 
	(
		'0000000002', 's002', '777003'
	),
	(
		'0000000003', 's002', '777005'
	), 
	(
		'0000000004', 's002', '777005'
	), 
	(
		'0000000005', 's002', '777007'
	), 
	(
		'0000000006', 's002', '777007'
	), 
	(
		'0000000007', 's002', '777008'
	), 
	(
		'0000000001', 's003', '777004'
	), 
	(
		'0000000002', 's003', '777004'
	), 
	(
		'0000000003', 's003', '777009'
	), 
	(
		'0000000004', 's003', '777009'
	), 
	(
		'0000000005', 's003', '777010'
	), 
	(
		'0000000006', 's003', '777010'
	), 
	(
		'0000000007', 's003', '777010'
	), 
	(
		'0000000001', 's004', '777011'
	), 
	(
		'0000000002', 's004', '777011'
	), 
	(
		'0000000003', 's004', '777011'
	), 
	(
		'0000000004', 's004', '777013'
	), 
	(
		'0000000005', 's004', '777013'
	), 
	(
		'0000000006', 's004', '777013'
	), 
	(
		'0000000007', 's004', '777013'
	), 
	(
		'0000000001', 's005', '777012'
	), 
	(
		'0000000002', 's005', '777014'
	), 
	(
		'0000000003', 's005', '777012'
	), 
	(
		'0000000004', 's005', '777014'
	), 
	(
		'0000000005', 's005', '777015'
	), 
	(
		'0000000006', 's005', '777015'
	), 
	(
		'0000000007', 's005', '777015'
	);



Create Table Product_Store(
product_id CHAR(10),
store_id CHAR(10),
amount int Not Null,
PRIMARY KEY (product_id, store_id),
FOREIGN KEY (product_id) references Product(ProductID) On Delete Cascade,
FOREIGN KEY (store_id) references Store(storeID) On Delete Cascade
);

INSERT INTO Product_Store VALUES
("m000000001","s001",5),("m000000001","s002",2),("m000000001","s003",10),("m000000001","s004",3),("m000000001","s005",7),
("m000000002","s001",2),("m000000002","s002",8),("m000000002","s003",11),("m000000002","s004",1),("m000000002","s005",6),
("m000000003","s001",12),("m000000003","s002",3),("m000000003","s003",2),("m000000003","s004",4),("m000000003","s005",7),
("m000000004","s001",5),("m000000004","s002",2),("m000000004","s003",10),("m000000004","s004",3),("m000000004","s005",7),
("m000000005","s001",5),("m000000005","s002",2),("m000000005","s003",10),("m000000005","s004",3),("m000000005","s005",7),
("m000000006","s001",9),("m000000006","s002",8),("m000000006","s003",1),("m000000006","s004",1),("m000000006","s005",16),
("m000000007","s001",2),("m000000007","s002",8),("m000000007","s003",11),("m000000007","s004",1),("m000000007","s005",6),
("s000000001","s001",5),("s000000001","s002",2),("s000000001","s003",10),("s000000001","s004",3),("s000000001","s005",7),
("s000000002","s001",2),("s000000002","s002",8),("s000000002","s003",11),("s000000002","s004",1),("s000000002","s005",6),
("s000000003","s001",12),("s000000003","s002",3),("s000000003","s003",2),("s000000003","s004",4),("s000000003","s005",7),
("s000000004","s001",5),("s000000004","s002",2),("s000000004","s003",10),("s000000004","s004",3),("s000000004","s005",7),
("s000000005","s001",5),("s000000005","s002",2),("s000000005","s003",10),("s000000005","s004",3),("s000000005","s005",7),
("s000000006","s001",9),("s000000006","s002",8),("s000000006","s003",1),("s000000006","s004",1),("s000000006","s005",16),
("f000000001","s001",5),("f000000001","s002",2),("f000000001","s003",10),("f000000001","s004",3),("f000000001","s005",7),
("f000000002","s001",2),("f000000002","s002",8),("f000000002","s003",11),("f000000002","s004",1),("f000000002","s005",6),
("f000000003","s001",12),("f000000003","s002",3),("f000000003","s003",2),("f000000003","s004",4),("f000000003","s005",7),
("f000000004","s001",5),("f000000004","s002",2),("f000000004","s003",10),("f000000004","s004",3),("f000000004","s005",7),
("f000000005","s001",5),("f000000005","s002",2),("f000000005","s003",10),("f000000005","s004",3),("f000000005","s005",7),
("b000000001","s001",5),("b000000001","s002",2),("b000000001","s003",10),("b000000001","s004",3),("b000000001","s005",7),
("b000000002","s001",2),("b000000002","s002",8),("b000000002","s003",11),("b000000002","s004",1),("b000000002","s005",6),
("b000000003","s001",12),("b000000003","s002",3),("b000000003","s003",2),("b000000003","s004",4),("b000000003","s005",7),
("b000000004","s001",5),("b000000004","s002",2),("b000000004","s003",10),("b000000004","s004",3),("b000000004","s005",7),
("b000000005","s001",5),("b000000005","s002",2),("b000000005","s003",10),("b000000005","s004",3),("b000000005","s005",7),
("b000000006","s001",9),("b000000006","s002",8),("b000000006","s003",1),("b000000006","s004",1),("b000000006","s005",16),
("n000000001","s001",5),("n000000001","s002",2),("n000000001","s003",10),("n000000001","s004",3),("n000000001","s005",7),
("n000000002","s001",2),("n000000002","s002",8),("n000000002","s003",11),("n000000002","s004",1),("n000000002","s005",6),
("n000000003","s001",12),("n000000003","s002",3),("n000000003","s003",2),("n000000003","s004",4),("n000000003","s005",7),
("n000000004","s001",5),("n000000004","s002",2),("n000000004","s003",10),("n000000004","s004",3),("n000000004","s005",7),
("n000000005","s001",5),("n000000005","s002",2),("n000000005","s003",10),("n000000005","s004",3),("n000000005","s005",7),
("h000000001","s001",5),("h000000001","s002",2),("h000000001","s003",10),("h000000001","s004",3),("h000000001","s005",7),
("h000000002","s001",2),("h000000002","s002",8),("h000000002","s003",11),("h000000002","s004",1),("h000000002","s005",6),
("h000000003","s001",12),("h000000003","s002",3),("h000000003","s003",2),("h000000003","s004",4),("h000000003","s005",7),
("h000000004","s001",5),("h000000004","s002",2),("h000000004","s003",10),("h000000004","s004",3),("h000000004","s005",7),
("h000000005","s001",5),("h000000005","s002",2),("h000000005","s003",10),("h000000005","s004",3),("h000000005","s005",7),
("h000000006","s001",9),("h000000006","s002",8),("h000000006","s003",1),("h000000006","s004",1),("h000000006","s005",16),
("t000000001","s001",5),("t000000001","s002",2),("t000000001","s003",10),("t000000001","s004",3),("t000000001","s005",7),
("t000000002","s001",2),("t000000002","s002",8),("t000000002","s003",11),("t000000002","s004",1),("t000000002","s005",6),
("t000000003","s001",12),("t000000003","s002",3),("t000000003","s003",2),("t000000003","s004",4),("t000000003","s005",7),
("t000000004","s001",5),("t000000004","s002",2),("t000000004","s003",10),("t000000004","s004",3),("t000000004","s005",7),
("t000000005","s001",5),("t000000005","s002",2),("t000000005","s003",10),("t000000005","s004",3),("t000000005","s005",7);

---------------------------------------------------------------------------------------------------
##新加的！！！
alter table Product
add column image varchar(100);

UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Fresh-Brown-Sugar-Body-Polish.jpg' WHERE `productID`='b000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/L\'Occitane-Hand-Creams.jpeg' WHERE `productID`='b000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Clarins-Body-Lift-Cellulite-Control.jpeg' WHERE `productID`='b000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Korres-Showergels.jpg' WHERE `productID`='b000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Dior-J\'adore-Soap.jpg' WHERE `productID`='b000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Jurlique-Rose-Hand-Cream.png' WHERE `productID`='b000000006';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000003/BURBERRY-My-Burberry-Festive.jpg' WHERE `productID`='f000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000003/Gucci-Bamboo.jpg' WHERE `productID`='f000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000003/Prada-Candy.jpg' WHERE `productID`='f000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000003/Dior-J\'adore-Eau-de-Parfum.jpg' WHERE `productID`='f000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000003/TOM-FORD-Oud-Wood.jpg' WHERE `productID`='f000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Deva-Curl-Styling-Cream.jpg' WHERE `productID`='h000000006';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Bumble-Thickening-Shampoo.jpg' WHERE `productID`='h000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Living-Proof-Restore-Conditioner.jpg' WHERE `productID`='h000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Verb-Ghost-Oil.jpg' WHERE `productID`='h000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Josie-Maran-Argan-Oil-Hair-Serum.jpg' WHERE `productID`='h000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000006/Agave-Oil-Treatment.jpg' WHERE `productID`='h000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/COVERa-FX-Custom-Cover-Drops.jpg' WHERE `productID`='m000000007';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Dior-Couture-Creations-Palette.jpg' WHERE `productID`='m000000006';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Surratt-Beauty-Prismatique-Lips.jpg' WHERE `productID`='m000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Viseart-Eyeshadow-Palette.jpg' WHERE `productID`='m000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Fresh-Sugar-Lip-Delight.jpg' WHERE `productID`='m000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Waterproof-Liquid-EyeLiner.png' WHERE `productID`='m000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Urban-Decay-Naked-Smoky.jpg' WHERE `productID`='m000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Eve-Snow-Super-Food-Nail-Mask.jpeg' WHERE `productID`='n000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Dior-Nail-Glow.png' WHERE `productID`='n000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/BURBERRY-Nail-Polish.jpg' WHERE `productID`='n000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Formula-X-Happy-Hour.jpg' WHERE `productID`='n000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Julep-Oxygen-Nail-Treatment.jpg' WHERE `productID`='n000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/Abeille-Royale-Up-Lifting-Eye-Care.jpg' WHERE `productID`='s000000006';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/Black-Tea-Instant-PerfectingMask.jpg' WHERE `productID`='s000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/SK-II-Facial-Treatment-Essence.jpg' WHERE `productID`='s000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/SUPERMUD-Clearing-Treatment.PNG' WHERE `productID`='s000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/Philosophy-Purity-Made-Simple.jpg' WHERE `productID`='s000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/Fresh-Soy-Face-Cleanser.jpg' WHERE `productID`='s000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/The-Original-Beauty-Blender.jpg' WHERE `productID`='t000000005';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/Amika-Movos-Wireless-Styler.jpg' WHERE `productID`='t000000004';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/Ghd-Curve-Creative-Curl-Wand.jpg' WHERE `productID`='t000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/Foreo-LUNA-mini.jpg' WHERE `productID`='t000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/Tria-Hair-Removal-Laser-4X.gif' WHERE `productID`='t000000001';

##修改C_order表
把C_order里面的orderId, AUTO_INCREMENT去掉，然后加下面那句话
ALTER TABLE C_Order DROP PRIMARY KEY, ADD PRIMARY KEY(orderID, em_id);

##修改CE detail表
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777006' WHERE `category_id`='0000000001' and`store_id`='s001';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777006' WHERE `category_id`='0000000002' and`store_id`='s001';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777006' WHERE `category_id`='0000000003' and`store_id`='s001';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777006' WHERE `category_id`='0000000004' and`store_id`='s001';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777007' WHERE `category_id`='0000000001' and`store_id`='s002';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777007' WHERE `category_id`='0000000002' and`store_id`='s002';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777008' WHERE `category_id`='0000000003' and`store_id`='s002';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777008' WHERE `category_id`='0000000004' and`store_id`='s002';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777008' WHERE `category_id`='0000000005' and`store_id`='s002';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777009' WHERE `category_id`='0000000001' and`store_id`='s003';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777009' WHERE `category_id`='0000000002' and`store_id`='s003';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777009' WHERE `category_id`='0000000005' and`store_id`='s003';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777009' WHERE `category_id`='0000000006' and`store_id`='s003';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777009' WHERE `category_id`='0000000007' and`store_id`='s003';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777010' WHERE `category_id`='0000000001' and`store_id`='s004';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777010' WHERE `category_id`='0000000002' and`store_id`='s004';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777010' WHERE `category_id`='0000000003' and`store_id`='s004';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777015' WHERE `category_id`='0000000001' and`store_id`='s005';
UPDATE `dbfinal`.`CEDetail` SET `em_id`='777015' WHERE `category_id`='0000000003' and`store_id`='s005';

##统一product表中图片名字
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/L\'Occitane-Hand-Creams.jpg' WHERE `productID`='b000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Clarins-Body-Lift-Cellulite-Control.jpg' WHERE `productID`='b000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000004/Jurlique-Rose-Hand-Cream.jpg' WHERE `productID`='b000000006';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000001/Waterproof-Liquid-EyeLiner.jpg' WHERE `productID`='m000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Eve-Snow-Super-Food-Nail-Mask.jpg' WHERE `productID`='n000000001';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000005/Dior-Nail-Glow.jpg' WHERE `productID`='n000000002';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000002/SUPERMUD-Clearing-Treatment.jpg' WHERE `productID`='s000000003';
UPDATE `dbfinal`.`Product` SET `image`='../image/products/0000000007/Tria-Hair-Removal-Laser-4X.jpg' WHERE `productID`='t000000001';

##修改product表中部分产品名字使显示整齐
UPDATE `dbfinal`.`Product` SET `pname` = 'Naked Smoky' WHERE `product`.`productID` = 'm000000001';
UPDATE `dbfinal`.`Product` SET `pname` = 'Liquid Eye Liner' WHERE `product`.`productID` = 'm000000002'; 
UPDATE `dbfinal`.`Product` SET `pname` = 'My Burberry Festive' WHERE `product`.`productID` = 'f000000001';
UPDATE `dbfinal`.`Product` SET `pname` = 'J''adore Eau de Parfum' WHERE `product`.`productID` = 'f000000004';  
UPDATE `dbfinal`.`Product` SET `pname` = 'Brown Sugar Body Polish' WHERE `product`.`productID` = 'b000000001';
UPDATE `dbfinal`.`Product` SET `pname` = 'Body Lift Cellulite Control' WHERE `product`.`productID` = 'b000000003';
UPDATE `dbfinal`.`Product` SET `pname` = 'Super-Food Nail Mask' WHERE `product`.`productID` = 'n000000001'; 
UPDATE `dbfinal`.`Product` SET `pname` = 'Tria Hair Removal Laser 4X-Fuchsia' WHERE `product`.`productID` = 't000000001';
