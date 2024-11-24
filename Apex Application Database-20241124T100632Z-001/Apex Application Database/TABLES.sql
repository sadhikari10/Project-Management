--Drops an existing table in a database
DROP TABLE COLLECTION_SLOT CASCADE CONSTRAINTS ; 
DROP TABLE ALL_USER CASCADE CONSTRAINTS ; 
DROP TABLE SHOP CASCADE CONSTRAINTS ; 
DROP TABLE WISHLIST CASCADE CONSTRAINTS ; 
DROP TABLE CART CASCADE CONSTRAINTS ; 
DROP TABLE PRODUCT_ORDER CASCADE CONSTRAINTS ; 
DROP TABLE PAYMENT CASCADE CONSTRAINTS ; 
DROP TABLE REPORT CASCADE CONSTRAINTS ; 
DROP TABLE PRODUCT CASCADE CONSTRAINTS ; 
DROP TABLE CATEGORY CASCADE CONSTRAINTS ; 
DROP TABLE REVIEW CASCADE CONSTRAINTS ; 
DROP TABLE WISHLIST_PRODUCT CASCADE CONSTRAINTS ; 
DROP TABLE PRODUCT_CART CASCADE CONSTRAINTS ; 
DROP TABLE OFFER_PRODUCT CASCADE CONSTRAINTS ; 
DROP TABLE ORDERED_PRODUCT CASCADE CONSTRAINTS ; 
DROP TABLE PRODUCT_REPORT CASCADE CONSTRAINTS ; 



-- Create a Database table to represent the "ALL_USER" entity.
CREATE TABLE ALL_USER(
    user_id NUMBER(5),
    first_name VARCHAR(40) NOT NULL,
    last_name VARCHAR(40) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL UNIQUE,
    phone_no NUMBER(15) NOT NULL UNIQUE,
    address VARCHAR(50) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    age VARCHAR(20) NOT NULL,
    date_created DATE NOT NULL,
    image	VARCHAR(255),
    role VARCHAR(20) NOT NULL,
    verification_code VARCHAR(255) NOT NULL,
    verify_status NUMBER(3) NOT NULL,

    -- Specify the PRIMARY KEY constraint for table "ALL_USER".
    CONSTRAINT	pk_ALL_USER PRIMARY KEY (user_id)
);

