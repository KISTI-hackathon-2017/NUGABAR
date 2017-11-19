package database;


public class AirQualityIndex {
	
	// 대상 오염물질의 대기지수점수
	int I_P[] = new int[5];
	// 대상 오염물질의 대기 중 농도
	double C_P[] = new double[5];
	// 대상 오염물질의 오염도 해당 구간에 대한 최고 오염도
	double BP_HI[][] = new double[5][4];
	// 대상 오염물질의 오염도 해당 구간에 대한 최저 오염도
	double BP_LO[][] = new double[5][4];
	// BP_HI에 해당하는 지수값 (구간 최고 지수값)
	int I_HI[] = new int[4];
	// BP_LO에 해당하는 지수값(구간 최저 지수값)
	int I_LO[] = new int[4];
	// C_P와 비교할 구간
	int section[] = new int[5];
	// 나쁨의 개수
	int badCount = 0;
	
	AirQualityIndex(double SO2, double NO2, double CO, int PM10, int PM2_5){
		for(int i = 0 ; i < 4 ; i++) {
			I_P[i] = 0;
			section[i] = 0;
		}
		
		I_LO[0] = 0;	I_LO[1] = 51;	I_LO[2] = 101;	I_LO[3] = 251;
		I_HI[0] = 50;	I_HI[1] = 100;	I_HI[2] = 250;	I_HI[3] = 500;
		
		BP_LO[0][0] = 0;BP_LO[0][1] = 0.021;BP_LO[0][2] = 0.051;BP_LO[0][3] = 0.151;
		BP_LO[1][0] = 0;BP_LO[1][1] = 0.031;BP_LO[1][2] = 0.061;BP_LO[1][3] = 0.201;
		BP_LO[2][0] = 0;BP_LO[2][1] = 2.01;BP_LO[2][2] = 9.01;BP_LO[2][3] = 15.01;
		BP_LO[3][0] = 0;BP_LO[3][1] = 31;BP_LO[3][2] = 81;BP_LO[3][3] = 151;
		BP_LO[4][0] = 0;BP_LO[4][1] = 16;BP_LO[4][2] = 51;BP_LO[4][3] = 101;
		
		BP_HI[0][0] = 0.020;BP_HI[0][1] = 0.050;BP_HI[0][2] = 0.150;BP_HI[0][3] = 1;
		BP_HI[1][0] = 0.030;BP_HI[1][1] = 0.060;BP_HI[1][2] = 0.200;BP_HI[1][3] = 2;
		BP_HI[2][0] = 2;BP_HI[2][1] = 9;BP_HI[2][2] = 15;BP_HI[2][3] = 50;
		BP_HI[3][0] = 30;BP_HI[3][1] = 80;BP_HI[3][2] = 150;BP_HI[3][3] = 600;
		BP_HI[4][0] = 15;BP_HI[4][1] = 50;BP_HI[4][2] = 100;BP_HI[4][3] = 500;
		
		C_P[0] = SO2; C_P[1] = NO2; C_P[2] = CO; C_P[3] = PM10; C_P[4] = PM2_5;
	}
	
	int calculateCAI() {
		
		for(int  i = 0  ; i < 5 ; i++) {
			
			// C_P 비교할 구간 찾기
			for(int j = 0 ; j < 4 ; j++) {
				if(C_P[i] < BP_HI[i][j]) {
					if(C_P[i] > BP_LO[i][j]) {
						section[i] = j;
						if(j >= 2) badCount++;
						break;
					}
				}
			}
			
			
			//I_P 구하기
			I_P[i] = (int)((I_HI[section[i]] - I_LO[section[i]]) / (BP_HI[i][section[i]]-BP_LO[i][section[i]])
					*(C_P[i] - BP_LO[i][section[i]])+ I_LO[section[i]]);
			
		}
		
		// I_P 중 최대값 구해서 airGrade로 저장
		int max = I_P[0];
		for(int i = 1 ; i < 5 ; i++) {
			if(max < I_P[i])
				max = I_P[i];
		}
		
		
		// 나쁨 2 개 -> +50 / 나쁨 3 개 이상 -> +75
		int result = max;
		
		if(badCount == 2) result += 50;
		if(badCount >= 3) result += 75;
		

		return result;
	}
}


