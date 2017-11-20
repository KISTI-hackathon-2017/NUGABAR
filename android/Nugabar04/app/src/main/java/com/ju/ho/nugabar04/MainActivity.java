package com.ju.ho.nugabar04;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.graphics.PointF;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Toast;

import com.skp.Tmap.TMapData;
import com.skp.Tmap.TMapMarkerItem;
import com.skp.Tmap.TMapPOIItem;
import com.skp.Tmap.TMapPoint;
import com.skp.Tmap.TMapPolyLine;
import com.skp.Tmap.TMapPolygon;
import com.skp.Tmap.TMapView;

import org.json.simple.JSONArray;
import org.json.simple.JSONValue;
import org.w3c.dom.Document;
import org.w3c.dom.Element;
import org.w3c.dom.NodeList;

import java.io.InputStreamReader;
import java.net.URL;
import java.util.ArrayList;




public class MainActivity extends AppCompatActivity {

    public static final double incLng = 0.01001019;
    public static final double decLat = 0.00997869;

    TMapPoint startPoint;



    public static MyPolygon myPolygon[][];
    TMapPolyLine tMapPolyLine;

    int first, second;

    public void setMyPolygon(int i, int j, int a) {
        this.myPolygon[i][j].setAq(a);
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        final MyApplication myApp = (MyApplication)getApplication();
        myApp.setThchk(false);

        LinearLayout linearLayoutTmap = (LinearLayout)findViewById(R.id.linearLayoutTmap);
        final TMapView tMapView = new TMapView(this);

        tMapView.setSKPMapApiKey("d87d7579-99ce-3cd0-a66b-e216c12864b0");
        tMapView.setCenterPoint(128.60198736190796, 35.87106427665821);

        linearLayoutTmap.addView( tMapView );

        myPolygon = new MyPolygon[42][42];
        double startX = 128.347808;
        double startY = 36.06123;
        for(int i = 0; i < 42; i++) {
            for(int j = 0; j < 42; j++) {
                myPolygon[i][j] = new MyPolygon(startX + MainActivity.incLng*i, startY - MainActivity.decLat*j);
                tMapView.addTMapPolygon(myPolygon[i][j].getID(), myPolygon[i][j]);
            }
        }

        new Thread() {
            public void run() {
                try {
                    com.ju.ho.nugabar04.Element element[];

                    String url = "http://192.168.0.5/";
                    URL postUrl = new URL(url);

                    InputStreamReader isr = new InputStreamReader(postUrl.openConnection().getInputStream(), "UTF-8");

                    JSONArray object = (JSONArray) JSONValue.parseWithException(isr);

                    int objectSize = object.size();
                    String stringArr[] = new String[objectSize];
                    element = new com.ju.ho.nugabar04.Element[objectSize];

                    for (int n = 0; n < objectSize; n++) {

                        stringArr[n] = object.get(n).toString();
                        element[n] = new com.ju.ho.nugabar04.Element();

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
                                                    break;
                                                } else {
                                                    element[n].setAQI(Integer.parseInt(stringArr[n].substring(i + 2, j - 1)));
                                                    break;
                                                }
                                            case 4:
                                                element[n].setBlock(Integer.parseInt(stringArr[n].substring(i + 2, j - 1)));
                                                myPolygon[element[n].getBlock()/42][element[n].getBlock()%42].setAq(element[n].getAQI());
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
                    for(int i= 0; i < 42; i++) {
                        for(int j = 0; j < 42; j++) {

                            Log.d("debug", i + ", " + j + ": " + myPolygon[i][j].getAq());
                        }
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }
        }.start();


        final TMapData tmapdata = new TMapData();

        Button parseButton = (Button)findViewById(R.id.parseButton);

        tMapView.setOnLongClickListenerCallback(new TMapView.OnLongClickListenerCallback() {
            @Override
            public void onLongPressEvent(ArrayList<TMapMarkerItem> arrayList, ArrayList<TMapPOIItem> arrayList1, TMapPoint tMapPoint) {
                startPoint = new TMapPoint(tMapPoint.getLatitude(), tMapPoint.getLongitude());
                Toast.makeText(getApplicationContext(),"출발지\nlon: " + tMapPoint.getLongitude() + "\nlat: " + tMapPoint.getLatitude(), Toast.LENGTH_SHORT).show();
                int startIndex = 0;
                int maxIndex = 41;

                while(startIndex < maxIndex) {
                    int middle = (startIndex + maxIndex)/2;
                    if(myPolygon[middle][0].getX() > tMapPoint.getLongitude()) {
                        maxIndex = middle - 1;
                    }
                    else {
                        startIndex = middle + 1;
                    }
                }
                first = startIndex;
                Log.d("debug", "second: " + second);

                startIndex = 0;
                maxIndex = 41;

                while(startIndex < maxIndex) {
                    int middle = (startIndex + maxIndex)/2;
                    if(myPolygon[0][middle].getY() < tMapPoint.getLatitude()) {
                        maxIndex = middle - 1;
                    }
                    else {
                        startIndex = middle + 1;
                    }
                }
                second = startIndex;
                Log.d("debug", "first: " + first);
            }
        });

        parseButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                tMapPolyLine = new TMapPolyLine();
                tMapPolyLine.setLineColor(Color.BLUE);
                tMapPolyLine.setLineWidth(2);
                tMapView.setCenterPoint(startPoint.getLongitude(), startPoint.getLatitude());
                tMapView.setZoomLevel(15);

                TMapPoint s1 = startPoint;
//                TMapPoint s1 = new TMapPoint(myPolygon[first][second].getY(), myPolygon[first][second].getX());
                int min = 500;
                int rFirst = first, rSecond = second;
                for(int i = 0; i < 2; i++) {
                    for(int j = 0; j < 2; j++) {
                        if(myPolygon[first - 1 + i][second - 1 + j].getAq() == 0) {
                            continue;
                        }
                        if(myPolygon[first - 1 + i][second - 1 + j].getAq() < min) {
                            if(i == 1 && j == 1) continue;
                            min = (myPolygon[first - 1 + i][second - 1 + j].getAq());
                            rFirst = first - 1 + i;
                            rSecond = second - 1 + j;
                        }
                    }
                }
                if(min == 500) {
                    Toast.makeText(getApplicationContext(),"주변 공기질이 좋지 않습니다 산책을 삼가하시기 바랍니다", Toast.LENGTH_SHORT).show();
                    return;
                }
                TMapPoint e1 = new TMapPoint(myPolygon[rFirst][rSecond].getY(), myPolygon[rFirst][rSecond].getX());
                tmapdata.findPathDataAllType(TMapData.TMapPathType.PEDESTRIAN_PATH, s1, e1, new TMapData.FindPathDataAllListenerCallback() {
                    @Override
                    public void onFindPathDataAll(Document document) {
                        Element root = document.getDocumentElement();
                        NodeList nodeListPlacemark = root.getElementsByTagName("Placemark");
                        for( int i=0; i<nodeListPlacemark.getLength(); i++ ) {
                            NodeList nodeListPlacemarkItem = nodeListPlacemark.item(i).getChildNodes();
                            for( int j=0; j<nodeListPlacemarkItem.getLength(); j++ ) {
                                if(nodeListPlacemarkItem.item(j).getNodeName().equals("Point")) {
                                    NodeList node = nodeListPlacemarkItem.item(j).getChildNodes();
                                    for(int k = 0; k < node.getLength(); k++) {
                                        if(node.item(k).getNodeName().equals("coordinates")) {
                                            String[] array = node.item(k).getTextContent().split(",");
                                            tMapPolyLine.addLinePoint(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
                                            myApp.getPointList1().add(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
//                                            Log.d("debug1(Point)", array[1] + ", " + array[0]);
                                        }
                                    }
                                }
                                else if(nodeListPlacemarkItem.item(j).getNodeName().equals("LineString")) {
                                    NodeList node = nodeListPlacemarkItem.item(j).getChildNodes();
                                    for(int k = 0; k < node.getLength(); k++) {
                                        if(node.item(k).getNodeName().equals("coordinates")) {
                                            String[] arrayBlank = node.item(k).getTextContent().split(" ");
                                            for(int q = 0; q < arrayBlank.length; q++) {
                                                String[] array = arrayBlank[q].split(",");
                                                tMapPolyLine.addLinePoint(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
                                                myApp.getPointList1().add(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
//                                                Log.d("debug1(LineString)", array[1] + ", " + array[0]);
                                            }
                                        }
                                    }
                                }
                            }

                        }
                    }
                });

                TMapPoint s2 = e1;
                min = 500;
                int rrFirst = rFirst, rrSecond = rSecond;
                for(int i = 0; i < 2; i++) {
                    for(int j = 0; j < 2; j++) {
                        if(myPolygon[rFirst - 1 + i][rSecond - 1 + j].getAq() == 0) {
                            continue;
                        }
                        if(myPolygon[rFirst - 1 + i][rSecond - 1 + j].getAq() < min) {
                            if(i == 1 && j == 1) continue;
                            if(rFirst - 1 + i == first && rSecond - 1 + j == second) continue;
                            min = (myPolygon[rFirst - 1 + i][rSecond - 1 + j].getAq());
                            rrFirst = rFirst - 1 + i;
                            rrSecond = rSecond - 1 + j;
                        }
                    }
                }
                if(min == 500) {
                    Toast.makeText(getApplicationContext(),"주변 공기질이 좋지 않습니다 산책을 삼가하시기 바랍니다", Toast.LENGTH_SHORT).show();
                    return;
                }
                TMapPoint e2 = new TMapPoint(myPolygon[rrFirst][rrSecond].getY(), myPolygon[rrFirst][rrSecond].getX());
                    tmapdata.findPathDataAllType(TMapData.TMapPathType.PEDESTRIAN_PATH, s2, e2, new TMapData.FindPathDataAllListenerCallback() {
                        @Override
                        public void onFindPathDataAll(Document document) {
                                    boolean chk = false;
                                    Element root = document.getDocumentElement();
                                    NodeList nodeListPlacemark = root.getElementsByTagName("Placemark");
                                    for (int i = 0; i < nodeListPlacemark.getLength(); i++) {
                                        NodeList nodeListPlacemarkItem = nodeListPlacemark.item(i).getChildNodes();
                                        for (int j = 0; j < nodeListPlacemarkItem.getLength(); j++) {
                                            if (nodeListPlacemarkItem.item(j).getNodeName().equals("Point")) {
                                                NodeList node = nodeListPlacemarkItem.item(j).getChildNodes();
                                                for (int k = 0; k < node.getLength(); k++) {
                                                    if (node.item(k).getNodeName().equals("coordinates")) {
                                                        String[] array = node.item(k).getTextContent().split(",");
                                                        if (chk)
                                                            tMapPolyLine.addLinePoint(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
                                                        chk = true;
                                                        myApp.getPointList2().add(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
//                                                        Log.d("debug2(Point)", array[1] + ", " + array[0]);
                                                    }
                                                }
                                            } else if (nodeListPlacemarkItem.item(j).getNodeName().equals("LineString")) {
                                                NodeList node = nodeListPlacemarkItem.item(j).getChildNodes();
                                                for (int k = 0; k < node.getLength(); k++) {
                                                    if (node.item(k).getNodeName().equals("coordinates")) {
                                                        String[] arrayBlank = node.item(k).getTextContent().split(" ");
                                                        for (int q = 0; q < arrayBlank.length; q++) {
                                                            String[] array = arrayBlank[q].split(",");
                                                            if (chk)
                                                                tMapPolyLine.addLinePoint(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
                                                            chk = true;
                                                            myApp.getPointList2().add(new TMapPoint(Double.parseDouble(array[1]), Double.parseDouble(array[0])));
//                                                            Log.d("debug2(LineString)", array[1] + ", " + array[0]);
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                        }
                    });


                TMapPolyLine tl = new TMapPolyLine();
                tl.setID("tl");
                tl = new TMapPolyLine();
                tl.setLineColor(Color.BLUE);
                tl.setLineWidth(2);

                for(int i = 0; i < myApp.getPointList1().size(); i++) {
                    tl.addLinePoint(myApp.getPointList1().get(i));
                }
                for(int i = 0; i < myApp.getPointList2().size(); i++) {
                    tl.addLinePoint(myApp.getPointList2().get(i));
                }
                tMapView.addTMapPolyLine(tl.getID(), tl);
                Log.d("debug(거리)", "distance: " + tl.getDistance());

                myApp.getPointList1().clear();
                myApp.getPointList2().clear();


            }
        });

    }

}