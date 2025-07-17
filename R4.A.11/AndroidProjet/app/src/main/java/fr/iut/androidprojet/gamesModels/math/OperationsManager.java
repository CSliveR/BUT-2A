package fr.iut.androidprojet.gamesModels.math;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

public class OperationsManager<T extends Operation> {
    private List<T> operations;
    private int score;

    public OperationsManager(List<T> operations, boolean estMelange) {
        this.operations = new ArrayList<>(operations);
        if (estMelange) {
            melange();
        }
    }

    private void melange() {
        Collections.shuffle(this.operations);
    }

    public int getNombreReponsesJustes() {
        int nbReponsesJustes = 0;
        for (T operation : this.operations) {
            if (operation.isReponseJuste()) {
                nbReponsesJustes++;
            }
        }
        return nbReponsesJustes;
    }

    public int getNombreOperations() {
        return this.operations.size();
    }

    public T getOperation(int index) {
        return this.operations.get(index);
    }

    public List<T> getOperations() {
        return this.operations;
    }
}
