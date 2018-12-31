DELIMITER //
CREATE PROCEDURE model_create(IN aType VARCHAR(64), IN aCreatedBy INT UNSIGNED)
BEGIN INSERT INTO model(type, createdBy) VALUES(aType, aCreatedBy); SELECT LAST_INSERT_ID(); END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE model_delete(IN aId INT UNSIGNED)
BEGIN UPDATE model SET status = 'D' WHERE id = aId; END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE model_getParentLinkIds(IN aId INT UNSIGNED, IN aType VARCHAR(255))
BEGIN
  SELECT modelLink.id FROM modelLink
  JOIN model ON modelLink.id = model.id
  WHERE modelLink.link = aId
  AND model.type = aType;
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE model_updateDateModified(IN aId INT UNSIGNED)
BEGIN UPDATE model SET dateModified = CURRENT_TIMESTAMP() WHERE id = aId; END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE modelLink_create(IN aId INT UNSIGNED, IN aLink INT UNSIGNED)
BEGIN INSERT INTO modelLink(id, link) VALUES(aId, aLink); END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE modelLink_removeType(IN aId INT UNSIGNED, IN aType VARCHAR(255))
BEGIN
  DELETE modelLink.* FROM modelLink
  JOIN model ON modelLink.link = model.id
  WHERE modelLink.id=aId
  AND model.type=aType;
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE pool_create(
  IN aId INT UNSIGNED,
  IN aName VARCHAR(255),
  IN aNumberOfQuestions SMALLINT UNSIGNED
)
BEGIN
  INSERT INTO pool(id, name, numberOfQuestions) VALUES(aId, aName, aNumberOfQuestions);
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE pool_random()
BEGIN
  SELECT pool.id, pool.name, pool.numberOfQuestions
  FROM pool
  JOIN model ON pool.id = model.id
  WHERE model.status = 'A'
  ORDER BY RAND()
  LIMIT 1;
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE user_create(IN aId INT UNSIGNED, IN aSessionId VARCHAR(255), IN aRole TINYINT)
BEGIN
  INSERT INTO user(id, sessionId, role) VALUES(aId, aSessionId, aRole);
END//
DELIMITER ;

DELIMITER //
CREATE PROCEDURE user_fromSessionId(IN aSessionId VARCHAR(255))
BEGIN
  SELECT
    model.id, model.type, model.status, model.dateCreated, model.dateModified, user.sessionId,
    user.role, pool.numberOfQuestions
  FROM user
  JOIN model ON user.id = model.id
  JOIN modelLink ON model.id = modelLink.id
  JOIN pool ON modelLink.link = pool.id
  WHERE user.sessionId = aSessionId;
END//
DELIMITER ;
