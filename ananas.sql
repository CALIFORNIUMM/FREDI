DROP FUNCTION IF EXISTS goalAverage;
DELIMITER |
CREATE function goalAverage(id INT(10), result INT(1))
RETURNS INT(10)
BEGIN
    DECLARE ptnGoal INT;

    DECLARE v_journee VARCHAR(3);
    DECLARE cursorTermine INT;

    DEClARE cursorJournee CURSOR FOR SELECT numJournee FROM journee;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET cursorTermine = 1;
    
    OPEN cursorJournee;
        valpris: LOOP
        FETCH cursorJournee INTO v_journee;
        IF (cursorTermine = 1) THEN
            LEAVE valpris;
        END IF;
END LOOP valpris;

        IF EXISTS (SELECT * FROM matchrugby WHERE numJournee = v_journee AND idEquipeLocale = id) THEN
            SELECT scoreVisiteurs INTO temp_nbPointPris FROM matchrugby WHERE numJournee = v_journee AND idEquipeLocale = id;
        ELSE
            SELECT scoreLocaux INTO temp_nbPointPris FROM matchrugby WHERE numJournee = v_journee AND idEquipeVisiteuse = id;
        END IF;
        SET nbPointPris = nbPointPris+temp_nbPointPris;
         
    CLOSE cursorJournee;

    RETURN ptnGoal;
END |

