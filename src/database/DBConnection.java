package database;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.Statement;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.GregorianCalendar;
import java.util.Locale;

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
				if (element[i].getLNG() < map.part[0][0].getLng() || element[i].getLAT() > map.part[0][0].getLat()
						|| element[i].getLNG() > map.part[41][41].getLng()
						|| element[i].getLAT() < map.part[41][41].getLat()) {
					continue;
				}
				
				if(dataLimit(element[i].getTIME())) {
					continue;
				}
				
				int block = map.searchLocation(element[i].getLNG(), element[i].getLAT());
				/*System.out.println(
						"block -> " + block + " getLNG -> " + element[i].getLNG() + "getLAT -> " + element[i].getLAT());
				*/if (isBlock(block)) {
					String SQL = "UPDATE daeguair SET BLOCK=" + block + "," + "HUM=" + element[i].getHUM() + ","
							+ "LNG=" + element[i].getLNG() + "," + "TIME=" + element[i].getTIME() + "," + "CO="
							+ element[i].getCO() + "," + "NO2=" + element[i].getNO2() + "," + "TEMP="
							+ element[i].getTEMP() + "," + "SO2=" + element[i].getSO2() + "," + "PM2_5="
							+ element[i].getPM2_5() + "," + "PM10=" + element[i].getPM10() + "," + "MCP="
							+ element[i].getMCP() + "," + "LAT=" + element[i].getLAT() + "," + "NODE_ID="
							+ element[i].getNode_id() + "," + "AQI=" + element[i].getAirGrade() + " "
							 + "WHERE BLOCK=" + block + ";";
					st.executeUpdate(SQL);
					//System.out.println("finish UPDATE");
				} else {
					String SQL = "INSERT INTO daeguair VALUES (" + block + "," + element[i].getHUM() + ","
							+ element[i].getLNG() + "," + element[i].getTIME() + "," + element[i].getCO() + ","
							+ element[i].getNO2() + "," + element[i].getTEMP() + "," + element[i].getSO2() + ","
							+ element[i].getPM2_5() + "," + element[i].getPM10() + "," + element[i].getMCP() + ","
							+ element[i].getLAT() + "," + element[i].getNode_id() + "," + element[i].getAirGrade() +
							");";
					st.executeUpdate(SQL);
					//System.out.println("finish INSERT");
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
	
	public boolean dataLimit(String Day) {
		int nYear;
		int nMonth;
		int nDay;
		int nHour;
		int nMinutes;
		int nSecond;
		//현재 날짜 구하기
		Calendar calendar = new GregorianCalendar(Locale.KOREA);
		nYear = calendar.get(Calendar.YEAR);
		nMonth = calendar.get(Calendar.MONTH);
		nDay = calendar.get(Calendar.DAY_OF_MONTH);
		nHour = calendar.get(Calendar.HOUR_OF_DAY);
		nMinutes = calendar.get(Calendar.MINUTE);
		nSecond = calendar.get(Calendar.SECOND);
		
		//Date로 구하기
		SimpleDateFormat fm = new SimpleDateFormat("yyyy-mm-dd HH:mm:ss");
		SimpleDateFormat fm2 = new SimpleDateFormat("\"yyyy-mm-dd HH:mm:ss\"");
		String startDay = nYear+ "-"+nMonth + "-" +nDay + " " + nHour + ":" + nMinutes + ":" + nSecond;
		try {
		Date beginDate = fm.parse(startDay);
		Date endDate = fm2.parse(Day);
		long diff = beginDate.getTime() - endDate.getTime();
		//System.out.println(diff);
		if(diff>86400000 || diff < 0)
			return true;
		else
			return false;
		} catch(Exception e) {
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