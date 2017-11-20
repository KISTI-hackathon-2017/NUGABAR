package database;

public class MapDevide {
	
	Part part[][]; 
	
	public MapDevide() {
			
		part = new Part[42][42];
		int defaultNum = 0;
		double defaultLng = 128.347808;
		double defaultLat = 36.06123;
		
		double incLng = 0.01001019;
		double decLat = 0.00997869;
		
		for(int i = 0 ; i < 42 ;i++) {
			for(int j = 0 ; j < 42 ; j++) {
				part[i][j] = new Part();
				part[i][j].setNum(defaultNum++);
				part[i][j].setLat(defaultLat - (decLat*i));
				part[i][j].setLng(defaultLng + (incLng*j));
			}
		}
		
		
	}


	int searchLocation(double lng, double lat) {
		
		int resultIndex1 = 0;
		int resultIndex2 = 0;
		int result = 0;
		
		for(int i = 0 ; i <42; i++) {
			if(part[0][i].getLng() >= lng) {
				resultIndex1 = i;
				break;
			}
		}
		
		for(int i = 0 ; i <42; i++) {
			if(part[i][0].getLat() <= lat) {
				resultIndex2 = i;
				break;
			}
		}
		
		result = part[resultIndex2][resultIndex1].getNum();
		return result;
	}
	
}