-- SQLite

DROP TABLE IF EXISTS categories;

CREATE TABLE IF NOT EXISTS categories (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(255) NOT NULL,
    parent_id INTEGER,
    FOREIGN KEY (parent_id) REFERENCES categories(id) ON DELETE CASCADE
);

DELETE FROM categories;

INSERT INTO categories
VALUES  (1, 'Mammifère', NULL),
        (2, 'Chien', 1),
        (3, 'Chat', 1),
        (4, 'Singe', 1),
        (5, 'Gorille', 4),
        (6, 'Chimpanzé', 4),
        (7, 'Shiba', 2),
        (8, 'Corgi', 2),
        (9, 'Labrador', 2),
        (10, 'Poisson', NULL),
        (11, 'Requin', 10),
        (12, 'Requin blanc', 11),
        (13, 'Grand Requin blanc', 12),
        (14, 'Petit Requin blanc', 12),
        (15, 'Requin marteau', 11),
        (16, 'Requin Tigre', 11),
        (17, 'Poisson rouge', 10),
        (18, 'Poisson chat', 10);

-- REQUETE RECURSIVE --
/* WITH RECURSIVE temptable AS(
    SELECT id, name, parent_id FROM categories WHERE id = 14
    UNION ALL
    SELECT c.id, c.name, c.parent_id FROM categories c, temptable
    WHERE c.id = temptable.parent_id
)
SELECT * FROM temptable

WITH RECURSIVE children (id, name, parent_id, level, path) AS (
    SELECT id, name, parent_id, 0 as level, "" as path FROM categories WHERE id= 11
    UNION ALL
    SELECT 
    c.id,
    c.name,
    c.parent_id,
    children.level +1 as level,
    children.path || children.name || " > " as path
    FROM categories c, children
    WHERE c.parent_id = children.id
)
SELECT id, name, level, path FROM children */

/* SELECT * FROM (
    SELECT
    *,
    SUM(id) OVER w as total,
    ROW_NUMBER() OVER w as row_number 
    FROM categories
    WINDOW w AS (PARTITION BY name ORDER BY parent_id ASC)
) as t
WHERE t.row_number < 4 */

