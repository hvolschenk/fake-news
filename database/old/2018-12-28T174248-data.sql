-- POOLS
INSERT INTO model(type) VALUES('pool');
SET @POOL_ONE_ID = LAST_INSERT_ID();
INSERT INTO pool(id, name, numberOfQuestions) VALUES(@POOL_ONE_ID, 'Pool A', 15);

INSERT INTO model(type) VALUES('pool');
SET @POOL_TWO_ID = LAST_INSERT_ID();
INSERT INTO pool(id, name, numberOfQuestions) VALUES(@POOL_TWO_ID, 'Pool B', 20);

INSERT INTO model(type) VALUES('pool');
SET @POOL_THREE_ID = LAST_INSERT_ID();
INSERT INTO pool(id, name, numberOfQuestions) VALUES(@POOL_THREE_ID, 'Pool C', 25);
