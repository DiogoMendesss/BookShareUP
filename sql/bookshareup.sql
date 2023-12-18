-- will present the results in a neat organized table, but will take more horizontal space. Default mode is 'list', which is more compact but harder to read
.mode columns
-- shows headers at the top of the columns when running queries
.headers ON

PRAGMA foreign_keys=ON;

-- Drop tables if they exist

-- Order matters to avoid foreign key constraints
DROP TABLE IF EXISTS UserBadge;
DROP TABLE IF EXISTS Badges;
DROP TABLE IF EXISTS UserCampus;
DROP TABLE IF EXISTS Borrowing;
DROP TABLE IF EXISTS InterestedIn;
DROP TABLE IF EXISTS BookCopy;
DROP TABLE IF EXISTS BookGenre;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Book;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Campus;


-- User table
CREATE TABLE User (
    up_number INTEGER PRIMARY KEY,
    password TEXT NOT NULL,
    name TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT ('active') CHECK (status IN ('active', 'inactive','reading'))
);

-- Book table
CREATE TABLE Book (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    author TEXT NOT NULL
);

-- Genre table
CREATE TABLE Genre (
    genre TEXT PRIMARY KEY CHECK (genre IN ('Fiction', 'Non-fiction', 'Thriller', 
    'Science', 'Fantasy', 'Mystery', 'Romance', 'Historical Fiction', 'Sci-Fi', 
    'Biography', 'History', 'Self-help', 'Business', 'Poetry', 'Tragedy', 'Comedy', 
    'Manga', 'Comics', 'Classic', 'Dystopia', 'Horror'))
);

-- BookGenre table
CREATE TABLE BookGenre (
    genre TEXT REFERENCES Genre ON DELETE CASCADE ON UPDATE CASCADE,
    book INTEGER REFERENCES Book ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (genre, book)
);

-- BookCopy table
CREATE TABLE BookCopy (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    condition TEXT CHECK (condition IN ('excellent', 'good', 'worn')),
    availability TEXT CHECK (availability IN ('available', 'borrowed')),
    copy_type TEXT CHECK (copy_type IN ('hardcover', 'softcover', 'handbook')),
    owner INTEGER REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    book INTEGER REFERENCES Book ON DELETE CASCADE ON UPDATE CASCADE
);

-- InterestedIn table
CREATE TABLE InterestedIn (
    user INTEGER REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    book INTEGER REFERENCES Book ON DELETE CASCADE ON UPDATE CASCADE,
    interest_level INTEGER CHECK (interest_level IN (1, 2, 3)),
    PRIMARY KEY (user, book)
);

-- Borrowing table
CREATE TABLE Borrowing (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    status TEXT CHECK (status IN ('pending', 'accepted', 'delivered', 'picked-up', 'returned', 'archived', 'expired')),
    copyID INTEGER NOT NULL REFERENCES BookCopy ON DELETE CASCADE ON UPDATE CASCADE,
    user INTEGER NOT NULL REFERENCES User ON DELETE SET NULL ON UPDATE CASCADE,
    start_date TEXT NOT NULL,
    duration INTEGER NOT NULL,
    campus TEXT NOT NULL REFERENCES Campus ON DELETE SET NULL ON UPDATE CASCADE,
    expiration_date TEXT CHECK (expiration_date = DATETIME(start_date, '+' || duration || ' day'))
);

-- Campus table
CREATE TABLE Campus (
    name TEXT PRIMARY KEY,
    pick_up_point TEXT NOT NULL,
    address TEXT NOT NULL
);

-- UserCampus table
CREATE TABLE UserCampus (
    user INTEGER REFERENCES User(up_number) ON DELETE CASCADE ON UPDATE CASCADE,
    campus TEXT REFERENCES Campus(name) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (user, campus)
);

-- Badges table
CREATE TABLE Badges (
    name TEXT PRIMARY KEY CHECK (name IN ('Good Reader', 'Awesome Reader', 'Legendary Reader', 'Good Borrower', 'Awesome Borrower', 'Legendary Borrower')),
    category TEXT CHECK (category IN ('Reader', 'Borrower')),
    rank TEXT CHECK (rank IN ('Bronze', 'Silver', 'Gold', 'Platinum'))
);


-- UserBadge table
CREATE TABLE UserBadge (
    user INTEGER REFERENCES User(up_number) ON DELETE CASCADE ON UPDATE CASCADE,
    badge TEXT REFERENCES Badges(name) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (user, badge)
);

