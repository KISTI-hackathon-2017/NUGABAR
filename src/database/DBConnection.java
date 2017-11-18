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
			con = DriverManager.getConnection("jdbc:mysql://localhost/airstatus", "root", "root");
			st = con.createStatement();
		} catch (Exception e) {
			System.out.println("Database Connection Error \n" + e.getMessage());
		}
	}

	public void insertData() {
		JsonHaein data = new JsonHaein();
		Element element[] = data.getElement();
		try {
			for (int i = 0; i < element.length; i++) {
				String SQL = "INSERT INTO daeguair VALUES (" + element[i].getHUM() + "," + element[i].getLNG() + ","
						+  element[i].getTIME() + "`,"
						+ element[i].getCO() + "," + element[i].getNO2() + "," + element[i].getTEMP() + ","
						+  element[i].getSO2() + ",`" + element[i].getPM2_5() + "`,`"
						+ element[i].getPM10() + "`," + element[i].getMCP() + "," + element[i].getLAT() + ",`"
						+ element[i].getNode_id() + "`,);";
				st.executeUpdate(SQL);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public boolean isAdmin(String adminID, String adminPassword) {
		try {
			String SQL = "SELECT * FROM ADMIN WHERE adminID = '" + adminID + "'and adminPassword = '" + adminPassword
					+ "'";
			rs = st.executeQuery(SQL);
			if (rs.next())
				return true;
			else
				return false;
		} catch (Exception e) {
			System.out.println("Search Data Error" + e.getMessage());
			return false;
		}
	}

}