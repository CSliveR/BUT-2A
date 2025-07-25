package fr.iut.androidprojet.gamesModels.shifoumi;

import java.util.Random;

public class Shifoumi {

    public static final int CAILLOUX = 0;
    public static final int CISEAUX = 1;
    public static final int PAPIER = 2;
    private static final Random random = new Random();

	private int mainJoueur;
	private int mainOrdinateur;
	
	public Shifoumi() {
		initMainOrdinateur();
	}
	
	public int getMainJoueur() {
		return mainJoueur;
	}

	public void setMainJoueur(int mainJoueur) {
		this.mainJoueur = mainJoueur;
	}

	public int getMainOrdinateur() {
		return this.mainOrdinateur;
	}
	private void setMainOrdinateur(int mainOrdinateur) {
		this.mainOrdinateur = mainOrdinateur;
	}

	/**
	 * Initialise la main de l'ordinateur
	 */
	private void initMainOrdinateur() {
        this.mainOrdinateur = random.nextInt(3);
	}

	/**
	 *  Retourne vrai la main du joueur et la même que la main de l'ordinateur
	 *
	 */
	public boolean egalite() {
		return mainJoueur == mainOrdinateur;
	}

	/**
	 * Retourne vrai si le joueur gagne
	 *
	 */
	public boolean joueurGagne() {
		return (mainJoueur == CAILLOUX && mainOrdinateur == CISEAUX)
				|| (mainJoueur == CISEAUX && mainOrdinateur == PAPIER)
				|| (mainJoueur == PAPIER && mainOrdinateur == CAILLOUX);
	}

}
