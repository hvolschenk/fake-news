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
