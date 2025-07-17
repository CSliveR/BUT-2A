package fr.iut.androidprojet.gamesModels.math;

import androidx.annotation.NonNull;

public class Addition extends Operation {
    public Addition(int terme1, int terme2){
        super(terme1, terme2);
    }
    @Override
    public int getResultat(){
        return this.getTerme1() + this.getTerme2();
    }

    @NonNull @Override
    public String toString() {
        return this.getTerme1() + " + " + this.getTerme2() + " = ";
    }
}
