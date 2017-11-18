package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;

public class DBConnection {

	private Connection con;
	private Statement st;
	private ResultSet rs;
	MapDevide map;

	public DBConnection() {
		try {
			map = new MapDevide();
			con = DriverManager.getConnection("jdbc:mysql://localhost/airstatus", "root", "root");
			st = con.createStatement();
		} catch (Exception e) {
		e.printStackTrace();
		}
	}

	public void insertData() {
		JsonHaein data = new JsonHaein();
		Element element[] = data.getElement();
		try {
			for (int i = 0; i < element.length; i++) {
				int block = map.searchLocation(element[i].getLNG(), element[i].getLAT());
				System.out.println("block ->" + block + "getLat -> " + element[i].getLAT() + "getLNG" + element[i].getLNG());
				if (isBlock(block)) {
					String SQL = "UPDATE daeguair SET BLOCK=" + block + "," + "HUM=" + element[i].getHUM() + ","
							+ "LNG=" + element[i].getLNG() + "," + "TIME=" + element[i].getTIME() + "," + "CO="
							+ element[i].getCO() + "," + "NO2=" + element[i].getNO2() + "," + "TEMP="
							+ element[i].getTEMP() + "," + "SO2=" + element[i].getSO2() + "," + "PM2_5="
							+ element[i].getPM2_5() + "," + "PM10=" + element[i].getPM10() + "," + "MCP="
							+ element[i].getMCP() + "," + "LAT=" + element[i].getLAT() + "," + "NODE_ID="
							+ element[i].getNode_id() + "WHERE BLOCK=" + block +";";
					st.executeUpdate(SQL);
					System.out.println("finish UPDATE");
				} else {
				String SQL = "INSERT INTO daeguair VALUES (" + block + "," + element[i].getHUM() + ","
						+ element[i].getLNG() + "," + element[i].getTIME() + "," + element[i].getCO() + ","
						+ element[i].getNO2() + "," + element[i].getTEMP() + "," + element[i].getSO2() + ","
						+ element[i].getPM2_5() + "," + element[i].getPM10() + "," + element[i].getMCP() + ","
						+ element[i].getLAT() + "," + element[i].getNode_id() + ");";
				st.executeUpdate(SQL);
				System.out.println("finish INSERT");
				}
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public boolean isBlock(int blockNum) {
		try {
			String SQL = "SELECT BLOCK FROM daeguair WHERE BLOCK = " + blockNum;
			rs = st.executeQuery(SQL);
			if (rs.next())
				return true;
			else
				return false;
		} catch (Exception e) {
			e.printStackTrace();
		}
		return false;
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
			e.printStackTrace();
			return false;
		}
	}

}