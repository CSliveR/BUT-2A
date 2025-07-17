package fr.iut.androidprojet.gamesModels.math;

import androidx.annotation.NonNull;

public class Division extends Operation {
    private Integer resteUtilisateur;
    public Division(int terme1, int terme2) {
        super(terme1, terme2);
    }

    @Override
    public int getResultat() {
        return this.getTerme1() / this.getTerme2();
    }

    public int getReste() {
        return this.getTerme1() % this.getTerme2();
    }

    public Integer getResteUtilisateur() {
        return resteUtilisateur;
    }

    public void setResteUtilisateur(Integer resteUtilisateur) {
        this.resteUtilisateur = resteUtilisateur;
    }

    @Override
    public boolean isReponseJuste() {
        return super.isReponseJuste() && (this.resteUtilisateur != null && this.resteUtilisateur.compareTo(this.getReste()) == 0);
    }

    @NonNull
    @Override
    public String toString() {
        return this.getTerme1() + " / " + this.getTerme2() + " = ";
    }
}
