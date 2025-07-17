package fr.iut.androidprojet.gamesModels.pendu;

import java.util.ArrayList;
import java.util.Collections;

public class Pendu {
    private String motATrouver;
    private StringBuilder motCache;
    private int nbEssais;

    public Pendu(String mot) {
        this.motATrouver = mot;
        this.nbEssais = 8;
        this.motCache = new StringBuilder("_".repeat(this.motATrouver.length()));
    }

    public static String choisirMotAleatoire(ArrayList<String> listMots) {
        Collections.shuffle(listMots);
        return listMots.get(0);
    }
    public String getMotATrouver() {
        return this.motATrouver;
    }
    public StringBuilder getMotCache() {
        return this.motCache;
    }
    public void setMotCache(char lettre) {
        for (int i = 0; i < this.motATrouver.length(); i++) {
            if (this.motATrouver.charAt(i) == lettre) {
                this.motCache.setCharAt(i, lettre); // Remplacer le _ par la lettre trouvée
            }
        }
    }
    public int getNbEssais() {
        return this.nbEssais;
    }
    public void saisirLettre(char lettre) {
        boolean found = false;
        for (int i = 0; i < this.motATrouver.length(); i++) {
            if (this.motATrouver.charAt(i) == lettre) {
                this.motCache.setCharAt(i, lettre);
                found = true;
            }
        }

        if (!found) {
            this.nbEssais--;
        }
    }

    public boolean estGagne() {
        return this.motCache.toString().compareToIgnoreCase(this.motATrouver) == 0;
    }
    public boolean estPerdu() {
        return this.nbEssais == 0;
    }
    public boolean estTermine(){
        return this.estGagne() || this.estPerdu();
    }

    public int getScore() {
        int lettresTrouvees = 0;
        if(estGagne()){
            return motCache.length();
        }else{
            for (int i = 0; i < motCache.length(); i++) {
                if (motCache.charAt(i) != '_') {
                    lettresTrouvees++;
                }
            }
            return lettresTrouvees;
        }
    }
}