-- Create a Database table to represent the "COLLECTION_SLOT" entity.
CREATE TABLE COLLECTION_SLOT(
	slot_id	NUMBER(5),
	day	VARCHAR(15) NOT NULL,
    collection_time VARCHAR(15) NOT NULL,
    fk_user_id	NUMBER(5) NULL,

	-- Specify the PRIMARY KEY constraint for table "COLLECTION_SLOT".
	CONSTRAINT	pk_COLLECTION_SLOT PRIMARY KEY (slot_id),
    -- Specify the FOREIGN KEY constraint for table "SHOP".
    FOREIGN KEY (fk_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL
);

-- Create a Database table to represent the "SHOP" entity.
CREATE TABLE SHOP(
	shop_id	NUMBER(5),
	shop_name	VARCHAR(40) NOT NULL,
	shop_status	NUMBER(3) NOT NULL,  
	shop_category  VARCHAR(40) NOT NULL,
	user_id	NUMBER(10) NULL,

	-- Specify the PRIMARY KEY constraint for table "SHOP".
	CONSTRAINT	pk_SHOP PRIMARY KEY (shop_id),

    -- Specify the FOREIGN KEY constraint for table "SHOP".
    FOREIGN KEY (fk_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL
);



-- Create a Database table to represent the "WISHLIST" entity.
CREATE TABLE WISHLIST(
	wishlist_id	NUMBER(6),
	items	VARCHAR(200) NOT NULL,
	date_created	DATE NOT NULL,
	updated_date	DATE,
	fk_user_id	NUMBER(5) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "WISHLIST".
	CONSTRAINT	pk_WISHLIST PRIMARY KEY (wishlist_id),

    -- Specify the FOREIGN KEY constraint for table "WISHLIST".
    FOREIGN KEY (fk_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL

);

-- Create a Database table to represent the "CART" entity.
CREATE TABLE CART(
	cart_id	NUMBER(6),
	fk_user_id	NUMBER(10) NOT NULL,
    status NUMBER(3) NOT NULL,
	-- Specify the PRIMARY KEY constraint for table "CART".
	CONSTRAINT	pk_CART PRIMARY KEY (cart_id),

    -- Specify the FOREIGN KEY constraint for table "CART".
    FOREIGN KEY (fk_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL

);

-- Create a Database table to represent the "PRODUCT_ORDER" entity.
CREATE TABLE PRODUCT_ORDER(
	order_id	NUMBER(4),
	ordered_date	DATE NOT NULL,
	--ordered_time	TIMESTAMP NOT NULL,
	status	NUMBER(3) NOT NULL,
	quantity	NUMBER(2) NOT NULL,
	total_cost	NUMBER(5) NOT NULL,
	invoice_id NUMBER(10)	 NOT NULL UNIQUE,
	fk_cart_id	NUMBER(6) NOT NULL,
	fk_slot_id	NUMBER(5) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "PRODUCT_ORDER".
	CONSTRAINT	pk_PRODUCT_ORDER PRIMARY KEY (order_id),

    -- Specify the FOREIGN KEY constraint for table "PRODUCT_ORDER".
    FOREIGN KEY (fk_cart_id) REFERENCES CART(cart_id) ON DELETE SET NULL,
    FOREIGN KEY (fk_slot_id) REFERENCES COLLECTION_SLOT(slot_id) ON DELETE SET NULL
);

-- Create a Database table to represent the "PAYMENT" entity.
CREATE TABLE PAYMENT(
	payment_id	NUMBER(7),
	payment_amount NUMBER(10) NOT NULL,
	currency	VARCHAR(8) NOT NULL,
	payment_date	DATE NOT NULL,
	payment_status	NUMBER(3) NOT NULL,
	fK_user_id	NUMBER(5) NOT NULL,
	fk_order_id	NUMBER(4) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "PAYMENT".
	CONSTRAINT	pk_PAYMENT PRIMARY KEY (payment_id),
    
    -- Specify the FOREIGN KEY constraint for table "PAYMENT".
    FOREIGN KEY (fK_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL,
    FOREIGN KEY (FK_order_id) REFERENCES PRODUCT_ORDER(order_id) ON DELETE SET NULL

);

-- Create a Database table to represent the "REPORT" entity.
CREATE TABLE REPORT(
	report_id	NUMBER(3),
	report_title	VARCHAR(20) NOT NULL,
	report_body	LONG VARCHAR NOT NULL,
	report_date	DATE NOT NULL,
	fk_user_id	NUMBER(5) NOT NULL,
	fk_order_id	NUMBER(4) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "REPORT".
	CONSTRAINT	pk_REPORT PRIMARY KEY (report_id),

	-- Specify the FOREIGN KEY constraint for table "REPORT".
    FOREIGN KEY (fK_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL,
    FOREIGN KEY (fk_order_id) REFERENCES PRODUCT_ORDER(order_id) ON DELETE SET NULL
);

-- Create a Database table to represent the "CATEGORY" entity.
CREATE TABLE CATEGORY(
	category_id	NUMBER(2),
	category_name	VARCHAR(30) NOT NULL,
	Category_description	LONG VARCHAR NOT NULL,
    fk_user_id	NUMBER(5) NULL,

	-- Specify the PRIMARY KEY constraint for table "CATEGORY".
	CONSTRAINT	pk_CATEGORY PRIMARY KEY (category_id),
    FOREIGN KEY (fk_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL

);

-- Create a Database table to represent the "PRODUCT" entity.
CREATE TABLE PRODUCT(
	product_id	NUMBER(8),
	name	VARCHAR(30) NOT NULL,
	description	LONG VARCHAR NOT NULL,
	unit_price	NUMBER(5) NOT NULL,
	stock	NUMBER(2) NOT NULL,
	minimum_order	NUMBER(2) NOT NULL,
	manufacturing_date	DATE NOT NULL,
	expire_date	DATE NOT NULL,
	image	VARCHAR(255),
	category_id	NUMBER(2) NOT NULL,
	shop_id	NUMBER(5) NOT NULL,
    status	NUMBER(1) NOT NULL,
	report_id NUMBER(5) NOT NULL,
	max_order NUMBER(5) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "PRODUCT".
	CONSTRAINT	pk_PRODUCT PRIMARY KEY (product_id),

	-- Specify the FOREIGN KEY constraint for table "PRODUCT".
    FOREIGN KEY (fk_category_id) REFERENCES CATEGORY(category_id) ON DELETE SET NULL,
    FOREIGN KEY (fk_shop_id) REFERENCES SHOP(shop_id) ON DELETE SET NULL
);

-- Create a Database table to represent the "REVIEW" entity.
CREATE TABLE REVIEW(
	review_id	NUMBER(8),
	review_text	LONG VARCHAR NOT NULL,
	review_title VARCHAR(20) NOT NULL,
	review_date DATE NOT NULL,
	rate	NUMBER(5) NOT NULL,
	fk_user_id	NUMBER(5) NOT NULL,
	fk_product_id	NUMBER(8) NOT NULL,

	-- Specify the PRIMARY KEY constraint for table "REVIEW".
	CONSTRAINT	pk_REVIEW PRIMARY KEY (review_id),

    -- Specify the PRIMARY KEY constraint for table "REVIEW".
    FOREIGN KEY (fK_user_id) REFERENCES ALL_USER(user_id) ON DELETE SET NULL,
    FOREIGN KEY (fk_product_id) REFERENCES PRODUCT(product_id) ON DELETE SET NULL
);


-- Create a Database table to represent the "WISHLIST_PRODUCT" entity.
CREATE TABLE WISHLIST_PRODUCT(
	wishlist_id	NUMBER(6) NOT NULL,
	product_id	NUMBER(8) NOT NULL,
    
    FOREIGN KEY (wishlist_id) REFERENCES WISHLIST(wishlist_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)
);
--ALTER TABLE WISHLIST_PRODUCT ADD CONSTRAINT wishlist_id FOREIGN KEY (wishlist_id) REFERENCES WISHLIST(wishlist_id);
--ALTER TABLE WISHLIST_PRODUCT ADD CONSTRAINT product_id FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id);


-- Create a Database table to represent the "PRODUCT_CART" entity.
CREATE TABLE PRODUCT_CART(
	product_id	NUMBER(8) NOT NULL,
	cart_id	NUMBER(6) NOT NULL,
    items	VARCHAR(200) NOT NULL,
	total_items	NUMBER(2) NOT NULL,
    fk_wishlist_id NUMBER(6) UNIQUE,
    status NUMBER(3) NOT NULL,
    
        -- Specify the FOREIGN KEY constraint for table "PRODUCT_CART".
    --FOREIGN KEY (fk_wishlist_id) REFERENCES WISHLIST(wishlist_id) ON DELETE SET NULL
    
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id),
    FOREIGN KEY (cart_id) REFERENCES CART(cart_id)
);

--ALTER TABLE PRODUCT_CART ADD CONSTRAINT product_id FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id);
--ALTER TABLE PRODUCT_CART ADD CONSTRAINT cart_id FOREIGN KEY (cart_id) REFERENCES CART(cart_id);



-- Create a Database table to represent the "ODERED_PRODUCT" entity.
CREATE TABLE ORDERED_PRODUCT(
	order_id	NUMBER(4) NOT NULL,
	product_id	NUMBER(8) NOT NULL,
    quantity NUMBER(8) NOT NULL,
    
    FOREIGN KEY (order_id) REFERENCES PRODUCT_ORDER(order_id),
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id)

);
--ALTER TABLE ODERED_PRODUCT ADD CONSTRAINT order_id FOREIGN KEY (order_id) REFERENCES PRODUCT_ORDER(order_id);
--ALTER TABLE ODERED_PRODUCT ADD CONSTRAINT product_id FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id);

-- Create a Database table to represent the "PRODUCT_REPORT" entity.
CREATE TABLE PRODUCT_REPORT(
	product_id	NUMBER(8) NOT NULL,
	report_id	NUMBER(3) NOT NULL,
    
    FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id),
    FOREIGN KEY (report_id) REFERENCES REPORT(report_id)

);
--ALTER TABLE PRODUCT_REPORT ADD CONSTRAINT product_id FOREIGN KEY (product_id) REFERENCES PRODUCT(product_id);
--ALTER TABLE PRODUCT_REPORT ADD CONSTRAINT report_id FOREIGN KEY (report_id) REFERENCES REPORT(report_id);



