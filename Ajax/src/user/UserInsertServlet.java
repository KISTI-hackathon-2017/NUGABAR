package user;

import java.io.IOException;
import java.util.ArrayList;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/UserInsertServlet")
public class UserInsertServlet extends HttpServlet {
	private static final long serialVersionUID = 1L;
       
   	protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
		request.setCharacterEncoding("UTF-8");
		response.setContentType("text/html;charset=UTF-8");
		response.getWriter().write(getJSON());
	}
   	
   	public String getJSON() {
   		StringBuffer result = new StringBuffer("");
   		result.append("[{");
   		UserDAO userDAO = new UserDAO();
   		ArrayList<User> userList = userDAO.insert();
   		for(int i = 0 ; i<userList.size(); i++) {
   			result.append("\"BLOCK\":");
   			result.append("\"" + userList.get(i).getBlock() + "\"");
   			result.append(",");
   			result.append("\"AQI\":");
   			result.append("\"" + userList.get(i).getAqi() + "\"");
   			if(i != userList.size()-1)
   			result.append("},");
   		}
   		result.append("]");
   		return result.toString();
   	}

}
