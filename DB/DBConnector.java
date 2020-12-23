import java.sql.*;

public class DBConnector {
    public static void main(String[] args) {

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.out.println("MySQL JDBC Driver not found!");
            e.printStackTrace();
        }

        final String USERNAME = "ecem.yelkanat";
        final String PASSWORD = "RtjlTyQO";
        final String URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/ecem_yelkanat";

        Connection connection = null;
        try {
            connection = DriverManager.getConnection(URL, USERNAME, PASSWORD);
        } catch (SQLException e) {
            System.out.println("Connection failed!");
            e.printStackTrace();
        }

        if (connection != null) {
            System.out.println("Connection established successully");
        } else {
            System.out.println("Connection failed to established!");
        }

        Statement stmt;

        try {
            stmt = connection.createStatement();

            // Drop tables if exist
            System.out.println("Dropping tables ..");

            stmt.executeUpdate("DROP TABLE IF EXISTS subscribes;");
            stmt.executeUpdate("DROP TABLE IF EXISTS followed_by;");
            stmt.executeUpdate("DROP TABLE IF EXISTS friendship;");
            stmt.executeUpdate("DROP TABLE IF EXISTS review;");
            stmt.executeUpdate("DROP TABLE IF EXISTS builds;");
            stmt.executeUpdate("DROP TABLE IF EXISTS downloads;");
            stmt.executeUpdate("DROP TABLE IF EXISTS for_m;");
            stmt.executeUpdate("DROP TABLE IF EXISTS rates;");
            stmt.executeUpdate("DROP TABLE IF EXISTS buys;");
            stmt.executeUpdate("DROP TABLE IF EXISTS install;");
            stmt.executeUpdate("DROP TABLE IF EXISTS comments_on;");
            stmt.executeUpdate("DROP TABLE IF EXISTS include;");
            stmt.executeUpdate("DROP TABLE IF EXISTS develops;");
            stmt.executeUpdate("DROP TABLE IF EXISTS updates;");
            stmt.executeUpdate("DROP TABLE IF EXISTS contains;");
            stmt.executeUpdate("DROP TABLE IF EXISTS asks;");
            stmt.executeUpdate("DROP TABLE IF EXISTS about;");
            stmt.executeUpdate("DROP TABLE IF EXISTS publish;");
            stmt.executeUpdate("DROP TABLE IF EXISTS takes;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Wallet;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Credit_Card;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Request;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Subscription_Package;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Mode;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Video_Game;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Curator;");
            stmt.executeUpdate("DROP TABLE IF EXISTS User;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Developer_Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Publisher_Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Accountt;");


            System.out.println("Tables have been dropped successfully!");

            System.out.println("Creating table Account..");
            stmt.executeUpdate( "CREATE TABLE Accountt(" +
                    "a_ID INT AUTO_INCREMENT, " +
                    "email_address VARCHAR(64) NOT NULL UNIQUE, " +
                    "phone_number VARCHAR(15) UNIQUE, " +
                    "password VARCHAR(32) NOT NULL, " +
                    "PRIMARY KEY(a_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Account table has been created successfully!");

            System.out.println("Creating table User..");
            stmt.executeUpdate("CREATE TABLE User(" +
                    "a_ID INT, " +
                    "u_name CHAR(30)  NOT NULL, " +
                    "nick_name CHAR(15) NOT NULL UNIQUE, " +
                    "PRIMARY KEY (a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Accountt (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("User table has been created successfully!");

            System.out.println("Creating table Curator..");
            stmt.executeUpdate("CREATE TABLE Curator(" +
                    "a_ID INT, " +
                    "PRIMARY KEY(a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("Curator table has been created successfully!");

            System.out.println("Creating table Company..");
            stmt.executeUpdate("CREATE TABLE Company(" +
                    "a_ID INT, " +
                    "c_name CHAR(30) NOT NULL UNIQUE, " +
                    "PRIMARY KEY(a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Accountt (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("Company table has been created successfully!");

            System.out.println("Creating table Developer_Company..");
            stmt.executeUpdate("CREATE TABLE Developer_Company(" +
                    "a_ID INT, " +
                    "PRIMARY KEY(a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("Developer_Company table has been created successfully!");

            System.out.println("Creating table Publisher_Company..");
            stmt.executeUpdate("CREATE TABLE Publisher_Company(" +
                    "a_ID INT, " +
                    "PRIMARY KEY(a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("Publisher_Company table has been created successfully!");

            System.out.println("Creating table Wallet..");
            stmt.executeUpdate("CREATE TABLE Wallet(" +
                    "a_ID INT, " +
                    "w_ID INT, " +
                    "balance INT DEFAULT 0, " +
                    "PRIMARY KEY(a_ID, w_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("Wallet table has been created successfully!");

            System.out.println("Creating table Credit Card..");
            stmt.executeUpdate("CREATE TABLE Credit_Card(" +
                    "card_ID CHAR(16), " +
                    "bank VARCHAR(20), " +
                    "name VARCHAR(50), " +
                    "exp_date DATE NOT NULL, " +
                    "PRIMARY KEY(card_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Credit Card table has been created successfully!");

            System.out.println("Creating table Video Game..");
            stmt.executeUpdate("CREATE TABLE Video_Game(" +
                    "g_ID INT AUTO_INCREMENT, " +
                    "g_name VARCHAR(20) NOT NULL UNIQUE, " +
                    "g_version VARCHAR(5) DEFAULT '1.0.0', " +
                    "g_description VARCHAR(280) NOT NULL, " +
                    "g_image VARBINARY(512), " +
                    "g_price INT DEFAULT 0, " +
                    "genre VARCHAR(15), " +
                    "g_requirements VARCHAR(280) NOT NULL, " +
                    "PRIMARY KEY(g_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Video Game table has been created successfully!");

            System.out.println("Creating table Mod..");
            stmt.executeUpdate("CREATE TABLE Mode(" +
                    "m_ID INT AUTO_INCREMENT, " +
                    "m_name VARCHAR(20) NOT NULL UNIQUE, " +
                    "m_description VARCHAR(280) NOT NULL, " +
                    "m_size INT NOT NULL DEFAULT 0, " +
                    "PRIMARY KEY(m_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Mod table has been created successfully!");

            System.out.println("Creating table Request..");
            stmt.executeUpdate("CREATE TABLE Request(" +
                    "r_ID INT AUTO_INCREMENT, " +
                    "PRIMARY KEY(r_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Request table has been created successfully!");

            System.out.println("Creating table Subscription Package..");
            stmt.executeUpdate("CREATE TABLE Subscription_Package(" +
                    "package_ID INT AUTO_INCREMENT, " +
                    "package_name VARCHAR(30) NOT NULL, " +
                    "price INT DEFAULT 0, " +
                    "duration TIME, " +
                    "PRIMARY KEY(package_ID)) " +
                    "ENGINE=innodb;");
            System.out.println("Subscription Package table has been created successfully!");

            System.out.println("Creating table subscribes..");
            stmt.executeUpdate("CREATE TABLE subscribes(" +
                    "a_ID INT, " +
                    "package_ID INT, " +
                    "date Date, " +
                    "PRIMARY KEY(a_ID, package_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (package_ID) REFERENCES Subscription_Package (package_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("subscribes table has been created successfully!");

            System.out.println("Creating table followed by..");
            stmt.executeUpdate("CREATE TABLE followed_by(" +
                    "c_ID INT, " +
                    "a_ID INT, " +
                    "PRIMARY KEY(c_ID, a_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (c_ID) REFERENCES Curator (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("followed by table has been created successfully!");

            System.out.println("Creating table friendship..");
            stmt.executeUpdate("CREATE TABLE friendship(" +
                    "starter INT, " +
                    "target INT, " +
                    "PRIMARY KEY(starter, target), " +
                    "FOREIGN KEY (starter) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (target) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("friendship table has been created successfully!");

            System.out.println("Creating table review..");
            stmt.executeUpdate("CREATE TABLE review(" +
                    "c_ID INT, " +
                    "g_ID INT, " +
                    "text VARCHAR(140) NOT NULL, " +
                    "date DATE, " +
                    "PRIMARY KEY(c_ID, g_ID), " +
                    "FOREIGN KEY (c_ID) REFERENCES Curator (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("review table has been created successfully!");

            System.out.println("Creating table builds..");
            stmt.executeUpdate("CREATE TABLE builds(" +
                    "m_ID INT, " +
                    "a_ID INT, " +
                    "PRIMARY KEY(m_ID), " +
                    "FOREIGN KEY (m_ID) REFERENCES Mode (m_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("builds table has been created successfully!");

            System.out.println("Creating table downloads..");
            stmt.executeUpdate("CREATE TABLE downloads(" +
                    "m_ID INT, " +
                    "a_ID INT, " +
                    "PRIMARY KEY(m_ID, a_ID), " +
                    "FOREIGN KEY (m_ID) REFERENCES Mode (m_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("downloads table has been created successfully!");

            System.out.println("Creating table for m..");
            stmt.executeUpdate("CREATE TABLE for_m(" +
                    "m_ID INT, " +
                    "g_ID INT, " +
                    "PRIMARY KEY(m_ID), " +
                    "FOREIGN KEY (m_ID) REFERENCES Mode (m_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("for m table has been created successfully!");

            System.out.println("Creating table rates..");
            stmt.executeUpdate("CREATE TABLE rates(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "value INT, " +
                    "PRIMARY KEY(a_ID, g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("rates table has been created successfully!");

            System.out.println("Creating table buys..");
            stmt.executeUpdate("CREATE TABLE buys(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "date DATE, " +
                    "PRIMARY KEY(a_ID, g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("buys table has been created successfully!");

            System.out.println("Creating table install..");
            stmt.executeUpdate("CREATE TABLE install(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "version_no VARCHAR(15), " +
                    "PRIMARY KEY(a_ID, g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("install table has been created successfully!");

            System.out.println("Creating table comments on..");
            stmt.executeUpdate("CREATE TABLE comments_on(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "date DATE NOT NULL, " +
                    "text VARCHAR(140) NOT NULL, " +
                    "PRIMARY KEY(a_ID, g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES User (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("comments on table has been created successfully!");

            System.out.println("Creating table include..");
            stmt.executeUpdate("CREATE TABLE include(" +
                    "card_ID CHAR(16), " +
                    "w_ID INT, " +
                    "a_ID INT, " +
                    "PRIMARY KEY(card_ID), " +
                    "FOREIGN KEY (card_ID) REFERENCES Credit_Card (card_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID, w_ID) REFERENCES Wallet (a_ID, w_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("include table has been created successfully!");

            System.out.println("Creating table develops..");
            stmt.executeUpdate("CREATE TABLE develops(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "PRIMARY KEY(g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Developer_Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("develops table has been created successfully!");

            System.out.println("Creating table updates..");
            stmt.executeUpdate("CREATE TABLE updates(" +
                    "a_ID INT, " +
                    "g_ID INT, " +
                    "date DATE , " +
                    "version_no VARCHAR(15), " +
                    "description VARCHAR(140), " +
                    "PRIMARY KEY(g_ID), " +
                    "FOREIGN KEY (a_ID) REFERENCES Developer_Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("updates table has been created successfully!");

            System.out.println("Creating table contains..");
            stmt.executeUpdate("CREATE TABLE contains(" +
                    "package_ID INT, " +
                    "g_ID INT, " +
                    "PRIMARY KEY(package_ID, g_ID), " +
                    "FOREIGN KEY (package_ID) REFERENCES Subscription_Package (package_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("contains table has been created successfully!");

            System.out.println("Creating table asks..");
            stmt.executeUpdate("CREATE TABLE asks(" +
                    "r_ID INT, " +
                    "a_ID INT, " +
                    "PRIMARY KEY(r_ID), " +
                    "FOREIGN KEY (r_ID) REFERENCES Request (r_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID) REFERENCES Developer_Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("asks table has been created successfully!");

            System.out.println("Creating table about..");
            stmt.executeUpdate("CREATE TABLE about(" +
                    "r_ID INT, " +
                    "g_ID INT, " +
                    "PRIMARY KEY(r_ID), " +
                    "FOREIGN KEY (r_ID) REFERENCES Request (r_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("about table has been created successfully!");

            System.out.println("Creating table publish..");
            stmt.executeUpdate("CREATE TABLE publish(" +
                    "g_ID INT, " +
                    "a_ID INT, " +
                    "date DATE , " +
                    "PRIMARY KEY(g_ID), " +
                    "FOREIGN KEY (g_ID) REFERENCES Video_Game (g_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID) REFERENCES Publisher_Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("publish table has been created successfully!");

            System.out.println("Creating table takes..");
            stmt.executeUpdate("CREATE TABLE takes(" +
                    "r_ID INT, " +
                    "a_ID INT, " +
                    "state VARCHAR(10), " +
                    "PRIMARY KEY(r_ID), " +
                    "FOREIGN KEY (r_ID) REFERENCES Request (r_ID) ON DELETE CASCADE ON UPDATE RESTRICT, " +
                    "FOREIGN KEY (a_ID) REFERENCES Publisher_Company (a_ID) ON DELETE CASCADE ON UPDATE RESTRICT)" +
                    "ENGINE=innodb;");
            System.out.println("takes table has been created successfully!");


        } catch(SQLException e) {
            System.out.println("SQLException: " + e.getMessage());
            e.printStackTrace();
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }


    }
}