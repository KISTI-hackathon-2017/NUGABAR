package com.ju.ho.detectwalkway;

import android.util.Log;

import org.json.simple.JSONArray;
import org.json.simple.JSONValue;

import java.io.InputStreamReader;
import java.net.URL;

/**
 * Created by 5stra on 2017-11-20.
 */
class Element{
    int block;
    int AQI;

    Element(){}

    public int getBlock() {
        return block;
    }

    public void setBlock(int block) {
        this.block = block;
    }

    public int getAQI() {
        return AQI;
    }

    public void setAQI(int aQI) {
        AQI = aQI;
    }

}

public class Parse {
    public Parse() {
        new Thread() {
            public void run() {
                try {
                    Element element[];

                    String url = "http://192.168.43.188/";
                    URL postUrl = new URL(url);

                    InputStreamReader isr = new InputStreamReader(postUrl.openConnection().getInputStream(), "UTF-8");

                    JSONArray object = (JSONArray) JSONValue.parseWithException(isr);

                    int objectSize = object.size();
                    String stringArr[] = new String[objectSize];
                    element = new Element[objectSize];

                    for (int n = 0; n < objectSize; n++) {

                        stringArr[n] = object.get(n).toString();
                        element[n] = new Element();

                        int count = 0;

                        for (int i = 0; i < stringArr[n].length(); i++) {
                            if (stringArr[n].charAt(i) == ':') {
                                for (int j = i; j < stringArr[n].length(); j++) {
                                    if (count == 5 || count == 6) {
                                        count++;
                                        break;
                                    }
                                    if (stringArr[n].charAt(j) == ',' || count == 17) {
                                        switch (count) {
                                            case 1:
                                                if (stringArr[n].substring(i + 2, j - 1).equals("")) {
                                                    element[n].setAQI(0);
                                                    MainActivity.myPolygon[element[n].getBlock() / 42][element[n].getBlock() % 42].setAq(0);
                                                    break;
                                                } else {
                                                    element[n].setAQI(Integer.parseInt(stringArr[n].substring(i + 2, j - 1)));
                                                    MainActivity.myPolygon[element[n].getBlock() / 42][element[n].getBlock() % 42].setAq(Integer.parseInt(stringArr[n].substring(i + 2, j - 1)));
                                                    break;
                                                }
                                            case 4:
                                                element[n].setBlock(Integer.parseInt(stringArr[n].substring(i + 2, j - 1)));
//                                                Log.d("debug(Parse)", element[n].getBlock() + ": " + element[n].getAQI());
                                                break;


                                        }
                                        count++;
                                        break;
                                    }

                                }
                            }


                        }


                    }

                    Log.d("debug(Parse)", "GOOD");
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.start();
    }
}
