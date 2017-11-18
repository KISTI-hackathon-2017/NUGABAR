package database;

public class Element {

	double HUM;
	double LNG;
	double SPD;
	String VBR;
	String TIME;
	int VOC;
	double CO;
	double NO2;
	double TEMP;
	double PRES;
	double SO2;
	String PM2_5;
	String PM10;
	int MCP;
	double LAT;
	String node_id;

	Element() {
	};

	public double getHUM() {
		return HUM;
	}

	public void setHUM(double hUM) {
		HUM = hUM;
	}

	public double getLNG() {
		return LNG;
	}

	public void setLNG(double lNG) {
		LNG = lNG;
	}

	public double getSPD() {
		return SPD;
	}

	public void setSPD(double sPD) {
		SPD = sPD;
	}

	public String getVBR() {
		return VBR;
	}

	public void setVBR(String vBR) {
		VBR = vBR;
	}

	public String getTIME() {
		return TIME;
	}

	public void setTIME(String tIME) {
		TIME = tIME;
	}

	public int getVOC() {
		return VOC;
	}

	public void setVOC(int vOC) {
		VOC = vOC;
	}

	public double getCO() {
		return CO;
	}

	public void setCO(double cO) {
		CO = cO;
	}

	public double getNO2() {
		return NO2;
	}

	public void setNO2(double nO2) {
		NO2 = nO2;
	}

	public double getTEMP() {
		return TEMP;
	}

	public void setTEMP(double tEMP) {
		TEMP = tEMP;
	}

	public double getPRES() {
		return PRES;
	}

	public void setPRES(double pRES) {
		PRES = pRES;
	}

	public double getSO2() {
		return SO2;
	}

	public void setSO2(double sO2) {
		SO2 = sO2;
	}

	public String getPM2_5() {
		return PM2_5;
	}

	public void setPM2_5(String pM2_5) {
		PM2_5 = pM2_5;
	}

	public String getPM10() {
		return PM10;
	}

	public void setPM10(String pM10) {
		PM10 = pM10;
	}

	public int getMCP() {
		return MCP;
	}

	public void setMCP(int mCP) {
		MCP = mCP;
	}

	public double getLAT() {
		return LAT;
	}

	public void setLAT(double lAT) {
		LAT = lAT;
	}

	public String getNode_id() {
		return node_id;
	}

	public void setNode_id(String node_id) {
		this.node_id = node_id;
	}
}
