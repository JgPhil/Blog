
CREATE TABLE Users (
                us_id INT NOT NULL,
                firstname VARCHAR(255) NOT NULL,
                lastname VARCHAR(255) NOT NULL,
                pass VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                admin BOOLEAN DEFAULT 0 NOT NULL,
                PRIMARY KEY (us_id)
);


CREATE TABLE Education (
                ed_id INT NOT NULL,
                us_id INT NOT NULL,
                diploma VARCHAR(255) NOT NULL,
                dip_date DATE NOT NULL,
                PRIMARY KEY (ed_id)
);


CREATE TABLE social (
                soc_id INT NOT NULL,
                twitter VARCHAR(255) NOT NULL,
                github VARCHAR(255) NOT NULL,
                us_id INT NOT NULL,
                PRIMARY KEY (soc_id)
);


CREATE TABLE Blogs (
                blog_id INT NOT NULL,
                us_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                chapo VARCHAR(255) NOT NULL,
                last_update DATE NOT NULL,
                PRIMARY KEY (blog_id)
);


CREATE TABLE Comments (
                com_id INT NOT NULL,
                blog_id INT NOT NULL,
                us_id INT NOT NULL,
                com_date DATE NOT NULL,
                publish BOOLEAN DEFAULT 0 NOT NULL,
                PRIMARY KEY (com_id)
);


ALTER TABLE Comments ADD CONSTRAINT users_comments_fk
FOREIGN KEY (us_id)
REFERENCES Users (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Blogs ADD CONSTRAINT users_blogs_fk
FOREIGN KEY (us_id)
REFERENCES Users (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE social ADD CONSTRAINT users_social_fk
FOREIGN KEY (us_id)
REFERENCES Users (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Education ADD CONSTRAINT users_education_fk
FOREIGN KEY (us_id)
REFERENCES Users (us_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;

ALTER TABLE Comments ADD CONSTRAINT blogs_comments_fk
FOREIGN KEY (blog_id)
REFERENCES Blogs (blog_id)
ON DELETE NO ACTION
ON UPDATE NO ACTION;