INSERT INTO Book(name, author) VALUES
    ('To Kill a Mockingbird', 'Harper Lee'),
    ('1984', 'George Orwell'),
    ('The Great Gatsby', 'F. Scott Fitzgerald'),
    ('Pride and Prejudice', 'Jane Austen'),
    ('The Catcher in the Rye', 'J.D. Salinger'),
    ('Harry Potter and the Sorcerer''s Stone', 'J.K. Rowling'),
    ('The Hobbit', 'J.R.R. Tolkien'),
    ('Brave New World', 'Aldous Huxley'),
    ('The Lord of the Rings', 'J.R.R. Tolkien'),
    ('The Chronicles of Narnia', 'C.S. Lewis'),
    ('The Da Vinci Code', 'Dan Brown'),
    ('The Hitchhiker''s Guide to the Galaxy', 'Douglas Adams'),
    ('A Game of Thrones', 'George R. R. Martin'),
    ('One Hundred Years of Solitude', 'Gabriel García Márquez'),
    ('Fahrenheit 451', 'Ray Bradbury'),
    ('Moby-Dick', 'Herman Melville'),
    ('The Shining', 'Stephen King'),
    ('The Grapes of Wrath', 'John Steinbeck'),
    ('The Hunger Games', 'Suzanne Collins'),
    ('The Alchemist', 'Paulo Coelho'),
    ('The Kite Runner', 'Khaled Hosseini'),
    ('The Road', 'Cormac McCarthy'),
    ('The Girl with the Dragon Tattoo', 'Stieg Larsson'),
    ('Lord of the Flies', 'William Golding'),
    ('Wuthering Heights', 'Emily Brontë'),
    ('The Color Purple', 'Alice Walker'),
    ('A Tale of Two Cities', 'Charles Dickens'),
    ('The Three Musketeers', 'Alexandre Dumas'),
    ('Anna Karenina', 'Leo Tolstoy'),
    ('The Picture of Dorian Gray', 'Oscar Wilde'),
    ('Dracula', 'Bram Stoker'),
    ('Frankenstein', 'Mary Shelley'),
    ('Jane Eyre', 'Charlotte Brontë'),
    ('The War of the Worlds', 'H.G. Wells'),
    ('The Count of Monte Cristo', 'Alexandre Dumas'),
    ('The Scarlet Letter', 'Nathaniel Hawthorne'),
    ('Great Expectations', 'Charles Dickens'),
    ('Alice''s Adventures in Wonderland', 'Lewis Carroll'),
    ('Crime and Punishment', 'Fyodor Dostoevsky'),
    ('Gone with the Wind', 'Margaret Mitchell'),
    ('Don Quixote', 'Miguel de Cervantes'),
    ('Les Misérables', 'Victor Hugo'),
    ('The Odyssey', 'Homer'),
    ('The Iliad', 'Homer'),
    ('The Divine Comedy', 'Dante Alighieri'),
    ('The Sound and the Fury', 'William Faulkner'),
    ('Atlas Shrugged', 'Ayn Rand'),
    ('A Brief History of Time', 'Stephen Hawking'),
    ('Cosmos', 'Carl Sagan'),
    ('The Selfish Gene', 'Richard Dawkins'),
    ('Sapiens: A Brief History of Humankind', 'Yuval Noah Harari'),
    ('The Diary of Anne Frank', 'Anne Frank'),
    ('The Guns of August', 'Barbara W. Tuchman'),
    ('1776', 'David McCullough'),
    ('The Wright Brothers', 'David McCullough'),
    ('Freakonomics', 'Steven D. Levitt and Stephen J. Dubner')
    ;

    INSERT INTO Genre (genre)
VALUES 
    ('Fiction'), 
    ('Non-fiction'), 
    ('Thriller'), 
    ('Science'), 
    ('Fantasy'), 
    ('Mystery'), 
    ('Romance'), 
    ('Historical Fiction'), 
    ('Sci-Fi'), 
    ('Biography'), 
    ('History'), 
    ('Self-help'), 
    ('Business'), 
    ('Poetry'), 
    ('Tragedy'), 
    ('Comedy'), 
    ('Manga'), 
    ('Comics'),
    ('Classic'),
    ('Dystopia'),
    ('Horror')
    ;

    -- Insert statements for BookGenre relationships (adjusted)
