package com.ju.ho.detectwalkway;

import android.graphics.Color;

import com.skp.Tmap.TMapPoint;
import com.skp.Tmap.TMapPolygon;

/**
 * Created by 5stra on 2017-11-19.
 */
public class MyPolygon extends TMapPolygon {

    private double x;
    private double y;
    private int lineColor;
    private int lineAlpha;
    private int areaColor;
    private int areaAlpha;
    private int aq;

    public void setAq(int aq) {
        this.aq = aq;
    }

    public int getAq() {
        return aq;
    }



    public MyPolygon() {

    }

    public MyPolygon(double x, double y, int aq) {
        this.x = x;
        this.y = y;
        this.aq = aq;
        TMapPoint p1 = new TMapPoint(y, x); // 좌상단
        TMapPoint p2 = new TMapPoint(y, x+ MainActivity.incLng); // 우상단
        TMapPoint p3 = new TMapPoint(y - MainActivity.decLat, x + MainActivity.incLng); // 우하단
        TMapPoint p4 = new TMapPoint(y - MainActivity.decLat, x); // 좌하단
        lineColor = Color.RED;
        areaColor = Color.RED;
        lineAlpha = 50;
        areaAlpha = 50;
        this.setLineColor(lineColor);
        this.setAreaColor(areaColor);
        this.setAreaAlpha(areaAlpha);
        this.setLineAlpha(lineAlpha);
        this.addPolygonPoint(p1);
        this.addPolygonPoint(p2);
        this.addPolygonPoint(p3);
        this.addPolygonPoint(p4);
    }

    public MyPolygon(double x, double y) {
        this.x = x;
        this.y = y;
        this.aq = 0;
        TMapPoint p1 = new TMapPoint(y, x); // 좌상단
        TMapPoint p2 = new TMapPoint(y, x+ MainActivity.incLng); // 우상단
        TMapPoint p3 = new TMapPoint(y - MainActivity.decLat, x + MainActivity.incLng); // 우하단
        TMapPoint p4 = new TMapPoint(y - MainActivity.decLat, x); // 좌하단
        lineColor = Color.RED;
        areaColor = Color.RED;
        lineAlpha = 50;
        areaAlpha = 50;
        this.setLineColor(lineColor);
        this.setAreaColor(areaColor);
        this.setAreaAlpha(areaAlpha);
        this.setLineAlpha(lineAlpha);
        this.addPolygonPoint(p1);
        this.addPolygonPoint(p2);
        this.addPolygonPoint(p3);
        this.addPolygonPoint(p4);
    }


    public double getX() {
        return x;
    }

    public double getY() {
        return y;
    }

    public void setX(double x) {
        this.x = x;
    }

    public void setY(double y) {
        this.y = y;
    }

    @Override
    public void setLineColor(int lineColor) {
        this.lineColor = lineColor;
    }

    @Override
    public void setLineAlpha(int lineAlpha) {
        this.lineAlpha = lineAlpha;
    }

    @Override
    public void setAreaColor(int areaColor) {
        this.areaColor = areaColor;
    }

    @Override
    public void setAreaAlpha(int areaAlpha) {
        this.areaAlpha = areaAlpha;
    }

    @Override
    public int getLineColor() {
        return lineColor;
    }

    @Override
    public int getLineAlpha() {
        return lineAlpha;
    }

    @Override
    public int getAreaColor() {
        return areaColor;
    }

    @Override
    public int getAreaAlpha() {
        return areaAlpha;
    }



}