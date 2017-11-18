package database;

public class MapDevide {
	
	Part part[][]; 
	
	public MapDevide() {
			
		part = new Part[42][42];
		int defaultNum = 0;
		double defaultLat = 128.348464;
		double defaultLng = 36.026216;
		
		double incLat = 0.0101613333;
		double incLng = 0.000142196476;
		
		for(int i = 0 ; i < 42 ;i++) {
			for(int j = 0 ; j < 42 ; j++) {
				part[i][j] = new Part();
				part[i][j].setNum(defaultNum++);
				part[i][j].setLng(defaultLng + (incLng*i));
				part[i][j].setLat(defaultLat + (incLat*j));
				//System.out.println(part[i][j].getNum() + " -> " + part[i][j].getLat() + " : " + part[i][j].getLng());
			}
		}
		
		
	}


	int searchLocation(double lat, double lng) {
		int startIndex = 0;
		int maxIndex = 41;
		
		int resultIndex1 = 0;
		int resultIndex2 = 0;
		int result = 0;
		
		while(startIndex < maxIndex) {
			int middle = (startIndex + maxIndex)/2;
			if(part[0][middle].getLat() > lat)
				maxIndex = middle-1;
			else
				startIndex = middle+1;
		}
		resultIndex1 = startIndex;
		
		startIndex = 0;
		maxIndex = 41;
		
		while(startIndex < maxIndex) {
			int middle = (startIndex + maxIndex)/2;
			if(part[middle][0].getLng() > lng)
				maxIndex = middle-1;
			else
				startIndex = middle+1;
		}
		resultIndex2 = startIndex;
		
		result = part[resultIndex2][resultIndex1].getNum();
		return result;
	}
	
}