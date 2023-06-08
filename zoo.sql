8-1.
SELECT name
    FROM teacher
WHERE dept IS NULL;

8-2.
SELECT t.name, d.name
    FROM teacher t
INNER JOIN dept d
ON t.dept = d.id;

8-3.
SELECT t.name, d.name
    FROM teacher t
LEFT JOIN dept d
ON t.dept = d.id;

8-4.
SELECT t.name, d.name
    FROM dept d
LEFT JOIN teacher t
ON d.id = t.dept;

SELECT t.name, d.name
    FROM teacher t
RIGHT JOIN dept d
ON d.id = t.dept;

8-5.
SELECT name, COALESCE(mobile, '07986 444 2266')
    FROM teacher;

8-6.
SELECT t.name, COALESCE(d.name, 'None')
    FROM teacher t
LEFT JOIN dept d
ON t.dept = d.id;

8-7.
-- DISTINCTいらないっぽい？
SELECT COUNT(name), COUNT(mobile)
    FROM teacher;

8-8.
SELECT d.name, COUNT(t.name) c
    FROM teacher t
RIGHT JOIN dept d
ON t.dept = d.id
GROUP BY d.name;

8-9.
SELECT
    name,
    CASE 
        WHEN dept = 1 OR dept =  2 THEN 'Sci'
        ELSE 'Art'
    END a
FROM teacher;

8-10.
SELECT
    name,
    CASE 
        WHEN dept = 1 OR dept =  2 THEN 'Sci'
        WHEN dept = 3 THEN 'Art'
        ELSE 'None'
    END a
FROM teacher;