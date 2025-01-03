-- ************************** SEQUENCE *************************************************************************
-- Drops existing sequence in a database
DROP SEQUENCE seq_slot_id;
DROP SEQUENCE seq_product_id;
DROP SEQUENCE seq_order_id;
DROP SEQUENCE seq_user_id;
DROP SEQUENCE seq_shop_id;
DROP SEQUENCE seq_offer_id;
DROP SEQUENCE seq_wishlist_id;
DROP SEQUENCE seq_cart_id;
DROP SEQUENCE seq_payment_id;
DROP SEQUENCE seq_report_id;
DROP SEQUENCE seq_category_id;
DROP SEQUENCE seq_review_id;
DROP SEQUENCE seq_invoice_id;


-- creating sequence
CREATE SEQUENCE seq_slot_id
START WITH 1
INCREMENT BY 3
MAXVALUE 999999;

CREATE SEQUENCE seq_user_id
START WITH 100
INCREMENT BY 2
MAXVALUE 99999;

CREATE SEQUENCE seq_shop_id
START WITH 2
INCREMENT BY 3;

CREATE SEQUENCE seq_product_id
START WITH 700
INCREMENT BY 5
MINVALUE 700;


CREATE SEQUENCE seq_wishlist_id
START WITH 500
INCREMENT BY 6
MAXVALUE 900009;

CREATE SEQUENCE seq_cart_id
START WITH 8862
INCREMENT BY 12
MAXVALUE 666892;

CREATE SEQUENCE seq_order_id
START WITH 6523
INCREMENT BY 25
MAXVALUE 900000;

CREATE SEQUENCE seq_payment_id
START WITH 8000
INCREMENT BY 7
MAXVALUE 9000002;

CREATE SEQUENCE seq_report_id
START WITH 99
INCREMENT BY 3
MAXVALUE 699;

CREATE SEQUENCE seq_category_id
START WITH 9
INCREMENT BY 3;

CREATE SEQUENCE seq_review_id
START WITH 1000
INCREMENT BY 33;


CREATE SEQUENCE seq_invoice_id
START WITH 333
INCREMENT BY 1
MAXVALUE 9999900;

