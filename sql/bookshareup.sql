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
DROP TABLE IF EXISTS Campus;
DROP TABLE IF EXISTS Borrowing;
DROP TABLE IF EXISTS Proposal;
DROP TABLE IF EXISTS InterestedIn;
DROP TABLE IF EXISTS BookCopy;
DROP TABLE IF EXISTS BookGenre;
DROP TABLE IF EXISTS Genre;
DROP TABLE IF EXISTS Book;
DROP TABLE IF EXISTS User;


-- User table
CREATE TABLE User (
    up_number INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    status TEXT NOT NULL CHECK (status IN ('active', 'inactive'))
);

-- Book table
CREATE TABLE Book (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    author TEXT NOT NULL
);

-- Genre table
CREATE TABLE Genre (
    genre TEXT PRIMARY KEY CHECK (genre IN ('fiction', 'non-fiction', 'thriller'))
);

-- BookGenre table
CREATE TABLE BookGenre (
    genre TEXT REFERENCES Genre,
    book INTEGER REFERENCES Book,
    PRIMARY KEY (genre, book)
);

-- BookCopy table
CREATE TABLE BookCopy (
    id INTEGER PRIMARY KEY,
    condition TEXT CHECK (condition IN ('excellent', 'good', 'worn')),
    availability TEXT CHECK (availability IN ('available', 'borrowed')),
    copy_type TEXT CHECK (copy_type IN ('hardcover', 'softcover', 'handbook')),
    owner INTEGER REFERENCES User,
    book INTEGER REFERENCES Book
);

-- InterestedIn table
CREATE TABLE InterestedIn (
    user INTEGER REFERENCES User,
    book INTEGER REFERENCES Book,
    interest_level INTEGER CHECK (interest_level IN (1, 2, 3)),
    PRIMARY KEY (user, book)
);

-- Proposal table
CREATE TABLE Proposal (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    bookcopy INTEGER REFERENCES Book,
    status TEXT CHECK (status IN ('showing', 'hidden'))
);

-- Borrowing table
CREATE TABLE Borrowing (
    status TEXT CHECK (status IN ('pending', 'delivered', 'picked-up', 'expired', 'returned')),
    proposal INTEGER NOT NULL REFERENCES Proposal,
    user INTEGER NOT NULL REFERENCES User,
    start_date TEXT NOT NULL,
    duration INTEGER NOT NULL,
    campus TEXT NOT NULL REFERENCES Campus,
    expiration_date TEXT CHECK (expiration_date = DATETIME(start_date, '+' || duration || ' day')),
    PRIMARY KEY (user, proposal)
);

-- Campus table
CREATE TABLE Campus (
    name TEXT PRIMARY KEY,
    pick_up_point TEXT NOT NULL,
    address TEXT NOT NULL
);

-- UserCampus table
CREATE TABLE UserCampus (
    user INTEGER REFERENCES User(up_number),
    campus TEXT REFERENCES Campus(name),
    PRIMARY KEY (user, campus)
);

-- Badges table
CREATE TABLE Badges (
    name TEXT PRIMARY KEY CHECK (name IN ('BookGuru', 'Frankenstein')),
    category TEXT CHECK (category IN ('campus', 'genre', 'activity')),
    rank TEXT CHECK (rank IN ('bronze', 'silver', 'gold', 'platinum'))
);

-- UserBadge table
CREATE TABLE UserBadge (
    user INTEGER REFERENCES User(up_number),
    badge TEXT REFERENCES Badges(name),
    PRIMARY KEY (user, badge)
);
