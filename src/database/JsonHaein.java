package database;
import java.io.InputStreamReader;
import java.net.URL;

import org.json.simple.JSONArray;
import org.json.simple.JSONValue;

class Element{

	double HUM; double LNG; double SPD; String VBR; String TIME;
	int VOC; double CO; double NO2; double TEMP; double PRES; double SO2;
	String PM2_5; String PM10; int MCP; double LAT; String node_id;
	
	Element(){};
	
	public double getHUM() {return HUM;}
	public void setHUM(double hUM) {HUM = hUM;}

	public double getLNG() {return LNG;}
	public void setLNG(double lNG) {LNG = lNG;}

	public double getSPD() {return SPD;}
	public void setSPD(double sPD) {SPD = sPD;}

	public String getVBR() {return VBR;}
	public void setVBR(String vBR) {VBR = vBR;}

	public String getTIME() {return TIME;}
	public void setTIME(String tIME) {TIME = tIME;}

	public int getVOC() {return VOC;}
	public void setVOC(int vOC) {VOC = vOC;}

	public double getCO() {return CO;}
	public void setCO(double cO) {CO = cO;}

	public double getNO2() {return NO2;}
	public void setNO2(double nO2) {NO2 = nO2;}

	public double getTEMP() {return TEMP;}
	public void setTEMP(double tEMP) {TEMP = tEMP;}

	public double getPRES() {return PRES;}
	public void setPRES(double pRES) {PRES = pRES;}

	public double getSO2() {return SO2;}
	public void setSO2(double sO2) {SO2 = sO2;}

	public String getPM2_5() {return PM2_5;}
	public void setPM2_5(String pM2_5) {PM2_5 = pM2_5;}

	public String getPM10() {return PM10;}
	public void setPM10(String pM10) {PM10 = pM10;}

	public int getMCP() {return MCP;}
	public void setMCP(int mCP) {MCP = mCP;}

	public double getLAT() {return LAT;}
	public void setLAT(double lAT) {LAT = lAT;}

	public String getNode_id() {return node_id;}
	public void setNode_id(String node_id) {this.node_id = node_id;}

}

public class JsonHaein {
	public static void main(String[] args) {

		try {

			String url = "http://220.123.184.109:8080/KISTI_Web/sensor/whole.do";
			URL postUrl;
			postUrl = new URL(url);

			InputStreamReader isr = new InputStreamReader(postUrl.openConnection().getInputStream(), "UTF-8");

			JSONArray object = (JSONArray)JSONValue.parseWithException(isr);
			
			int objectSize = object.size();
			String stringArr[] = new String[objectSize];
			Element element[] = new Element[objectSize];
	
			for(int n = 0 ; n < objectSize ; n++) {
				stringArr[n] = object.get(n).toString();
				element[n] = new Element();				

				int count = 0;
				for(int i = 0 ; i < stringArr[n].length() ; i++) {
					if(stringArr[n].charAt(i) == ':') {
						for(int j = i ; j < stringArr[n].length() ; j++) {
							if(count == 4 || count == 5|| count == 6) {
								count++;
								break;}
							if(stringArr[n].charAt(j) == ',') {
								switch(count) {
								case 0: element[n].setHUM(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 1: element[n].setLNG(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 2: element[n].setSPD(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 3: element[n].setVBR(stringArr[n].substring(i+1,j)); break;
								case 4: element[n].setTIME(stringArr[n].substring(i+1,j)); break;
								case 7: element[n].setVOC(Integer.parseInt(stringArr[n].substring(i+1,j))); break;
								case 8: element[n].setCO(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 9: element[n].setNO2(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 10: element[n].setTEMP(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 11: element[n].setPRES(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 12: element[n].setSO2(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 13: element[n].setPM2_5(stringArr[n].substring(i+1,j)); break;
								case 14: element[n].setPM10(stringArr[n].substring(i+1,j)); break;
								case 15: element[n].setMCP(Integer.parseInt(stringArr[n].substring(i+1,j))); break;
								case 16: element[n].setLAT(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 17: element[n].setNode_id(stringArr[n].substring(i+1,j)); break;
								}
								count++;
								break;
							}
						}
					}
				}

			}
						
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

}
