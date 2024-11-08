-- users table
CREATE TABLE IF NOT EXISTS users (
                                     id INTEGER PRIMARY KEY AUTOINCREMENT,
                                     username TEXT NOT NULL UNIQUE,
                                     email TEXT NOT NULL UNIQUE,
                                     password TEXT NOT NULL
);

-- shares table
CREATE TABLE IF NOT EXISTS shares (
                                      id INTEGER PRIMARY KEY AUTOINCREMENT,
                                      title TEXT NOT NULL,
                                      body TEXT NOT NULL,
                                      link TEXT,
                                      user_id INTEGER,
                                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                      FOREIGN KEY (user_id) REFERENCES users(id)
);
