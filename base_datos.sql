USE tienda;
CREATE TABLE users(
    user_id INT PRIMARY KEY auto_increment,
    user_email VARCHAR(120) UNIQUE NOT NULL,
    user_password VARCHAR(180) NOT NULL,
    user_temp_password VARCHAR(180),
    user_update_pass enum('N','S') DEFAULT 'N',
    user_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    user_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
    );

INSERT INTO users(user_email,user_password) VALUES ('demo@demo.com','123x');
CREATE OR REPLACE VIEW session_vw AS SELECT user_id,user_email,user_update_pass from users;
SELECT * FROM session_vw;

ALTER TABLE users ADD COLUMN user_status enum('Active','Inactive') default 'Active' AFTER user_password
ALTER TABLE users ADD COLUMN user_privilege enum('Administrator','Salesman') NOT NULL AFTER user_status;
