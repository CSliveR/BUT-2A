package fr.iut.androidprojet.gamesModels.math;

import androidx.annotation.NonNull;

public abstract class Operation {
    private int terme1;
    private int terme2;
    private Integer reponseUtilisateur;
    private int score = 0;
    public Operation(int terme1, int terme2){
        this.terme1 = terme1;
        this.terme2 = terme2;
        this.reponseUtilisateur = null;
    }
    public int getTerme1() {
        return this.terme1;
    }
    public int getTerme2() {
        return this.terme2;
    }
    public Integer getReponseUtilisateur() { return this.reponseUtilisateur; }
    public void setReponseUtilisateur(Integer reponse){
        this.reponseUtilisateur = reponse;
    }
    public abstract int getResultat();
    public boolean isReponseJuste() {
        return this.reponseUtilisateur != null && this.reponseUtilisateur.equals(getResultat());
    }
    public void verifierEtAjouterPoint() {
        if (isReponseJuste()) {
            this.score++;
        }
    }
    public int getScore() {
        return this.score;
    }
    @NonNull @Override
    public abstract String toString();
}
