DELIMITER |
CREATE OR REPLACE FUNCTION media(id INT) RETURNS FLOAT
BEGIN
DECLARE mediaVoto FLOAT;
  SELECT AVG(voti.voto) INTO mediaVoto
  FROM voti 
  WHERE voti.ricetta= id ; 
  RETURN mediaVoto;
END |
DELIMITER ;