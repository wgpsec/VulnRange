DROP TABLE IF EXISTS questions;
DROP TABLE IF EXISTS p_cate;
DROP TABLE IF EXISTS s_cate;

CREATE TABLE questions (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  title TEXT NOT NULL,
  hint TEXT NOT NULL,
  p_cate TEXT,
  s_cate TEXT,
  FOREIGN KEY (p_cate) REFERENCES p_cate(fcate_name),
  FOREIGN KEY (s_cate) REFERENCES s_cate(scate_name)
);

CREATE TABLE p_cate(
    fid INTEGER PRIMARY KEY AUTOINCREMENT,
    fcate_name TEXT UNIQUE
);
CREATE TABLE s_cate(
    sid INTEGER PRIMARY KEY AUTOINCREMENT,
    scate_name TEXT UNIQUE ,
    p_cate TEXT ,
    FOREIGN KEY (p_cate) REFERENCES p_cate(fcate_name)
);
UPDATE sqlite_sequence SET seq = 100 WHERE name='s_cate';