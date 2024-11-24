-- =====================================================================TRIGGERS==============================================================================


--creating triggers for validating number of PRODUCTS in ORDERS 
COMMIT;
CREATE OR REPLACE TRIGGER trig_product_in_order
BEFORE INSERT OR UPDATE ON PRODUCT_ORDER
FOR EACH ROW
BEGIN
    IF(:NEW.quantity<0 OR :NEW.quantity>21) THEN
        RAISE_APPLICATION_ERROR(-20002,'Check the number of product in order. The product should be more than 0 an less than 21');
    END IF;
END;
/

-- creating the trigger to check the invalid email address in ALL_USER entity
--COMMIT;
--CREATE OR REPLACE TRIGGER trg_check_email
--BEFORE INSERT OR UPDATE ON ALL_USER
--FOR EACH ROW
--DECLARE
--  email_suffix VARCHAR2(10);
--BEGIN
  -- Extract the suffix of the email address
--  email_suffix := SUBSTR(:NEW.email, -10);
  
  -- Check if the email address has exactly one '@' symbol and ends with 'gmail.com'
--  IF (REGEXP_COUNT(:NEW.email, '@') = 1 AND email_suffix = 'gmail.com') THEN
    -- Email address is valid, do nothing
--    NULL;
--  ELSE
    -- Email address is invalid, raise an error
--    RAISE_APPLICATION_ERROR(-20001, 'Email address must have exactly one "@" symbol and end with "gmail.com"');
--  END IF;
--END;

--/

-- creating the trigger to check the invalid phone

COMMIT;
CREATE OR REPLACE TRIGGER trig_for_invalid_phone
BEFORE INSERT OR UPDATE on ALL_USER
FOR EACH ROW
BEGIN
    IF length(:new.phone_no)!=10 THEN
    RAISE_APPLICATION_ERROR(-20005, 'Email address is invalid, please check it');
    END IF;
END;
/

-- creating trigger to check whether EXPIRY_DATE is after MANUFACTURE_DATE or not
COMMIT;
CREATE OR REPLACE TRIGGER trg_check_date
BEFORE INSERT ON PRODUCT 
FOR EACH ROW
   BEGIN
    IF :new.EXPIRY_DATE <:new.MANUFACTURE_DATE THEN
       raise_application_error(-20001, 'The product expiry date is earlier than manufacture date. Please enter the product manufacture and expiry date appropriately');
    elsIF(:NEW.EXPIRY_DATE<SYSDATE) THEN
        RAISE_APPLICATION_ERROR(-20000,'The product is already expired'); 
      END IF;
END;
/

-- creating trigger to generate date for ALL_USER entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_All_USER
BEFORE INSERT ON ALL_USER
FOR EACH ROW
BEGIN
    :NEW.date_created := SYSDATE;
END;
/

-- creating trigger to generate date for WISHLIST entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_WISHLIST
BEFORE INSERT OR UPDATE ON WISHLIST
FOR EACH ROW
BEGIN
  IF INSERTING THEN
    :NEW.date_created := SYSDATE;
  END IF;
  
  IF UPDATING THEN
    :NEW.updated_date := SYSDATE;
  END IF;
END;
/

-- creating trigger to generate date for PRODUCT_ORDER entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_PRODUCT_ORDER
BEFORE INSERT ON PRODUCT_ORDER
FOR EACH ROW
BEGIN
  -- Set the value of ordered_date to the current date, without the time component
  :NEW.ordered_date := TRUNC(SYSDATE);
  
  -- Set the value of ordered_time to the current time, as a string with the format HH24:MI:SS
  --:NEW.ordered_time := TO_CHAR(SYSDATE, 'HH24:MI:SS');
END;
/

-- creating trigger to generate date for PAYMENT entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_PAYMENT
BEFORE INSERT ON PAYMENT
FOR EACH ROW
BEGIN
    :NEW.payment_date := SYSDATE;
END;
/

-- creating trigger to generate date for REPORT entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_REPORT
BEFORE INSERT ON REPORT
FOR EACH ROW
BEGIN
    :NEW.report_date := SYSDATE;
END;
/

-- creating trigger to generate date for REVIEW entity
COMMIT;
CREATE OR REPLACE TRIGGER trg_date_REVIEW
BEFORE INSERT ON REVIEW
FOR EACH ROW
BEGIN
  -- Set the value of ordered_date to the current date, without the time component
  :NEW.review_date := TRUNC(SYSDATE);
  
  -- Set the value of ordered_time to the current time, as a string with the format HH24:MI:SS
  :NEW.review_time := TO_CHAR(SYSDATE, 'HH24:MI:SS');
END;
/


