package database;

public class DatabaseThread implements Runnable{
	
	Thread thread;
	DBConnection connection;
	public DatabaseThread() {
		connection = new DBConnection();
		setThread(new Thread(this));
		thread.start();
	}
	
	

	public Thread getThread() {
		return thread;
	}

	public void setThread(Thread thread) {
		this.thread = thread;
	}



	@Override
	public void run() {
		try {
			while(true) {
		connection.insertData();
		Thread.sleep(1000);
			}
		} catch(Exception e) {
			e.printStackTrace();
		}
	}
	
	
}
