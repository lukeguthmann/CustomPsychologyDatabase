-- creates the database psychopathology if it doesn't already exist
CREATE DATABASE IF NOT EXISTS psychopathologyDB;

-- creating the table
CREATE TABLE psychopathologyDB.pathology(
    path_name VARCHAR(255) NOT NULL COMMENT 'cannot have name duplicates',
    path_symptoms TEXT NULL DEFAULT 'no symptoms added',
    path_descriptions TEXT NULL DEFAULT 'no description added',
    PRIMARY KEY(path_name)
    )