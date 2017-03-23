use alienbase;

-- Amount of crew that belongs to a certain department
SELECT departmentPlace, COUNT(*) AS amount FROM crew GROUP BY departmentPlace;