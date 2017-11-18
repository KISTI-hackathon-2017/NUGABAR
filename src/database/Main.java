package database;

public class Main {
	public static void main(String[] args) {
		
		//DBConnection connection = new DBConnection();
		//connection.insertData();
		JsonHaein data = new JsonHaein();
		Element element[] = data.getElement();
		for(int i = 0 ; i < element.length ; i ++) {
			System.out.println(element[i].getNode_id());
		}
	}
	
}
