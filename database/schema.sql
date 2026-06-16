-- =========================================
-- TABLE USERS
-- =========================================
CREATE TABLE users (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       name VARCHAR(255),
                       email VARCHAR(255) UNIQUE,
                       password VARCHAR(255),
                       role VARCHAR(50) DEFAULT 'user',
                       number VARCHAR(50),
                       created_at DATETIME,
                       updated_at DATETIME
);

-- =========================================
-- TABLE TEAMS
-- =========================================
CREATE TABLE teams (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       name VARCHAR(255) NOT NULL,
                       slug VARCHAR(255) UNIQUE NOT NULL,
                       age_range VARCHAR(255),
                       created_at DATETIME,
                       updated_at DATETIME
);

-- =========================================
-- TABLE PLAYERS
-- =========================================
CREATE TABLE players (
                         id INTEGER PRIMARY KEY AUTOINCREMENT,
                         name VARCHAR(255) NOT NULL,
                         number INTEGER,
                         position VARCHAR(255),
                         goals INTEGER DEFAULT 0,
                         matches INTEGER DEFAULT 0,
                         team_id INTEGER NOT NULL,
                         image VARCHAR(255),
                         created_at DATETIME,
                         updated_at DATETIME,

                         FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE CASCADE
);

-- =========================================
-- TABLE COACHES
-- =========================================
CREATE TABLE coaches (
                         id INTEGER PRIMARY KEY AUTOINCREMENT,
                         name VARCHAR(255),
                         role VARCHAR(255),
                         team_id INTEGER,
                         image VARCHAR(255),
                         created_at DATETIME,
                         updated_at DATETIME,

                         FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

-- =========================================
-- TABLE PRODUCTS
-- =========================================
CREATE TABLE products (
                          id INTEGER PRIMARY KEY AUTOINCREMENT,
                          name VARCHAR(255),
                          price FLOAT,
                          description TEXT,
                          image VARCHAR(255),
                          type VARCHAR(50),
                          created_at DATETIME,
                          updated_at DATETIME
);

-- =========================================
-- TABLE ORDERS
-- =========================================
CREATE TABLE orders (
                        id INTEGER PRIMARY KEY AUTOINCREMENT,
                        user_id INTEGER,
                        total FLOAT,
                        status VARCHAR(50),
                        created_at DATETIME,
                        updated_at DATETIME,

                        FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================================
-- TABLE ORDER_PRODUCT (pivot)
-- =========================================
CREATE TABLE order_product (
                               id INTEGER PRIMARY KEY AUTOINCREMENT,
                               order_id INTEGER,
                               product_id INTEGER,
                               quantity INTEGER,
                               created_at DATETIME,
                               updated_at DATETIME,

                               FOREIGN KEY (order_id) REFERENCES orders(id),
                               FOREIGN KEY (product_id) REFERENCES products(id)
);

-- =========================================
-- TABLE LICENSES
-- =========================================
CREATE TABLE licenses (
                          id INTEGER PRIMARY KEY AUTOINCREMENT,
                          user_id INTEGER,
                          status VARCHAR(50),
                          created_at DATETIME,
                          updated_at DATETIME,

                          FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================================
-- TABLE NEWS
-- =========================================
CREATE TABLE news (
                      id INTEGER PRIMARY KEY AUTOINCREMENT,
                      title VARCHAR(255),
                      content TEXT,
                      is_published BOOLEAN DEFAULT 0,
                      featured BOOLEAN DEFAULT 0,
                      created_at DATETIME,
                      updated_at DATETIME
);

-- =========================================
-- TABLE NEWS COMMENTS
-- =========================================
CREATE TABLE news_comments (
                               id INTEGER PRIMARY KEY AUTOINCREMENT,
                               news_id INTEGER,
                               user_id INTEGER,
                               content TEXT,
                               created_at DATETIME,
                               updated_at DATETIME,

                               FOREIGN KEY (news_id) REFERENCES news(id),
                               FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================================
-- TABLE NEWS LIKES
-- =========================================
CREATE TABLE news_likes (
                            id INTEGER PRIMARY KEY AUTOINCREMENT,
                            news_id INTEGER,
                            user_id INTEGER,

                            FOREIGN KEY (news_id) REFERENCES news(id),
                            FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================================
-- TABLE GALLERY IMAGES
-- =========================================
CREATE TABLE gallery_images (
                                id INTEGER PRIMARY KEY AUTOINCREMENT,
                                user_id INTEGER,
                                image VARCHAR(255),
                                created_at DATETIME,
                                updated_at DATETIME,

                                FOREIGN KEY (user_id) REFERENCES users(id)
);

-- =========================================
-- TABLE LIKES (gallery)
-- =========================================
CREATE TABLE likes (
                       id INTEGER PRIMARY KEY AUTOINCREMENT,
                       user_id INTEGER,
                       image_id INTEGER,

                       FOREIGN KEY (user_id) REFERENCES users(id),
                       FOREIGN KEY (image_id) REFERENCES gallery_images(id)
);

-- =========================================
-- TABLE COMMENTS (gallery)
-- =========================================
CREATE TABLE comments (
                          id INTEGER PRIMARY KEY AUTOINCREMENT,
                          user_id INTEGER,
                          image_id INTEGER,
                          content TEXT,

                          FOREIGN KEY (user_id) REFERENCES users(id),
                          FOREIGN KEY (image_id) REFERENCES gallery_images(id)
);

-- =========================================
-- TABLE MATCHES
-- =========================================
CREATE TABLE matches (
                         id INTEGER PRIMARY KEY AUTOINCREMENT,
                         team1 VARCHAR(255),
                         team2 VARCHAR(255),
                         score VARCHAR(50),
                         match_date DATETIME,
                         created_at DATETIME,
                         updated_at DATETIME
);
