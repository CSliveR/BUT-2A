package fr.iut.androidprojet.gamesModels.shifoumi;

public class ShifoumiResult {
	private int nombreVictoire=0;
	private int nombreEgalite=0;
	private int nombreDefaite=0;

	public ShifoumiResult(){}

	public int getNombreVictoire() {
		return nombreVictoire;
	}

	public void setNombreVictoire(int nombreVictoire) {
		this.nombreVictoire = nombreVictoire;
	}
	
	public int getNombreEgalite() {
		return nombreEgalite;
	}

	public void setNombreEgalite(int nombreEgalite) {
		this.nombreEgalite = nombreEgalite;
	}

	public int getNombreDefaite() {
		return nombreDefaite;
	}

	public void setNombreDefaite(int nombreDefaite) {
		this.nombreDefaite = nombreDefaite;
	}

	public int getScore(){return this.getNombreVictoire() - this.getNombreDefaite();}
	

	//////////////////////////////////
	public void addVictoire() {
		nombreVictoire++;
	}
	
	public void addDefaite() {
		nombreDefaite++;
	}
	
	public void addEgalite() {
		nombreEgalite++;
	}
}
