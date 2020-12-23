import java.sql.*;

public class ll {
    public static void main(String[] args) {

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        }
        catch(ClassNotFoundException e) {
            System.out.println("MySQL JDBC Driver not found!");
            e.printStackTrace();
        }

        final String USERNAME = "ecem.yelkanat";
        final String PASSWORD = "RtjlTyQO";
        final String URL = "jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/ecem_yelkanat";

        Connection connection = null;
        try{
            connection = DriverManager.getConnection(URL,USERNAME,PASSWORD);
        }
        catch(SQLException e){
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
            System.out.println("Dropping tables customer, account, owns..");
            stmt.executeUpdate("DROP TABLE IF EXISTS owns;");
            stmt.executeUpdate("DROP TABLE IF EXISTS account;");
            stmt.executeUpdate("DROP TABLE IF EXISTS customer;");
            System.out.println("Tables have been dropped successfully!");

            System.out.println("Creating table customer..");
            stmt.executeUpdate( "CREATE TABLE customer(" +
                    "cid CHAR(12), " +
                    "name VARCHAR(50), " +
                    "bdate DATE, " +
                    "profession VARCHAR(25), " +
                    "address VARCHAR(50), " +
                    "city CHAR(20), " +
                    "nationality CHAR(20), " +
                    "PRIMARY KEY(cid)) " +
                    "ENGINE=innodb;");
            System.out.println("Customer table has been created successfully!");

            System.out.println("Creating table account..");
            stmt.executeUpdate("CREATE TABLE account(" +
                    "aid CHAR(8), " +
                    "branch VARCHAR(20), " +
                    "balance FLOAT, " +
                    "openDate DATE, " +
                    "PRIMARY KEY(aid))" +
                    "ENGINE=innodb;");
            System.out.println("Account table has been created successfully!");

            System.out.println("Creating table owns..");
            stmt.executeUpdate("CREATE TABLE owns(" +
                    "cid CHAR(12), " +
                    "aid CHAR(8), " +
                    "PRIMARY KEY(cid,aid), " +
                    "FOREIGN KEY (cid) REFERENCES customer(cid), " +
                    "FOREIGN KEY (aid) REFERENCES account(aid) ON DELETE CASCADE)" +
                    "ENGINE=innodb;");
            System.out.println("Account table has been created successfully!");

            System.out.println("Inserting values into table customer..");
            stmt.executeUpdate("INSERT INTO customer VALUES" +
                    "(20000001, 'Cem', '1980-10-10', 'Engineer', 'Tunali', 'Ankara', 'TC'), " +
                    "(20000002, 'Asli', '1985-09-08', 'Teacher', 'Nisantasi', 'Istanbul', 'TC'), " +
                    "(20000003, 'Ahmet', '1995-02-11', 'Salesman', 'Karsiyaka', 'Izmir', 'TC'), " +
                    "(20000004, 'John', '1990-04-16', 'Architect', 'Kizilay', 'Ankara', 'ABD');");
            System.out.println("Values have been inserted into customer table successfully!");

            System.out.println("Inserting values into table account..");
            stmt.executeUpdate("INSERT INTO account VALUES" +
                    "('A0000001', 'Kizilay', 2000.0, '2009-01-01'), " +
                    "('A0000002', 'Bilkent', 8000.0, '2011-01-01'), " +
                    "('A0000003', 'Cankaya', 4000.0, '2012-01-01'), " +
                    "('A0000004', 'Sincan', 1000.0, '2012-01-01'), " +
                    "('A0000005', 'Tandogan', 3000.0, '2012-01-01'), " +
                    "('A0000006', 'Eryaman', 5000.0, '2015-01-01'), " +
                    "('A0000007', 'Umitkoy', 6000.0, '2017-01-01');");
            System.out.println("Values have been inserted into account table successfully!");

            System.out.println("Inserting values into table owns..");
            stmt.executeUpdate("INSERT INTO owns VALUES" +
                    "(20000001, 'A0000001'), " +
                    "(20000001, 'A0000002'), " +
                    "(20000001, 'A0000003'), " +
                    "(20000001, 'A0000004'), " +
                    "(20000002, 'A0000002'), " +
                    "(20000002, 'A0000003'), " +
                    "(20000002, 'A0000005'), " +
                    "(20000003, 'A0000006'), " +
                    "(20000003, 'A0000007'), " +
                    "(20000004, 'A0000006');");
            System.out.println("Values have been inserted into owns table successfully!");

            System.out.println("\n\n------------------------CUSTOMER------------------------");
            System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s%n", "cid", "name", "bdate", "profession", "address", "city", "nationality");
            ResultSet customers = stmt.executeQuery("SELECT * FROM customer");
            while(customers.next()) {
                System.out.printf("%12s | %12s | %12s | %12s | %12s | %12s | %12s%n", customers.getString("cid"), customers.getString("name"), customers.getString("bdate"), customers.getString("profession"), customers.getString("address"), customers.getString("city"), customers.getString("nationality"));

            }
            System.out.println("\n\n------------------------ACCOUNT------------------------");
            System.out.printf("%12s | %12s | %12s | %12s%n", "aid", "branch", "balance", "openDate");
            ResultSet accounts = stmt.executeQuery("SELECT * FROM account");
            while(accounts.next()) {
                System.out.printf("%12s | %12s | %12s | %12s%n", accounts.getString("aid"), accounts.getString("branch"), accounts.getString("balance"), accounts.getString("openDate"));

            }
            System.out.println("\n\n------------------------OWNS------------------------");
            System.out.printf("%12s | %12s%n", "cid", "aid");
            ResultSet owns = stmt.executeQuery("SELECT * FROM owns");
            while(owns.next()) {
                System.out.printf("%12s | %12s%n", owns.getString("cid"), owns.getString("aid"));
            }

        } catch(SQLException e) {
            System.out.println("SQLException: " + e.getMessage());
            e.printStackTrace();
            System.out.println("SQLState: " + e.getSQLState());
            System.out.println("VendorError: " + e.getErrorCode());
        }
    }
}