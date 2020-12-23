package DB;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;

public class c {
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

            stmt.executeUpdate("DROP TABLE IF EXISTS Developer_Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Publisher_Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Company;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Wallet;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Credit_Card;");
            // stmt.executeUpdate("DROP TABLE IF EXISTS Mode;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Video_Game;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Request;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Subscription_Package;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Curator;");
            // stmt.executeUpdate("DROP TABLE IF EXISTS User;");
            stmt.executeUpdate("DROP TABLE IF EXISTS Account;");
            System.out.println("Tables have been dropped successfully!");



        } catch(SQLException e) {
            System.out.println("SQLException: " + e.getMessage());
            e.printStackTrace();
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }


    }

}
