package database;

public class Main {
	public static void main(String[] args) {
		
		//DBConnection connection = new DBConnection();
		//connection.insertData();
		JsonHaein data = new JsonHaein();
		Element element[] = data.getElement();
		
		System.out.println("HUM -> " + element[30].getHUM());
		System.out.println("LNG -> " + element[30].getLNG());
	//	System.out.println("SPD -> " + element[30].getSPD());
	//	System.out.println("VBR -> " + element[30].getVBR());
		System.out.println("TIME -> " + element[30].getTIME());
//		System.out.println("VOC -> " + element[30].getVOC());
		System.out.println("CO -> " + element[30].getCO());
		System.out.println("NO2 -> " + element[30].getNO2());
		System.out.println("TEMP -> " + element[30].getTEMP());
	//	System.out.println("PRES-> " + element[30].getPRES());
		System.out.println("SO2 -> " + element[30].getSO2());
		System.out.println("PM2.5 -> " + element[30].getPM2_5());
		System.out.println("PM10 -> " + element[30].getPM10());
		System.out.println("MCP -> " + element[30].getMCP());
		System.out.println("LAT -> " + element[30].getLAT());
		System.out.println("NODE_ID -> " + element[30].getNode_id());
	}
	
}
