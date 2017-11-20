package com.ju.ho.detectwalkway;

import android.app.Application;

import com.skp.Tmap.TMapPoint;

import java.util.ArrayList;

/**
 * Created by 5stra on 2017-11-20.
 */

public class MyApplication extends Application {
    private boolean thchk = false;
    private ArrayList<TMapPoint> pointList1 = new ArrayList<>();
    private ArrayList<TMapPoint> pointList2 = new ArrayList<>();
    private ArrayList<ArrayList<TMapPoint>> pointArray = new ArrayList<>();

    public ArrayList<ArrayList<TMapPoint>> getPointArray() {
        return pointArray;
    }

    public void setPointArray(ArrayList<ArrayList<TMapPoint>> pointArray) {
        this.pointArray = pointArray;
    }



    public void setPointList1(ArrayList<TMapPoint> pointList1) {
        this.pointList1 = pointList1;
    }

    public void setPointList2(ArrayList<TMapPoint> pointList2) {
        this.pointList2 = pointList2;
    }



    public ArrayList<TMapPoint> getPointList1() {
        return pointList1;
    }

    public ArrayList<TMapPoint> getPointList2() {
        return pointList2;
    }



    public void setThchk(boolean thchk) {
        this.thchk = thchk;
    }

    public boolean isThchk() {
        return thchk;
    }



}
