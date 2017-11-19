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
		int startIndex = 0;
		int maxIndex = 41;
		
		int resultIndex1 = 0;
		int resultIndex2 = 0;
		int result = 0;
		
		while(startIndex < maxIndex) {
			int middle = (startIndex + maxIndex)/2;
			if(part[0][middle].getLng() > lng)
				maxIndex = middle-1;
			else
				startIndex = middle+1;
		}
		resultIndex1 = startIndex;
		
		startIndex = 0;
		maxIndex = 41;
		
		while(startIndex < maxIndex) {
			int middle = (startIndex + maxIndex)/2;
			if(part[middle][0].getLat() < lat)
				maxIndex = middle-1;
			else
				startIndex = middle+1;
		}
		resultIndex2 = startIndex;
		
		result = part[resultIndex2][resultIndex1].getNum();
		return result;
	}
	
}