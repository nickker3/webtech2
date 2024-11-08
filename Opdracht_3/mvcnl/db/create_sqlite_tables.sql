CREATE TABLE IF NOT EXISTS users (
                                     id INTEGER PRIMARY KEY AUTOINCREMENT,
                                     username TEXT NOT NULL UNIQUE,
                                     password TEXT NOT NULL,
                                     email TEXT NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS shares (
                                      id INTEGER PRIMARY KEY AUTOINCREMENT,
                                      title TEXT NOT NULL,
                                      body TEXT NOT NULL,
                                      link TEXT,
                                      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                      user_id INTEGER,
                                      FOREIGN KEY (user_id) REFERENCES users(id)
);
