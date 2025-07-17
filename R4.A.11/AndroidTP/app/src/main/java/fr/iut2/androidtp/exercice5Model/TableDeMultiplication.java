package fr.iut2.androidtp.exercice5Model;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class TableDeMultiplication {
    private int nombreTable;
    private List<Multiplication> multiplications;
    public TableDeMultiplication(int nombreTable, boolean estMelange){
        this.nombreTable = nombreTable;
        this.multiplications = new ArrayList<>();
        initialisation();
        if(estMelange){
            melange();
        }
    }
    private void initialisation(){
        for(int i=1; i<=10; i++){
            multiplications.add(new Multiplication(this.nombreTable, i));
        }
    }
    private void melange(){
        Collections.shuffle(this.multiplications);
    }

    public int getNombreReponsesJustes(){
        int nbReponsesJustes = 0;
        for (Multiplication multiplication : this.multiplications){
            if(multiplication.isReponseJuste()){
                nbReponsesJustes++;
            }
        }
        return nbReponsesJustes;
    }

    public int getNombreDeMultiplications(){
        return this.multiplications.size();
    }

    public Multiplication getMultiplication(int index){
        return this.multiplications.get(index);
    }

    public List<Multiplication> getMultiplications(){
        return this.multiplications;
    }
}
