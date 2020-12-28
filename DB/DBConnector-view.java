import java.sql.*;

public class Main {
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


            stmt.executeUpdate("CREATE VIEW Published_Games AS" +
                    " SELECT vg.g_ID, vg.g_name, vg.g_version, vg.g_description, vg.g_image, vg.g_price, vg.genre, g_requirements" +
                    " FROM Video_Game vg, publish p WHERE vg.g_ID = p.g_ID" + " ENGINE=innodb;");
            System.out.println("View successfully added!");
)


        } catch(SQLException e) {
            System.out.println("SQLException: " + e.getMessage());
            e.printStackTrace();
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }


    }
}