/* create tables */

create table 67250_A_test.albums(
        id varchar(255) not null,
        title varchar(100),
        artist_id integer not null,
        subject varchar(255),
        date timestamp not null,
        initial_plays integer,
        avg_ratings integer,
        reviews integer,
        description text,
        venue_id integer,
        source varchar(255),
        uploader_email varchar(255),
        taper_name varchar(255),
        transferer_name varchar(255),
        created_at timestamp not null,
        modified_at timestamp,

        primary key(id)
);

create table 67250_A_test.artists(
        id integer not null auto_increment,
        name varchar(255) not null,
        genre_id integer,
        created_at timestamp not null,
        modified_at timestamp,

        primary key(id)
);

create table 67250_A_test.artists_artists(

        id integer not null auto_increment,
        parent_id integer not null,
        child_id integer not null,

        primary key(id)


);

create table 67250_A_test.files(
        id integer not null auto_increment,
        name varchar(255) not null,
        file_type_id integer,
        song_id integer,
        http_location varchar(255) not null,
        album_id varchar(255),
        downloads integer not null,
        bitrate smallint not null,
        size integer not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.file_types(
        id integer not null auto_increment,
        name varchar(255) not null,
        mime_type varchar(16),
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.genres(
        id integer not null auto_increment,
        name varchar(255) not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.artists_genres(
        id integer not null auto_increment,
        artist_id integer not null,
        genre_id integer not null,
        created_at timestamp not null,
        modified_at timestamp,

        primary key(id)
);

create table 67250_A_test.playlists(
        id integer not null auto_increment,
        name varchar(255) not null,
        pkey varchar(255),
        created_at timestamp not null,
        modified_at timestamp,
        user_id integer not null,

         primary key(id)
);

create table 67250_A_test.playlist_songs(
        id integer not null auto_increment,
        song_id integer not null,
        playlist_id integer not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.plays(
        id integer not null auto_increment,
        user_id integer not null,
        song_id integer not null,
        play_count integer DEFAULT 1,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.ratings(
        id integer not null auto_increment,
        user_id integer not null,
        album_id varchar(255) not null,
        likability tinyint(1),
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.reviews(
        id integer not null auto_increment,
        album_id varchar(255) not null,
        user_id integer not null,
        subject varchar(20),
        body text not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.roles(
        id integer not null auto_increment,
        name varchar(255) not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.songs(
        id integer not null auto_increment,
        album_id varchar(255) not null,
        title varchar(50) not null,
        track tinyint not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

create table 67250_A_test.venues(
        id integer not null auto_increment,
        name varchar(255) not null,
        location varchar(50) not null,
        created_at timestamp not null,
        modified_at timestamp,

         primary key(id)
);

 create table 67250_A_test.users(
        id integer not null auto_increment,
        first_name varchar(255),
        last_name varchar(255),
        email varchar(255),
       username varchar(16) not null,
       password varchar(255) not null,
        salt varchar(255) not null,
       created_at timestamp not null,
       modified_at timestamp,
        primary key (id)
    );

    create table 67250_A_test.user_roles(
        id integer not null auto_increment,
      user_id integer not null,
      role_id integer not null,
      created_at timestamp not null,
       modified_at timestamp,
        primary key (id)
    );

/* Add foreign keys */

ALTER TABLE songs
ADD CONSTRAINT fk_song_album FOREIGN KEY (album_id) REFERENCES albums(id);

ALTER TABLE albums
ADD CONSTRAINT fk_album_venue FOREIGN KEY (venue_id) REFERENCES venues(id);

ALTER TABLE albums
ADD CONSTRAINT fk_album_artist FOREIGN KEY (artist_id) REFERENCES
artists(id);

ALTER TABLE artists_artists
ADD CONSTRAINT fk_artistsArtists_artists FOREIGN KEY (parent_id) REFERENCES
artists(id);

ALTER TABLE artists_artists
ADD CONSTRAINT fk_artistsArtists_artists2 FOREIGN KEY (child_id) REFERENCES
artists(id);

ALTER TABLE files
ADD CONSTRAINT fk_files_song FOREIGN KEY (song_id) REFERENCES songs(id);

ALTER TABLE files
ADD CONSTRAINT fk_files_album FOREIGN KEY (album_id) REFERENCES albums(id);

ALTER TABLE files
ADD CONSTRAINT fk_file_type FOREIGN KEY (file_type_id) REFERENCES
file_types(id);

ALTER TABLE artists_genres
ADD CONSTRAINT fk_artists_artistsgenres FOREIGN KEY (artist_id) REFERENCES
artists(id);

ALTER TABLE artists_genres
ADD CONSTRAINT fk_genres_artistsgenres FOREIGN KEY (genre_id) REFERENCES
genres(id);

ALTER TABLE playlists
ADD CONSTRAINT fk_playlist_user FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE playlist_songs
ADD CONSTRAINT fk_Plsongs_playlist FOREIGN KEY (playlist_id) REFERENCES
playlists(id);

ALTER TABLE playlist_songs
ADD CONSTRAINT fk_Plsongs_song FOREIGN KEY (song_id) REFERENCES songs(id);

ALTER TABLE plays
ADD CONSTRAINT fk_plays_user FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE plays
ADD CONSTRAINT fk_Plays_song FOREIGN KEY (song_id) REFERENCES songs(id);

ALTER TABLE ratings
ADD CONSTRAINT fk_ratings_user FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE ratings
ADD CONSTRAINT fk_ratings_album FOREIGN KEY (album_id) REFERENCES
albums(id);

ALTER TABLE reviews
ADD CONSTRAINT fk_reviews_album FOREIGN KEY (album_id) REFERENCES
albums(id);

ALTER TABLE reviews
ADD CONSTRAINT fk_reviews_user FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE user_roles
ADD CONSTRAINT fk_userrole_user FOREIGN KEY (user_id) REFERENCES users(id);

ALTER TABLE user_roles
ADD CONSTRAINT fk_userrole_role FOREIGN KEY (role_id) REFERENCES roles(id);

/* Table constraints */

ALTER TABLE users
ADD UNIQUE (username);

ALTER TABLE users
ADD UNIQUE (email);

ALTER TABLE ratings
ADD UNIQUE (user_id,album_id);

ALTER TABLE genres
ADD UNIQUE (name);

ALTER TABLE playlists
ADD UNIQUE (pkey);

ALTER TABLE playlist_songs
ADD UNIQUE (playlist_id, song_id);

ALTER TABLE plays
ADD UNIQUE (user_id, song_id);

ALTER TABLE roles
ADD UNIQUE (name);

ALTER TABLE user_roles
ADD UNIQUE (user_id, role_id);

ALTER TABLE artists_genres
ADD UNIQUE (artist_id, genre_id);

ALTER TABLE artists_artists
ADD UNIQUE (parent_id, child_id);

ALTER TABLE venues
ADD UNIQUE (name, location);

ALTER TABLE file_types
ADD UNIQUE (name);


/* Default content */

INSERT INTO roles (name) VALUES('member');
INSERT INTO users (username, password, salt) VALUES ('dummyuser', 'dummypassword', 'dummysalt');