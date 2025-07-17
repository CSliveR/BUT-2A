package fr.iut2.androidtp.exercice5Model;

import androidx.annotation.NonNull;

public class Multiplication {
    private int terme1;
    private int terme2;
    private Integer reponseUtilisateur;
    public Multiplication(int terme1, int terme2){
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

    public int getResultat(){
        return this.getTerme1() * this.getTerme2();
    }

    public void setReponseUtilisateur(Integer reponse){
        this.reponseUtilisateur = reponse;
    }
    public boolean isReponseJuste(){
        return this.reponseUtilisateur != null && this.terme1 * this.terme2 == this.reponseUtilisateur;
    }

    @NonNull @Override
    public String toString() {
        return this.terme1 + " x " + this.terme2 + " = ";
    }
}
