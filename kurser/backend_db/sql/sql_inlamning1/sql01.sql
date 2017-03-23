use alienbase;

-- Amount of crew that belongs to a certain rank
SELECT rank, COUNT(*) AS amount FROM crew GROUP BY rank;