package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class DBConnection {

	private Connection con;
	private Statement st;
	private ResultSet rs;

	public DBConnection() {
		try {
			con = DriverManager.getConnection("jdbc:mysql://localhost/tutorial", "root", "root");
			st = con.createStatement();
		} catch (Exception e) {
			System.out.println("Database Connection Error \n" + e.getMessage());
		}
	}

	public boolean isAdmin(String adminID, String adminPassword) {
		try {
			String SQL = "SELECT * FROM ADMIN WHERE adminID = '" + adminID + "'and adminPassword = '" + adminPassword + "'";
			rs = st.executeQuery(SQL);
			if(rs.next())
				return true;
			else
				return false;
		} catch (Exception e) {
			System.out.println("Search Data Error" + e.getMessage());
			return false;
		}
	}

}