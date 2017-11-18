package database;
import java.io.InputStreamReader;
import java.net.URL;

import org.json.simple.JSONArray;
import org.json.simple.JSONValue;



public class JsonHaein {
	Element element[];
	public JsonHaein(){
		try {

			String url = "http://220.123.184.109:8080/KISTI_Web/sensor/whole.do";
			URL postUrl;
			postUrl = new URL(url);

			InputStreamReader isr = new InputStreamReader(postUrl.openConnection().getInputStream(), "UTF-8");

			JSONArray object = (JSONArray)JSONValue.parseWithException(isr);
			
			int objectSize = object.size();
			String stringArr[] = new String[objectSize];
			element = new Element[objectSize];
	
			for(int n = 0 ; n < objectSize ; n++) {
				stringArr[n] = object.get(n).toString();
				element[n] = new Element();				

				int count = 0;
				for(int i = 0 ; i < stringArr[n].length() ; i++) {
					if(stringArr[n].charAt(i) == ':') {
						for(int j = i ; j < stringArr[n].length() ; j++) {
							if( count == 5|| count == 6) {
								count++;
								break;}
							if(stringArr[n].charAt(j) == ',' || count == 17) {
								switch(count) {
								case 0: element[n].setHUM(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 1: element[n].setLNG(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								//case 2: element[n].setSPD(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								//case 3: element[n].setVBR(stringArr[n].substring(i+1,j)); break;
								case 4: element[n].setTIME(stringArr[n].substring(i+1,j)); break;
								//case 7: element[n].setVOC(Integer.parseInt(stringArr[n].substring(i+1,j))); break;
								case 8: element[n].setCO(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 9: element[n].setNO2(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 10: element[n].setTEMP(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								//case 11: element[n].setPRES(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 12: element[n].setSO2(Double.parseDouble(stringArr[n].substring(i+1,j))); break;
								case 13: for(int k = i+1 ; k < j ; k++) {
											if(stringArr[n].charAt(k) == ';') {
												element[n].setPM2_5(Integer.parseInt(stringArr[n].substring(k+1,j-1))); break;
											}
										} break;
								case 14: for(int k = i+1 ; k < j ; k++) {
											if(stringArr[n].charAt(k) == ';') {
												element[n].setPM2_5(Integer.parseInt(stringArr[n].substring(k+1,j-1))); break;
											}
										} break;
								case 15: element[n].setMCP(Integer.parseInt(stringArr[n].substring(i+1,j))); break;
								case 16: element[n].setLAT(Double.parseDouble(stringArr[n].substring(i+1,j)));break;
								case 17: element[n].setNode_id(stringArr[n].substring(i+1, stringArr[n].length()-1)); break;
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
	public Element[] getElement() {
		return element;
	}
	public void setElement(Element[] element) {
		this.element = element;
	}
	

}
