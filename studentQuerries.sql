--Affiche toutes les données.
SELECT  * 
FROM    students;

SELECT  * 
FROM    school;

--Affiche uniquement les prénoms.
SELECT  prenom 
FROM    students;

--Affiche les prénoms, les dates de naissance et l’école de chacun.
SELECT  st.prenom, st.datenaissance, sl.school 
FROM    students as st 
        LEFT JOIN   school as sl
        ON          st.school = sl.idschool;

--Affiche uniquement les élèves qui sont de sexe féminin.
SELECT  * 
FROM    students
WHERE   genre LIKE 'f';

--Affiche uniquement les élèves qui font partie de l’école d'Addy.
SELECT  * 
FROM    students
WHERE   school =   (SELECT school 
                    FROM students 
                    WHERE prenom = 'Addy');

--Affiche uniquement les prénoms des étudiants, par ordre inverse à l’alphabet (DESC). Ensuite, la même chose mais en limitant les résultats à 2.
SELECT      prenom 
FROM        students
ORDER BY    prenom DESC;

SELECT      prenom 
FROM        students
ORDER BY    prenom DESC
LIMIT       2;

--Ajoute Ginette Dalor, née le 01/01/1930 et affecte-la à Bruxelles, toujours en SQL.
INSERT INTO     students (nom, prenom, datenaissance, genre, school)
    SELECT  "Dalor", "Ginette", '01/01/1930', 'F', idschool 
    FROM    school 
    WHERE   school LIKE 'Bruxelles';

--Modifie Ginette (toujours en SQL) et change son sexe et son prénom en “Omer”.
UPDATE  students
    SET     prenom = "Omer",
            genre = 'M'
    WHERE   nom ='Dalor';
--Supprimer la personne dont l’ID est 3.
DELETE FROM students
WHERE       idStudent = 3;

--Modifier le contenu de la colonne School de sorte que "1" soit remplacé par "Liege" et "2" soit remplacé par "Gent". (attention au type de la colonne !)
UPDATE school
    SET     school = 'Liege'
    WHERE   idschool = 1;
UPDATE school
    SET     school = 'Gent'
    WHERE   idschool = 2;
--Faire d’autres manipulations pour voir si t’es bien compris.
