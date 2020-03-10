
CREATE TABLE Role (
                role_id INT NOT NULL,
                role VARCHAR(255) NOT NULL,
                PRIMARY KEY (role_id)
);


CREATE TABLE User (
                user_id INT NOT NULL,
                role_id INT NOT NULL,
                username VARCHAR(255) NOT NULL,
                user_type BOOLEAN DEFAULT 0 NOT NULL,
                password VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                creation_date DATE NOT NULL,
                avatar VARCHAR(255) NOT NULL,
                PRIMARY KEY (user_id)
);


CREATE TABLE Post (
                post_id INT NOT NULL,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                heading VARCHAR(255) NOT NULL,
                last_update DATE NOT NULL,
                picture VARCHAR(255) NOT NULL,
                PRIMARY KEY (post_id)
);


CREATE TABLE Comments (
                comment_id INT NOT NULL,
                post_id INT NOT NULL,
                user_id INT NOT NULL,
                comment_date DATETIME NOT NULL,
                comment_validate_date DATETIME,
                PRIMARY KEY (comment_id)
);


ALTER TABLE User ADD CONSTRAINT role_user_fk
FOREIGN KEY (role_id)
REFERENCES Role (role_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Comments ADD CONSTRAINT users_comments_fk
FOREIGN KEY (user_id)
REFERENCES User (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Post ADD CONSTRAINT users_blogs_fk
FOREIGN KEY (user_id)
REFERENCES User (user_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Comments ADD CONSTRAINT blogs_comments_fk
FOREIGN KEY (post_id)
REFERENCES Post (post_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
