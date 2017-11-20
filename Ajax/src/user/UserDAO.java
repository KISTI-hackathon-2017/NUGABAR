package user;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;

public class UserDAO {
	private Connection conn;
	private PreparedStatement pstmt;
	private ResultSet rs;
	
	public UserDAO(){
		try {
			
			String dbURL = "jdbc:mysql://localhost/airstatus";
			String dbID = "root";
			String dbPassword = "root";
			conn = DriverManager.getConnection(dbURL,dbID,dbPassword);
			
		} catch(Exception e) {
			e.printStackTrace();
		}
	}
	public ArrayList<User> insert() {
		String SQL = "SELECT * FROM daeguair";
		ArrayList<User> userList = new ArrayList<User>();
		try {
			pstmt = conn.prepareStatement(SQL);
			rs = pstmt.executeQuery();
			while(rs.next()) {
				User user = new User();
				user.setBlock(rs.getInt(1));
				user.setAqi(rs.getInt(14));
				userList.add(user);
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
		return userList;
	}
}
