/* "sqlite.sqlite3" : "C:\\Users\\Arthur\\Documents\\TUTO DEV\\SQL\\Tuto\\sqlite3.exe", */

-- SQLite --

PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS ingredients_recipes;
DROP TABLE IF EXISTS ingredients;

DROP TABLE IF EXISTS categories_recipes;
DROP TABLE IF EXISTS categories;

DROP TABLE IF EXISTS recipes;
DROP TABLE IF EXISTS users;

CREATE TABLE IF NOT EXISTS users(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    username VARCHAR (150) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS recipes(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    title VARCHAR (150) NOT NULL,
    slug VARCHAR (250) UNIQUE NOT NULL,
    date DATETIME,
    duration INTEGER DEFAULT 0 NOT NULL,
    user_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS categories(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    title VARCHAR(150) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories_recipes(
    recipe_id INTEGER NOT NULL,   
    category_id INTEGER NOT NULL,
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    PRIMARY KEY (recipe_id, category_id),
    UNIQUE (recipe_id, category_id)
);

CREATE TABLE IF NOT EXISTS ingredients(
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    name VARCHAR (150)
    usage_count INTEGER DEFAULT 0 NOT NULL,
);

CREATE TABLE IF NOT EXISTS ingredients_recipes(
    recipe_id INTEGER NOT NULL,    
    ingredient_id INTEGER NOT NULL,
    quantity INTEGER,
    unit VARCHAR (20),
    FOREIGN KEY (recipe_id) REFERENCES recipes(id) ON DELETE CASCADE,
    FOREIGN KEY (ingredient_id) REFERENCES ingredients(id) ON DELETE CASCADE,
    PRIMARY KEY (recipe_id, ingredient_id),
    UNIQUE (recipe_id, ingredient_id)
);

INSERT INTO users (username, email) VALUES
    ('John Doe', 'johndoe@gmail.com');

INSERT INTO categories (title) VALUES
    ('Plat'),
    ('Dessert'),
    ('Gateau');

INSERT INTO recipes (title, slug, duration, user_id) VALUES
    ('Soupe', 'soupe', 10, 1),
    ('Madeleine', 'madeleine', 30, 1),
    ('Salade de fruit', 'salade-de-fruit', 10, 1);

INSERT INTO categories_recipes (recipe_id, category_id) VALUES
    (1, 1),
    (2, 2),
    (2, 3);

INSERT INTO ingredients (name) VALUES
    ('Sucre'),
    ('Farine'),
    ('Levure chimique'),
    ('Beurre'),
    ('Lait'),
    ('Oeuf'),
    ('Miel');  

INSERT INTO ingredients_recipes (recipe_id, ingredient_id, quantity, unit) VALUES
    (2, 1, 150, 'g'),
    (2, 2, 200, 'g'),
    (2, 3, 8, 'g'),
    (2, 4, 100, 'g'),
    (2, 5, 50, 'g'),
    (2, 6, 3, NULL),
    (3, 1, 50, 'g');


-- ORDER ET LIMIT --
/* SELECT DISTINCT i.name
FROM ingredients i
LEFT JOIN ingredients_recipes ir ON ir.ingredient_id = i.id
LEFT JOIN recipes r ON ir.recipe_id = r.id
WHERE ir.recipe_id IS NOT NULL; */

-- JOINTURES --
/* SELECT i.name, COUNT(recipe_id) as count
FROM ingredients i
LEFT JOIN ingredients_recipes ir ON ir.ingredient_id = i.id
LEFT JOIN recipes r ON ir.recipe_id = r.id
GROUP BY i.name
ORDER BY count DESC, i.name ASC
LIMIT 3 OFFSET 2; */

-- REQUETES  IMBRIQUEES --
/* EXPLAIN QUERY PLAN SELECT i.*
FROM ingredients_recipes ir
LEFT JOIN ingredients i ON i.id = ir.ingredient_id
WHERE ir.recipe_id IN (
    SELECT cr.recipe_id
    FROM categories c
    LEFT JOIN categories_recipes cr ON c.id = cr.category_id
); */

-- TRANSACTIONS --
/* BEGIN TRANSACTION;
SELECT * FROM recipes;
DELETE FROM recipes WHERE id = 2;
SELECT * FROM recipes WHERE aeae = 2;
ROLLBACK TRANSACTION;
COMMIT TRANSACTION;
SELECT * FROM recipes;
 */

-- CREER DES VUES --
/* CREATE VIEW recipes_with_ingredients
AS
    SELECT r.title, GROUP_CONCAT(i.name, ', ') AS ingredients
    FROM recipes r
    LEFT JOIN ingredients_recipes ir ON ir.recipe_id = r.id
    LEFT JOIN ingredients i ON ir.ingredient_id = i.id
    GROUP BY r.title;

DROP VIEW recipes_with_ingredients; */

-- TRIGERS --
/* ALTER TABLE ingredients
ADD COLUMN usage_count INTEGER DEFAULT 0;
SELECT * FROM ingredients;

CREATE TRIGGER update_usage_count_on_ingredients_linked
AFTER INSERT ON ingredients_recipes
BEGIN
    UPDATE ingredients
    SET usage_count = usage_count +1
    WHERE id = NEW.ingredient_id;
END;

DROP TRIGGER decrement_usage_count_on_ingredients_unlinked

CREATE TRIGGER decrement_usage_count_on_ingredients_unlinked
AFTER DELETE ON ingredients_recipes
BEGIN
    UPDATE ingredients
    SET usage_count = usage_count -1
    WHERE id = OLD.ingredient_id;
END;

SELECT * FROM sqlite_master
WHERE type ='trigger';

DELETE FROM ingredients_recipes WHERE recipe_id = 1 AND ingredient_id = 7; */








