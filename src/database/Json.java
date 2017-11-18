package database;

import java.io.InputStreamReader;
import java.net.URL;

import org.json.simple.JSONObject;
import org.json.simple.JSONValue;

public class Json {

	public static void main(String [] args) {
		try {
			
			String url = "http://220.123.184.109:8080/KISTI_Web/sensor/whole.do";
			URL postUrl;
			postUrl = new URL(url);

			InputStreamReader isr = new InputStreamReader(postUrl.openConnection().getInputStream(), "UTF-8");
			JSONObject object = (JSONObject) JSONValue.parseWithException(isr);

			System.out.println("jObj : " + object.toString());

			System.out.println("returnValue : " + object.get("returnValue"));
			System.out.println("drwtNo1 : " + object.get("drwtNo1"));
			System.out.println("drwtNo2 : " + object.get("drwtNo2"));
			System.out.println("drwtNo3 : " + object.get("drwtNo3"));
			System.out.println("drwtNo4 : " + object.get("drwtNo4"));
			System.out.println("drwtNo5 : " + object.get("drwtNo5"));
			System.out.println("drwtNo6 : " + object.get("drwtNo6"));
			System.out.println("bnusNo : " + object.get("bnusNo"));

		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
}
