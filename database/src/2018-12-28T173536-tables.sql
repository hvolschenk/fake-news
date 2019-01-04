CREATE TABLE model(
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  type VARCHAR(64) NOT NULL,
  status CHAR(1) NOT NULL DEFAULT 'A',
  dateCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  dateModified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  createdBy INT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY(id),
  INDEX(status)
) ENGINE=InnoDB;

CREATE TABLE modelLink(
  id INT UNSIGNED NOT NULL,
  link INT UNSIGNED NOT NULL,
  FOREIGN KEY (id) REFERENCES model(id),
  FOREIGN KEY (link) REFERENCES model(id)
)ENGINE=InnoDB;

CREATE TABLE action(
  id INT UNSIGNED NOT NULL,
  action ENUM('QUESTION', 'ANSWER'),
  result VARCHAR(255) NULL,
  FOREIGN KEY (id) REFERENCES model(id)
) ENGINE=InnoDB;

CREATE TABLE question(
  id INT UNSIGNED NOT NULL,
  question VARCHAR(255) NOT NULL,
  answer TINYINT(1) NULL,
  FOREIGN KEY (id) REFERENCES model(id)
) ENGINE=InnoDB;

CREATE TABLE pool(
  id INT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  numberOfQuestions SMALLINT UNSIGNED NOT NULL DEFAULT 15,
  FOREIGN KEY (id) REFERENCES model(id)
) ENGINE=InnoDB;

CREATE TABLE user(
  id INT UNSIGNED NOT NULL,
  sessionId VARCHAR(255) NOT NULL,
  role TINYINT NOT NULL DEFAULT 0,
  FOREIGN KEY (id) REFERENCES model(id)
) ENGINE=InnoDB;
