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

-- QUESTIONS
INSERT INTO model(type) VALUES('question');
SET @QUESTION_ONE_ID = LAST_INSERT_ID();
INSERT INTO question(id, question, answer) VALUES(@QUESTION_ONE_ID, 'Is news fake', 1);
INSERT INTO modelLink(id, link) VALUES(@POOL_ONE_ID, @QUESTION_ONE_ID);

INSERT INTO model(type) VALUES('question');
SET @QUESTION_TWO_ID = LAST_INSERT_ID();
INSERT INTO question(id, question, answer) VALUES(@QUESTION_TWO_ID, 'Is news fake2', 1);
INSERT INTO modelLink(id, link) VALUES(@POOL_TWO_ID, @QUESTION_TWO_ID);

INSERT INTO model(type) VALUES('question');
SET @QUESTION_THREE_ID = LAST_INSERT_ID();
INSERT INTO question(id, question, answer) VALUES(@QUESTION_THREE_ID, 'Is news fake3', 1);
INSERT INTO modelLink(id, link) VALUES(@POOL_THREE_ID, @QUESTION_THREE_ID);
