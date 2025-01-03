-- **************************** TRIGGERS for Primary key*************************************************************************


--creating trigger to generate primary keys(slot_id) in COLLECTION_SLOT table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_slot_id
BEFORE INSERT ON COLLECTION_SLOT
FOR EACH ROW
BEGIN 
    IF :NEW.slot_id IS NULL THEN
        SELECT seq_slot_id.NEXTVAL INTO :NEW.slot_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(product_id) in PRODUCT table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_user_id
BEFORE INSERT ON ALL_USER
FOR EACH ROW
BEGIN 
    IF :NEW.user_id IS NULL THEN
        SELECT seq_user_id.NEXTVAL INTO :NEW.user_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(shop_id) in SHOP table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_shop_id
BEFORE INSERT ON SHOP
FOR EACH ROW
BEGIN 
    IF :NEW.shop_id IS NULL THEN
        SELECT seq_shop_id.NEXTVAL INTO :NEW.shop_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(wishlist_id) in WISHLIST table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_wishlist_id
BEFORE INSERT ON WiSHLIST
FOR EACH ROW
BEGIN 
    IF :NEW.wishlist_id IS NULL THEN
        SELECT seq_wishlist_id.NEXTVAL INTO :NEW.wishlist_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(cart_id) in CART table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_cart_id
BEFORE INSERT ON CART
FOR EACH ROW
BEGIN 
    IF :NEW.cart_id IS NULL THEN
        SELECT seq_cart_id.NEXTVAL INTO :NEW.cart_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(order_id) in PRODUCT_ORDER table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_order_id
BEFORE INSERT ON PRODUCT_ORDER
FOR EACH ROW
BEGIN 
    IF :NEW.order_id IS NULL THEN
        SELECT seq_order_id.NEXTVAL INTO :NEW.order_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(payment_id) in PAYMENT table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_payment_id
BEFORE INSERT ON PAYMENT
FOR EACH ROW
BEGIN 
    IF :NEW.payment_id IS NULL THEN
        SELECT seq_payment_id.NEXTVAL INTO :NEW.payment_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(report_id) in REPORT table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_report_id
BEFORE INSERT ON REPORT
FOR EACH ROW
BEGIN 
    IF :NEW.report_id IS NULL THEN
        SELECT seq_report_id.NEXTVAL INTO :NEW.report_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(category_id) in CATEGORY table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_category_id
BEFORE INSERT ON CATEGORY
FOR EACH ROW
BEGIN 
    IF :NEW.category_id IS NULL THEN
        SELECT seq_category_id.NEXTVAL INTO :NEW.category_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(category_id) in PRODUCT table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_product_id
BEFORE INSERT ON PRODUCT
FOR EACH ROW
BEGIN 
    IF :NEW.product_id IS NULL THEN
        SELECT seq_product_id.NEXTVAL INTO :NEW.product_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate primary keys(review_id) in REVIEW table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_review_id
BEFORE INSERT ON REVIEW
FOR EACH ROW
BEGIN 
    IF :NEW.review_id IS NULL THEN
        SELECT seq_review_id.NEXTVAL INTO :NEW.review_id FROM SYS.DUAL;
    END IF;
END;
/

--creating trigger to generate (invoice_id) in PRODUCT_ORDER table
COMMIT;
CREATE OR REPLACE TRIGGER trigger_invoice_id
BEFORE INSERT ON PRODUCT_ORDER
FOR EACH ROW
BEGIN 
    IF :NEW.invoice_id IS NULL THEN
        SELECT seq_invoice_id.NEXTVAL INTO :NEW.invoice_id FROM SYS.DUAL;
    END IF;
END;
/
