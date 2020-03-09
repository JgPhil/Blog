
CREATE TABLE User (
                us_id INT NOT NULL,
                username VARCHAR(255) NOT NULL,
                userType BOOLEAN DEFAULT 0 NOT NULL,
                pass VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                admin BOOLEAN DEFAULT 0 NOT NULL,
                dateCreation DATE NOT NULL,
                PRIMARY KEY (us_id)
);


CREATE TABLE Post (
                post_id INT NOT NULL,
                us_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                chapo VARCHAR(255) NOT NULL,
                last_update DATE NOT NULL,
                PRIMARY KEY (post_id)
);


CREATE TABLE Comments (
                com_id INT NOT NULL,
                post_id INT NOT NULL,
                us_id INT NOT NULL,
                com_date DATE NOT NULL,
                publish BOOLEAN DEFAULT 0 NOT NULL,
                PRIMARY KEY (com_id)
);


ALTER TABLE Comments ADD CONSTRAINT users_comments_fk
FOREIGN KEY (us_id)
REFERENCES User (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Post ADD CONSTRAINT users_blogs_fk
FOREIGN KEY (us_id)
REFERENCES User (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Comments ADD CONSTRAINT blogs_comments_fk
FOREIGN KEY (post_id)
REFERENCES Post (post_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