INSERT INTO BookGenre (book, genre) VALUES
    (1, 'Fiction'),
    (1, 'Classic'),
    (1, 'Historical Fiction'),
    (2, 'Fiction'),
    (2, 'Classic'),
    (2, 'Sci-Fi'),
    (3, 'Classic'),
    (3, 'Fiction'),
    (4, 'Romance'),
    (4, 'Fiction'),
    (4, 'Classic'),
    (4, 'Historical Fiction'),
    (5, 'Fiction'),
    (5, 'Classic'),
    (6, 'Fantasy'),
    (6, 'Fiction'),
    (7, 'Classic'),
    (7, 'Fantasy'),
    (7, 'Fiction'),
    (8, 'Classic'),
    (8, 'Fantasy'),
    (8, 'Sci-Fi'),
    (9, 'Fantasy'),
    (9, 'Fiction'),
    (9, 'Classic'),
    (10, 'Fantasy'),
    (10, 'Fiction'),
    (11, 'Thriller'),
    (11, 'Fiction'),
    (11, 'Mystery'),
    (12, 'Sci-Fi'),
    (12, 'Fiction'),
    (13, 'Fantasy'),
    (13, 'Fiction'),
    (14, 'Fiction'),
    (15, 'Fiction'),
    (15, 'Sci-Fi'),
    (15, 'Dystopia'),
    (16, 'Fiction'),
    (16, 'Classic'),
    (17, 'Thriller'),
    (17, 'Fiction'),
    (18, 'Fiction'),
    (18, 'Classic'),
    (18, 'Historical Fiction'),
    (19, 'Fiction'),
    (19, 'Fantasy'),
    (19, 'Dystopia'),
    (20, 'Fantasy'),
    (20, 'Classic'),
    (20, 'Fiction'),
    (21, 'Fiction'),
    (21, 'Historical Fiction'),
    (21, 'Classic'),
    (22, 'Sci-Fi'),
    (22, 'Dystopia'),
    (22, 'Fiction'),
    (23, 'Thriller'),
    (23, 'Fiction'),
    (23, 'Mystery'),
    (24, 'Fiction'),
    (25, 'Fiction'),
    (25, 'Romance'),
    (25, 'Classic'),
    (26, 'Fiction'),
    (26, 'Historical Fiction'),
    (27, 'Historical Fiction'),
    (27, 'Classic'),
    (27, 'Fiction'),
    (28, 'Historical Fiction'),
    (28, 'Classic'),
    (28, 'Fiction'),
    (29, 'Fiction'),
    (29, 'Romance'),
    (29, 'Classic'),
    (30, 'Classic'),
    (30, 'Fiction'),
    (30, 'Horror'),
    (31, 'Fiction'),
    (31, 'Horror'),
    (31, 'Classic'),
    (32, 'Fiction'),
    (32, 'Horror'),
    (32, 'Classic'),
    (33, 'Fiction'),
    (33, 'Historical Fiction'),
    (33, 'Romance'),
    (34, 'Sci-Fi'),
    (34, 'Classic'),
    (34, 'Fiction'),
    (35, 'Classic'),
    (35, 'Fiction'),
    (35, 'Historical Fiction'),
    (36, 'Classic'),
    (36, 'Fiction'),
    (36, 'Historical Fiction'),
    (37, 'Classic'),
    (37, 'Fiction'),
    (37, 'Historical Fiction'),
    (38, 'Fantasy'),
    (38, 'Classic'),
    (38, 'Fiction'),
    (39, 'Classic'),
    (39, 'Fiction'),
    (40, 'Historical Fiction'),
    (40, 'Classic'),
    (40, 'Fiction'),
    (41, 'Fiction'),
    (41, 'Classic'),
    (42, 'Fiction'),
    (42, 'Historical Fiction'),
    (42, 'Classic'),
    (43, 'Classic'),
    (43, 'Fiction'),
    (43, 'Poetry'),
    (44, 'Classic'),
    (44, 'Fiction'),
    (44, 'Poetry'),
    (45, 'Classic'),
    (45, 'Fiction'),
    (45, 'Poetry'),
    (46, 'Fiction'),
    (46, 'Classic'),
    (47, 'Classic'),
    (47, 'Fiction'),
    (48, 'Science'),
    (48, 'Non-fiction'),
    (49, 'Science'),
    (49, 'Non-fiction'),
    (50, 'Science'),
    (50, 'Non-fiction'),
    (51, 'Science'),
    (51, 'History'),
    (51, 'Non-fiction'),
    (52, 'Non-fiction'),
    (52, 'Biography'),
    (52, 'Classic'),
    (53, 'History'),
    (53, 'Non-fiction'),
    (54, 'History'),
    (54, 'Non-fiction'),
    (55, 'History'),
    (55, 'Non-fiction'),
    (55, 'Biography'),
    (56, 'Non-fiction'),
    (56, 'Business');

    INSERT INTO Campus VALUES
    ('FEUP', 'AEFEUP', 'Paranhos'),
    ('FEP', 'AEFEP', 'Ao lado da FEUP'),
    ('FMUP', 'CIM', 'Do outro lado do S. João') 
    ;

    INSERT INTO Badges VALUES
    ('Good Reader','Reader','Bronze'),
    ('Awesome Reader','Reader','Silver'),
    ('Legendary Reader','Reader','Gold'),
    ('Good Borrower','Borrower','Bronze'),
    ('Awesome Borrower','Borrower','Silver'),
    ('Legendary Borrower','Borrower','Gold')
    ;